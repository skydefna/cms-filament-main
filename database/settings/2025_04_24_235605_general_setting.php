<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', config('app.name'));
        $this->migrator->add('general.site_short_name', null);
        $this->migrator->add('general.announcement', null);
        $this->migrator->add('general.primary_logo', null);
        $this->migrator->add('general.secondary_logo', null);
        $this->migrator->add('general.favicon', null);
    }
};
