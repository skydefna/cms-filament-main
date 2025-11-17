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
        Schema::create('banner_link', function (Blueprint $table) {
            $table->uuid('id')->primary(); // char(36) as UUID
            $table->string('url')->nullable(false); // varchar(255), not nullable
            $table->string('image')->nullable(false); // varchar(255), not nullable
            $table->integer('sort')->default(0); // int, not nullable, default 0
            $table->timestamps(); // created_at and updated_at, nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_link');
    }
};
