<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiDigital extends Model
{
    protected $table = 'dokumentasi_digital';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_path',
    ];
}