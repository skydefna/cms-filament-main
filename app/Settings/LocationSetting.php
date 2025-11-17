<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LocationSetting extends Settings
{
    public ?string $find_location = null;

    public ?float $latitude = null;

    public ?float $longitude = null;

    public ?string $address = null;

    public static function group(): string
    {
        return 'location';
    }
}
