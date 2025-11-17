<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Cache;

class SocialMediaObserver
{
    /**
     * Handle the SocialMedia "created" event.
     */
    public function created(SocialMedia $socialMedia): void
    {
        Cache::forget(CacheName::SOCIAL_MEDIA->name);
    }

    /**
     * Handle the SocialMedia "updated" event.
     */
    public function updated(SocialMedia $socialMedia): void
    {
        Cache::forget(CacheName::SOCIAL_MEDIA->name);
    }

    /**
     * Handle the SocialMedia "deleted" event.
     */
    public function deleted(SocialMedia $socialMedia): void
    {
        Cache::forget(CacheName::SOCIAL_MEDIA->name);
    }

    /**
     * Handle the SocialMedia "restored" event.
     */
    public function restored(SocialMedia $socialMedia): void
    {
        Cache::forget(CacheName::SOCIAL_MEDIA->name);
    }

    /**
     * Handle the SocialMedia "force deleted" event.
     */
    public function forceDeleted(SocialMedia $socialMedia): void
    {
        Cache::forget(CacheName::SOCIAL_MEDIA->name);
    }
}
