<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skpd extends Model
{
    use HasFactory;

    protected $table = 'skpd';
    protected $fillable = ['nama', 'slug'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($skpd) {
            $skpd->slug = Str::slug($skpd->nama);
        });
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
