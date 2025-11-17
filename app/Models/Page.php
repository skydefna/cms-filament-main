<?php

namespace App\Models;

use App\Enums\CacheName;
use App\Observers\PageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $title
 * @property string $year
 * @property string $month
 * @property string $slug
 * @property string $content
 * @property int $is_publish
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\PageFactory factory($count = null, $state = [])
 * @method static Builder<static>|Page isPublish()
 * @method static Builder<static>|Page newModelQuery()
 * @method static Builder<static>|Page newQuery()
 * @method static Builder<static>|Page query()
 * @method static Builder<static>|Page whereContent($value)
 * @method static Builder<static>|Page whereCreatedAt($value)
 * @method static Builder<static>|Page whereId($value)
 * @method static Builder<static>|Page whereIsPublish($value)
 * @method static Builder<static>|Page whereMonth($value)
 * @method static Builder<static>|Page whereSlug($value)
 * @method static Builder<static>|Page whereTitle($value)
 * @method static Builder<static>|Page whereUpdatedAt($value)
 * @method static Builder<static>|Page whereYear($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
#[ObservedBy([PageObserver::class])]
class Page extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'page';

    protected $primaryKey = 'id';

    protected $casts = [
        'aktif' => 'boolean',
    ];

    protected function content(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return Str::replace(search: '@storage', replace: config('filesystems.disks.s3.url'), subject: $value);
            },
            set: function ($value) {
                return Str::replace(search: config('filesystems.disks.s3.url'), replace: '@storage', subject: $value);
            },
        );
    }

    public function scopeIsPublish(Builder $query): Builder
    {
        return $query->where('is_publish', true);
    }

    public function getPageBySlug(string $slug): Page
    {
        return Cache::remember(CacheName::PAGE->name.'-'.$slug, 3600 * 24 * 7, function () use ($slug) {
            return self::query()->where('slug', $slug)
                ->isPublish()
                ->firstOrFail();
        });
    }
}
