<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.slider_width', 21);
        $this->migrator->add('general.slider_height', 7);
    }
};
