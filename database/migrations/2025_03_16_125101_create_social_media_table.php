<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->uuid('id')->primary(); // char(36) as UUID
            $table->string('name'); // varchar(255), not nullable
            $table->string('url'); // varchar(255), not nullable
            $table->integer('sort')->default(0); // int, not nullable, default 0
            $table->string('image'); // varchar(255), not nullable
            $table->timestamps(); // created_at and updated_at, nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
