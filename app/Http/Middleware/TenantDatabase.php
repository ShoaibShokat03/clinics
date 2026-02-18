<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class TenantDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get 'project-1' from https://jantrah.io/project-1/dashboard
        $segment = getenv('URL_SEGMENT');
        $slug = (string) $request->segment($segment);

        // If no project segment found, skip database switching (for routes without project prefix)
        if (empty($slug)) {
            return $next($request);
        }

        $projects = Config::get('all_projects');

        // Validate project exists
        if (!isset($projects[$slug])) {
            abort(404, 'Project not found');
        }

        $project = $projects[$slug];

        // Set URL defaults for automatic route generation
        // This ensures all route() calls automatically include the project parameter
        URL::defaults(['project' => $slug]);

        // Also store in config for easy access
        Config::set('app.current_project', $slug);

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
        // 1. StartSession has already run and initialized the session
        // 2. Clearing it would invalidate CSRF tokens and cause 419 errors
        // 3. The session config was already set by SetTenantAppKey middleware before StartSession ran

        // Dynamic File Upload Path - Store in public/uploads/{project} folder
        $uploadPath = public_path('uploads/' . $slug);
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }
        Config::set('filesystems.disks.public.root', $uploadPath);
        Config::set('filesystems.disks.public.url', env('APP_URL') . '/uploads/' . $slug);

        $prefix = $project['Prefix'];

        // overide env variable APP_PREFIX
        Config::set('app.prefix', $prefix);

        // Set the app key for encryption (must be 'app.key' not 'app.app_key')
        // Note: This is already set by SetTenantAppKey middleware, but we ensure it's set here too
        // Generate APP_KEY if it's empty or not set
        if (empty($project['APP_KEY'])) {
            $cipher = Config::get('app.cipher', 'AES-256-CBC');
            $generatedKey = Encrypter::generateKey($cipher);
            $formattedKey = 'base64:' . base64_encode($generatedKey);
            // Store it in config file
            $this->updateConfigFile($slug, $formattedKey);
            $project['APP_KEY'] = $formattedKey;
            // Reload config
            Artisan::call('config:clear');
            $projects = Config::get('all_projects');
            $project = $projects[$slug];
        }
        Config::set('app.key', $project['APP_KEY']);

        // Rebind the encrypter singleton to use the new key (if not already rebound)
        // This ensures encryption/decryption uses the correct key for this tenant
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

        $databaseName = $project['DATABASE_NAME'];
        $host = $project['HOST'];
        $username = $project['USERNAME'];
        $password = $project['PASSWORD'];

        // Update the configuration on the fly
        Config::set('database.connections.mysql.database', $databaseName);
        Config::set('database.connections.mysql.host', $host);
        Config::set('database.connections.mysql.username', $username);
        Config::set('database.connections.mysql.password', $password);

        // IMPORTANT: Switch database BEFORE route model binding happens
        // This ensures all Eloquent models use the correct database connection

        // Purge the old connection and reconnect with the new DB name
        DB::purge('mysql');

        // Clear any cached connections
        try {
            $connection = DB::connection('mysql');
            if ($connection->getPdo()) {
                $connection->disconnect();
            }
        } catch (\Exception $e) {
            // Connection might not exist yet, that's okay
        }

        // Reconnect with new database configuration
        DB::reconnect('mysql');

        // Force Eloquent to use the new connection by setting it as default
        // This ensures all models use the switched database for route model binding
        \Illuminate\Database\Eloquent\Model::setConnectionResolver(DB::getFacadeRoot());

        // Clear any model connection cache to ensure fresh connection is used
        // This is critical for route model binding to work correctly
        \Illuminate\Database\Eloquent\Model::clearBootedModels();

        // Force a test query to ensure connection is working and database is accessible
        // This also ensures the PDO connection is fully established before route model binding
        try {
            $pdo = DB::connection('mysql')->getPdo();
            // Test the connection with a simple query to ensure it's fully established
            DB::connection('mysql')->select('SELECT 1');
        } catch (\Exception $e) {
            abort(500, 'Database connection failed: ' . $e->getMessage());
        }

        // Remove project parameter from route to prevent it from being passed to controllers
        // This must be done AFTER database switch but BEFORE route model binding
        // Route model binding happens in SubstituteBindings middleware which runs after this
        if ($request->route()) {
            $request->route()->forgetParameter('project');
        }

        return $next($request);
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

        $replacement = function ($matches) use ($appKey) {
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
