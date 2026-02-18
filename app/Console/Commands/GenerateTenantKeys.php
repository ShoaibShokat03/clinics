<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Encryption\Encrypter;

class GenerateTenantKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:generate-keys {--show : Display the keys instead of updating config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate proper encryption keys for all tenant projects';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $projects = Config::get('all_projects');
        $cipher = Config::get('app.cipher', 'AES-256-CBC');
        
        $this->info('Generating encryption keys for tenant projects...');
        $this->newLine();
        
        $keys = [];
        foreach ($projects as $slug => $project) {
            // Generate a proper 32-byte key for AES-256-CBC
            $key = Encrypter::generateKey($cipher);
            $formattedKey = 'base64:' . base64_encode($key);
            $keys[$slug] = $formattedKey;
            
            $this->line("<comment>{$slug}:</comment>");
            $this->line("  APP_KEY: {$formattedKey}");
            $this->newLine();
        }
        
        if ($this->option('show')) {
            $this->info('Add these keys to your config/all_projects.php file:');
            $this->newLine();
            foreach ($keys as $slug => $key) {
                $this->line("    '{$slug}' => [");
                $this->line("        'APP_KEY' => '{$key}',");
                $this->line("        // ... other config");
                $this->line("    ],");
            }
        } else {
            $this->warn('Use --show flag to display the keys. They are not automatically updated.');
            $this->info('Copy the keys above and update your config/all_projects.php file manually.');
        }
        
        return 0;
    }
}
