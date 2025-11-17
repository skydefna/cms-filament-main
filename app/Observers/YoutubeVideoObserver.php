<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\YoutubeVideo;
use Illuminate\Support\Facades\Cache;

class YoutubeVideoObserver
{
    /**
     * Handle the YoutubeVideo "created" event.
     */
    public function created(YoutubeVideo $youtubeVideo): void
    {
        Cache::forget(CacheName::YOUTUBE->name);
    }

    /**
     * Handle the YoutubeVideo "updated" event.
     */
    public function updated(YoutubeVideo $youtubeVideo): void
    {
        Cache::forget(CacheName::YOUTUBE->name);
    }

    /**
     * Handle the YoutubeVideo "deleted" event.
     */
    public function deleted(YoutubeVideo $youtubeVideo): void
    {
        Cache::forget(CacheName::YOUTUBE->name);
    }

    /**
     * Handle the YoutubeVideo "restored" event.
     */
    public function restored(YoutubeVideo $youtubeVideo): void
    {
        Cache::forget(CacheName::YOUTUBE->name);
    }

    /**
     * Handle the YoutubeVideo "force deleted" event.
     */
    public function forceDeleted(YoutubeVideo $youtubeVideo): void
    {
        Cache::forget(CacheName::YOUTUBE->name);
    }
}
