<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.node_height', 100);
        $this->migrator->add('general.node_width', 175);
    }
};
