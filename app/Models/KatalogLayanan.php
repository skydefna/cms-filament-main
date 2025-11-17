<?php

namespace App\Models;

use App\Models\SuratPermohonan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KatalogLayanan extends Model
{
    use HasFactory;

    protected $table = 'katalog_layanan';

    protected $fillable = [
        'deskripsi', 
        'status_layanan', 
    ];
    public function suratPermohonan()
    {
        return $this->belongsTo(SuratPermohonan::class);
    }
}