<?php

namespace App\Models;

use App\Enums\CacheName;
use App\Observers\SliderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $id
 * @property string $name
 * @property string|null $desc
 * @property string $image
 * @property int $is_active
 * @property int $sort
 * @property string|null $hyperlink
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\SliderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereHyperlink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
#[ObservedBy([SliderObserver::class])]
class Slider extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'sliders';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function getCachedSlider()
    {
        return Cache::rememberForever(CacheName::SLIDER->name, function () {
            return $this->newQuery()
                ->where('is_active', '=', true)
                ->orderBy('sort')
                ->get();
        });
    }
}
