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
        Schema::create('surat_permohonan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skpd_id')->nullable()->constrained('skpd')->nullOnDelete();
            $table->foreignId('kategori_layanan_id')->nullable()->constrained('kategori_layanan')->nullOnDelete();
            $table->string('nama_pemohon');
            $table->string('jabatan')->nullable();            
            $table->string('nomor_aktif');
            $table->text('deskripsi_kebutuhan')->nullable();            
            $table->string('file_surat')->nullable();
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_permohonan');
    }
};
