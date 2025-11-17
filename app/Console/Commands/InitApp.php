<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class InitApp extends Command
{
    /**
     * The name and signature of the console command with force flag.
     *
     * @var string
     */
    protected $signature = 'app:init {--force : Force the command to run without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import database from a .sql file and make colors.json file';

    /**
     * Execute the console command.
     */

    // add force flag

    public function handle(): bool
    {
        $force = $this->option('force');

        if (app()->environment('production') && ! $force) {
            $runInit = $this->confirm('Are you sure you want to run this command in production?', false);
        } else {
            $runInit = true;
        }
        if ($runInit) {
            try {
                // copy tabalong_xs.png to object storage
                Storage::disk('public')->put('tabalong_xs.png', file_get_contents(storage_path('app/private/tabalong_xs.png')));
                Artisan::call('db:wipe', ['--force' => true]);
                Artisan::call('settings:clear-cache');
                // check if colors.json exists
                if (! file_exists(base_path('colors.json'))) {
                    // if does not exist, create it. copy the content from colors-template.json with exec
                    exec('cp '.base_path('colors-template.json').' '.base_path('colors.json'));
                }
                // Get the file path from the command argument
                $filePath = database_path('init.sql');

                // Check if file exists
                if (! file_exists($filePath)) {
                    $this->error("File not found: {$filePath}");

                    return 1;
                }

                // Get database configuration
                $database = config('database.connections.mysql.database');
                $username = config('database.connections.mysql.username');
                $password = config('database.connections.mysql.password');
                $host = config('database.connections.mysql.host');

                // Build the MySQL command
                $command = sprintf(
                    'mysql -h %s -u %s %s %s < %s',
                    $host,
                    $username,
                    $password ? "-p{$password}" : '',
                    $database,
                    $filePath
                );
                // dd($command);

                // Execute the command
                $this->info('Importing database...');
                exec($command, $output, $returnVar);

                if ($returnVar === 0) {
                    $this->info('Database imported successfully from '.$filePath);
                    Artisan::call('migrate');
                    Artisan::call('optimize:clear');
                    Artisan::call('settings:clear-cache');

                    return 0;
                } else {
                    $this->error('Error importing database');

                    return 1;
                }
            } catch (\Exception $e) {
                $this->error('Error: '.$e->getMessage());

                return 0;
            }
        }
        $this->info('Command aborted');

        return false;
    }
}
