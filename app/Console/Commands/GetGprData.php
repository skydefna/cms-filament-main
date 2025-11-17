<?php

namespace App\Console\Commands;

use App\Enums\CacheName;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetGprData extends Command
{
    protected string $gprApiUrl = 'https://widget.komdigi.go.id/data/latest/gpr.xml';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-gpr-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get API Data Dari GPR Komdigi';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Cache::forget(CacheName::GPR->name);
        Cache::rememberForever(CacheName::GPR->name, function () {

            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 0);
            $response = Http::get($this->gprApiUrl);
            if ($response->successful()) {
                $xmlArray = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xmlArray);
                $array = json_decode($json, true);
                $data = $array['item'];

                if ($data) {
                    Cache::forget(CacheName::GPR->name);
                    $this->info('berhasil mengambil data gpr');
                } else {
                    $this->info('gagal mengambil data gpr');
                }

                return $data;
            }
            $response->onError(fn ($message) => Log::error($message));

            return null;
        });
    }
}
