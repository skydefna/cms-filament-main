<?php

namespace App\Models;

use App\Enums\CacheName;
use App\Observers\YoutubeVideoObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $id
 * @property string $title
 * @property string $url
 * @property string|null $thumbnail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\YoutubeVideoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|YoutubeVideo whereUrl($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
#[ObservedBy([YoutubeVideoObserver::class])]
class YoutubeVideo extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'youtube_videos';

    protected $primaryKey = 'id';

    public function getLatestVideos($limit = 3)
    {
        return Cache::rememberForever(CacheName::YOUTUBE->name, function () use ($limit) {
            return $this->query()
                ->latest()
                ->take($limit)
                ->get();
        });
    }

    public function getPaginatedVideos($perpage = 6, ?string $keyword = null): LengthAwarePaginator
    {
        return $this->query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', "%$keyword%");
            })
            ->latest()
            ->paginate($perpage);
    }
}
