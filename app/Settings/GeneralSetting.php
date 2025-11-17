<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public ?string $site_name = null;

    public ?string $site_short_name = null;

    public ?string $announcement = null;

    public ?string $primary_logo = null;

    public ?string $secondary_logo = null;

    public ?string $favicon = null;

    public ?string $node_width = null;

    public ?string $node_height = null;

    public ?int $slider_width = null;

    public ?int $slider_height = null;

    public static function group(): string
    {
        return 'general';
    }
}
