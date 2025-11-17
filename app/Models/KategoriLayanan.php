<?php

namespace App\Models;

use App\Observers\KategoriLayananObserver;
use App\Observers\PostCategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $category
 * @property string $name
 * @property string|null $slug
 * @property string $deskripsi_kategori
 * @property int $active
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\PostCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan query()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriLayanan whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
#[ObservedBy([KategoriLayananObserver::class])]

class KategoriLayanan extends Model
{
    protected $table = 'kategori_layanan';

    protected $fillable = [
        'category',
        'name',
        'slug',
        'deskripsi_kategori',
        'active',
        'sort',
    ];
}