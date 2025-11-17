<?php

namespace App\Models;

use App\Enums\CacheName;
use App\Observers\BannerLinkObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $id
 * @property string $url
 * @property string $image
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\BannerLinkFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerLink whereUrl($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
#[ObservedBy([BannerLinkObserver::class])]
class BannerLink extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'banner_link';

    protected $primaryKey = 'id';

    public function getBannerLinks()
    {
        return Cache::rememberForever(CacheName::BANNER_LINK->name, function () {
            return $this
                ->query()
                ->orderBy('sort')
                ->get();
        });
    }
}
