<?php

use App\Settings\GeneralSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $setting = new GeneralSetting;
        $setting->slider_width = 21;
        $setting->slider_height = 8;
        $setting->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
