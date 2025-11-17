<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPublikasi extends Model
{
    protected $table = 'kategori_publikasi';

    protected $guarded = [];

    public function publikasi()
    {
        return $this->hasMany(Publikasi::class, 'kategori_publikasi_id');
    }
}
