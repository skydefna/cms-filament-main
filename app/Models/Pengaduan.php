<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [        
        'deskripsi',
        'status_aduan', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function suratPermohonan()
    {
        return $this->belongsTo(SuratPermohonan::class);
    }
    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'skpd_id');
    }    
}
