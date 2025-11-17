<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:log-worker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logging Testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::debug('worker log');
    }
}
