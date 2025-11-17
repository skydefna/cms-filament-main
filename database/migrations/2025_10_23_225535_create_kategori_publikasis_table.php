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
        Schema::dropIfExists('kategori_publikasi');

        Schema::create('kategori_publikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        $kategoriId = \Illuminate\Support\Facades\DB::table('kategori_publikasi')
            ->insertGetId([
                'nama' => 'umum',
            ]);

        $hasCol = Schema::hasColumn('publikasi', 'kategori_publikasi_id');
        if ($hasCol) {
            Schema::dropColumns('publikasi', 'kategori_publikasi_id');
        }

        Schema::table('publikasi', function (Blueprint $table) {
            $table->foreignId('kategori_publikasi_id')
                ->nullable()
                ->after('id');
        });

        \Illuminate\Support\Facades\DB::table('publikasi')->update([
            'kategori_publikasi_id' => $kategoriId,
        ]);
    }
};
