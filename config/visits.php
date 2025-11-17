<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database Engine & Connection Name
    |--------------------------------------------------------------------------
    |
    | Supported Engines:
    |   \Awssat\Visits\DataEngines\RedisEngine::class,
    |   \Awssat\Visits\DataEngines\EloquentEngine::class
    |
    | We’ll use EloquentEngine so it stores visit data in the database,
    | not in Redis.
    |
    */
    'engine' => \Awssat\Visits\DataEngines\EloquentEngine::class,
    'connection' => env('DB_CONNECTION', 'mysql'), // gunakan koneksi database utama kamu

    /*
    |--------------------------------------------------------------------------
    | Counters periods
    |--------------------------------------------------------------------------
    */
    'periods' => [
        'day',
        'week',
        'month',
        'year',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis prefix (tidak dipakai jika engine = EloquentEngine)
    |--------------------------------------------------------------------------
    */
    'keys_prefix' => 'visits-' . \Illuminate\Support\Str::slug(config('app.name')),

    /*
    |--------------------------------------------------------------------------
    | Remember IP for x seconds
    |--------------------------------------------------------------------------
    |
    | Only one visit per IP during this time window will be counted.
    |
    */
    'remember_ip' => 15 * 60,

    /*
    |--------------------------------------------------------------------------
    | Always return uncached fresh top/low lists
    |--------------------------------------------------------------------------
    */
    'always_fresh' => false,

    /*
    |--------------------------------------------------------------------------
    | Ignore Crawlers
    |--------------------------------------------------------------------------
    */
    'ignore_crawlers' => true,

    /*
    |--------------------------------------------------------------------------
    | Global Ignore Recording
    |--------------------------------------------------------------------------
    |
    | stop recording specific items
    |
    */
    'global_ignore' => ['country', 'refer', 'operatingSystem', 'language'],

];