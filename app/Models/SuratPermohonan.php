<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPermohonan extends Model
{
    use HasFactory;

    protected static function booted()
{
    static::creating(function ($surat) {
        if (auth()->check() && empty($surat->skpd_id)) {
            $surat->skpd_id = auth()->user()->skpd_id;
        }
    });
}

    protected $table = 'surat_permohonan';

    protected $fillable = [
        'skpd_id',
        'kategori_layanan_id',
        'nama_pemohon',
        'jabatan',
        'deskripsi_kebutuhan',
        'file_surat',
        'status',
        'user_id',
    ];
    protected $attributes = [
        'status' => 'Menunggu',
    ];
    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'skpd_id');
    }

    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kategori_layanan_id');
    }
}