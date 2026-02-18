<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class SetTenantAppKey
{
    /**
     * Handle an incoming request.
     * This middleware runs early to set the app key before encryption middleware runs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Extract project slug from URL (same logic as TenantDatabase middleware)
        // Get 'project-1' from https://jantrah.io/project-1/dashboard
        $segment = getenv('URL_SEGMENT');
        $slug = (string) $request->segment($segment);

        // If we have a project slug, set the app key early
        if (!empty($slug)) {
            $projects = Config::get('all_projects');

            if (isset($projects[$slug])) {
                $project = $projects[$slug];

                // Generate APP_KEY on first visit if it doesn't exist
                if (empty($project['APP_KEY'])) {
                    $appKey = $this->generateAndStoreAppKey($slug);
                    // Reload projects config to get the updated key
                    // Clear config cache and reload
                    Artisan::call('config:clear');
                    $projects = Config::get('all_projects');
                    $project = $projects[$slug];
                }

                // Set the app key for encryption (must be 'app.key' not 'app.app_key')
                Config::set('app.key', $project['APP_KEY']);

                // Make sessions project-specific by setting unique cookie name and storage per project
                // This prevents sessions from one project interfering with another
                Config::set('session.cookie', env('SESSION_COOKIE', 'laravel') . '_' . $slug . '_session');

                // Set project-specific session storage path for file driver
                // This ensures each project has its own session files
                $sessionPath = storage_path('framework/sessions/' . $slug);
                if (!File::exists($sessionPath)) {
                    File::makeDirectory($sessionPath, 0755, true);
                }
                Config::set('session.files', $sessionPath);

                // Set project-specific session table name for database driver
                Config::set('session.table', 'sessions_' . str_replace('-', '_', $slug));

                // Note: We don't clear the session instance here because:
                // 1. This middleware runs BEFORE StartSession, so the session manager hasn't been initialized yet
                // 2. Clearing it would invalidate CSRF tokens stored in sessions
                // 3. The config is set early enough that StartSession will use the correct settings

                // Rebind the encrypter singleton to use the new key
                // This ensures encryption/decryption uses the correct key for this tenant
                // We need to do this BEFORE EncryptCookies middleware runs
                // Clear any existing resolved instance to force recreation
                $container = app();
                // Use reflection to access forgetInstance if available
                if ($container->bound('encrypter')) {
                    $reflection = new \ReflectionClass($container);
                    if ($reflection->hasMethod('forgetInstance')) {
                        $method = $reflection->getMethod('forgetInstance');
                        $method->setAccessible(true);
                        $method->invoke($container, 'encrypter');
                    }
                }

                app()->singleton('encrypter', function ($app) use ($project, $slug) {
                    $config = $app->make('config')->get('app');
                    $cipher = $config['cipher'] ?? 'AES-256-CBC';

                    // Use the stored APP_KEY from config (already set above)
                    $key = $config['key'];

                    // If key is empty, generate one (shouldn't happen as we generate above, but just in case)
                    if (empty($key)) {
                        // Generate key on the fly
                        $generatedKey = Encrypter::generateKey($cipher);
                        $formattedKey = 'base64:' . base64_encode($generatedKey);
                        // Store it for future use
                        $this->updateConfigFile($slug, $formattedKey);
                        $key = $formattedKey;
                        Config::set('app.key', $formattedKey);
                    }

                    // Parse base64 encoded keys (Laravel format: base64:xxxxx)
                    if (Str::startsWith($key, 'base64:')) {
                        $decodedKey = base64_decode(substr($key, 7), true);

                        if ($decodedKey === false) {
                            // Invalid base64, generate a new key
                            $generatedKey = Encrypter::generateKey($cipher);
                            $formattedKey = 'base64:' . base64_encode($generatedKey);
                            $this->updateConfigFile($slug, $formattedKey);
                            $decodedKey = $generatedKey;
                        }
                        $key = $decodedKey;
                    }

                    if (empty($key)) {
                        // Last resort: generate a key
                        $key = Encrypter::generateKey($cipher);
                    }

                    return new Encrypter($key, $cipher);
                });
            }
        }

        return $next($request);
    }

    /**
     * Generate and store APP_KEY for a project
     *
     * @param string $slug
     * @return string
     */
    private function generateAndStoreAppKey($slug)
    {
        $cipher = Config::get('app.cipher', 'AES-256-CBC');

        // Generate a proper encryption key
        $key = Encrypter::generateKey($cipher);
        $formattedKey = 'base64:' . base64_encode($key);

        // Store it in the config file
        $this->updateConfigFile($slug, $formattedKey);

        return $formattedKey;
    }

    /**
     * Update the config file with the generated APP_KEY
     *
     * @param string $slug
     * @param string $appKey
     * @return void
     */
    private function updateConfigFile($slug, $appKey)
    {
        $configPath = config_path('all_projects.php');

        if (!File::exists($configPath)) {
            return;
        }

        $content = File::get($configPath);

        // Find the project array and add/update APP_KEY
        // Pattern: "project-X" => [ ... ]
        $pattern = '/("' . preg_quote($slug, '/') . '"\s*=>\s*\[)(.*?)(\])/s';

        $replacement = function($matches) use ($appKey, $slug) {
            $projectConfig = $matches[2];

            // Check if APP_KEY already exists
            if (preg_match("/'APP_KEY'\s*=>/", $projectConfig)) {
                // Update existing APP_KEY
                $projectConfig = preg_replace(
                    "/'APP_KEY'\s*=>\s*'[^']*'/",
                    "'APP_KEY' => '{$appKey}'",
                    $projectConfig
                );
            } else {
                // Add APP_KEY after the first line or after SEGMENT_NAME if it exists
                if (preg_match("/'SEGMENT_NAME'/", $projectConfig)) {
                    $projectConfig = preg_replace(
                        "/('SEGMENT_NAME'\s*=>\s*'[^']*',)/",
                        "$1\n        'APP_KEY' => '{$appKey}',",
                        $projectConfig
                    );
                } else {
                    // Add after Prefix
                    $projectConfig = preg_replace(
                        "/('Prefix'\s*=>\s*'[^']*',)/",
                        "$1\n        'APP_KEY' => '{$appKey}',",
                        $projectConfig
                    );
                }
            }

            return $matches[1] . $projectConfig . $matches[3];
        };

        $updatedContent = preg_replace_callback($pattern, $replacement, $content);

        if ($updatedContent !== null) {
            File::put($configPath, $updatedContent);
            // Clear config cache to reload the updated config
            Artisan::call('config:clear');
        }
    }
}
