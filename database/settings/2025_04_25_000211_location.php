<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('location.find_location', null);
        $this->migrator->add('location.latitude', null);
        $this->migrator->add('location.longitude', null);
        $this->migrator->add('location.address', null);
    }
};
