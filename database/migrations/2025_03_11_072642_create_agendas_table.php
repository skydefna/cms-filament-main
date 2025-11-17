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
        Schema::dropIfExists('agenda');
        Schema::create('agenda', function (Blueprint $table) {
            $table->id(); // id (char(36), primary key)
            $table->string('title', 255); // judul (varchar(255), not null)
            $table->string('slug', 255); // slug (varchar(255), not null)
            $table->string('place', 255)->nullable(); // tempat (varchar(255), nullable)
            $table->double('latitude')->nullable(); // latitude (double, nullable)
            $table->double('longitude')->nullable(); // longitude (double, nullable)
            $table->text('description')->nullable(); // deskripsi (text, nullable)
            $table->date('date_start'); // mulai (date, not null)
            $table->date('date_end')->nullable(); // akhir (date, nullable)
            $table->time('time_start'); // waktu_mulai (time, not null)
            $table->time('time_end')->nullable(); // waktu_akhir (time, nullable)
            $table->timestamps(); // created_at dan updated_at (timestamp, nullable)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
