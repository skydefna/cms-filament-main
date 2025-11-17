<?php

namespace App\Models;

use App\Enums\CacheName;
use App\Observers\SocialMediaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string|null $type
 * @property string|null $image
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\SocialMediaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialMedia whereUrl($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
#[ObservedBy([SocialMediaObserver::class])]
class SocialMedia extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'social_media';

    protected $primaryKey = 'id';

    public function getSocialMedia()
    {
        return Cache::rememberForever(CacheName::SOCIAL_MEDIA->name, function () {
            return $this->query()
                ->orderBy('sort')
                ->get();
        });
    }
}
