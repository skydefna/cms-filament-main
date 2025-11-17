<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class Deploy implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        Log::info('Starting deployment...');

        // Define paths using base_path()
        $basePath = base_path();
        $bashPath = base_path('deploy.sh');

        try {
            // Ensure the deploy.sh script is executable
            Log::info("Making deploy.sh executable: chmod +x {$bashPath}");
            exec("chmod +x {$bashPath}", $output, $returnCode);
            if ($returnCode !== 0) {
                Log::error('Failed to make deploy.sh executable: '.implode("\n", $output));
                throw new \Exception('Failed to make deploy.sh executable');
            }

            // Run the deploy.sh script from the base_path directory
            Log::info("Running deployment script: bash {$bashPath}");
            exec("cd {$basePath} && bash {$bashPath} 2>&1", $output, $returnCode);
            if ($returnCode !== 0) {
                Log::error('Deployment script failed: '.implode("\n", $output));
                throw new \Exception('Deployment script failed');
            }

            Log::info('Deployment completed successfully: '.implode("\n", $output));
        } catch (\Exception $e) {
            Log::error("Deployment error: {$e->getMessage()}");
            throw $e; // Re-throw to allow Laravel queue to handle retries/failures
        }
    }
}
