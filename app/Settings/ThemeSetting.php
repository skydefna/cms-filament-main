<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSetting extends Settings
{
    public ?string $primaryColor = null;

    public ?string $secondaryColor = null;

    public ?string $theme = null;

    public static function group(): string
    {
        return 'theme';
    }
}
