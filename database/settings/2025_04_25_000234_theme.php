<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('theme.primaryColor', '#155DFC');
        $this->migrator->add('theme.secondaryColor', '#00A6F4');
    }
};
