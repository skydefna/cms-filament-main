<?php

use Illuminate\Support\Facades\Schedule;

// Schedule::command('app:get-gpr-api-data')->dailyAt('10:00');
// Schedule::command('app:log-worker')->hourly();
Schedule::command('backup:run --only-db --only-to-disk=backup --disable-notifications')->dailyAt('21:00');
Schedule::command('backup:run --only-db --only-to-disk=backup --disable-notifications')->dailyAt('07:00');
Schedule::command('sitemap:generate')->hourly();
