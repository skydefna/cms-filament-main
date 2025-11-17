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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(-1);
            $table->foreignIdFor(\App\Models\Page::class, 'page_id')
                ->nullable()
                ->constrained('page', 'id')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('url')->nullable();
            $table->string('path')->nullable();
            $table->integer('order')->default(0)->index();
            $table->string('title');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
