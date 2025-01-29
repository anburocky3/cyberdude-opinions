<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automate the deployment process';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm('Are you sure to deploy the application?')) {
            $this->info('Starting deployment...');

            $secretKey = "anbu@321";

            // Enable maintenance mode
            Artisan::call('down', ['--secret' => $secretKey]);
            $this->info("Application is now in maintenance mode. Secret access: {${config('app.url')}}/$secretKey.");

            // Pull the latest changes from the repository
            if ($this->confirm('Pull the latest changes from the repository?')) {
                exec('git pull origin main', $output, $return_var);
                $this->info(implode("\n", $output));
            }

            // Install PHP dependencies
            if ($this->confirm('Install PHP dependencies?')) {
                exec('composer2 install --no-interaction --prefer-dist --optimize-autoloader', $output, $return_var);
                $this->info(implode("\n", $output));
            }

            // Run database migrations
            $migrationChoice = $this->choice('Choose migration type', ['Fresh', 'Migrate with seed', 'Just migrate'], 2);
            switch ($migrationChoice) {
                case 'Fresh':
                    Artisan::call('migrate:fresh --force');
                    break;
                case 'Migrate with seed':
                    Artisan::call('migrate --seed --force');
                    break;
                case 'Just migrate':
                    Artisan::call('migrate --force');
                    break;
            }
            $this->info('Database migrations completed.');

            // Install Node.js dependencies
            if ($this->confirm('Install Node.js dependencies?')) {
                exec('npm install', $output, $return_var);
                $this->info(implode("\n", $output));
            }

            // Build assets
            if ($this->confirm('Build assets?')) {
                exec('npm run build', $output, $return_var);
                $this->info(implode("\n", $output));
            }

            // Restart the queue worker (if applicable)
            if ($this->confirm('Restart the queue worker?')) {
                Artisan::call('queue:restart');
                $this->info('Queue worker restarted.');
            }

            // Clear and cache configurations
            if ($this->confirm('Clear and cache configurations?')) {
                Artisan::call('config:cache');
                Artisan::call('route:cache');
                Artisan::call('view:cache');
                $this->info('Configurations cleared and cached.');
            }

            // Disable maintenance mode
            Artisan::call('up');
            $this->info('Application is now live.');

            $this->info('Deployment completed successfully.');
        } else {
            $this->info('Deployment aborted.');
        }
    }
}
