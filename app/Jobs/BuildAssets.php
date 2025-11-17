<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class BuildAssets implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        // check if colors.json exists
        if (! file_exists(base_path('colors.json'))) {
            // if it does not exist, create it. copy the content from colors-template.json with exec
            exec('cp '.base_path('colors-template.json').' '.base_path('colors.json'));
        }
        exec('cd '.base_path().' && npm run build', $output, $return_var);
        if ($return_var !== 0) {
            Log::error('Build failed', ['output' => $output]);
            throw new \RuntimeException('Build failed');
        }
        Artisan::call('settings:clear-cache');
        Log::info('Build succeeded', ['output' => $output]);
    }
}
