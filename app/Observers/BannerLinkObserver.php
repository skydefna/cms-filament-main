<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\BannerLink;
use Illuminate\Support\Facades\Cache;

class BannerLinkObserver
{
    /**
     * Handle the BannerLink "created" event.
     */
    public function created(BannerLink $bannerLink): void
    {
        Cache::forget(CacheName::BANNER_LINK->name);
    }

    /**
     * Handle the BannerLink "updated" event.
     */
    public function updated(BannerLink $bannerLink): void
    {
        Cache::forget(CacheName::BANNER_LINK->name);
    }

    /**
     * Handle the BannerLink "deleted" event.
     */
    public function deleted(BannerLink $bannerLink): void
    {
        Cache::forget(CacheName::BANNER_LINK->name);
    }

    /**
     * Handle the BannerLink "restored" event.
     */
    public function restored(BannerLink $bannerLink): void
    {
        Cache::forget(CacheName::BANNER_LINK->name);
    }

    /**
     * Handle the BannerLink "force deleted" event.
     */
    public function forceDeleted(BannerLink $bannerLink): void
    {
        Cache::forget(CacheName::BANNER_LINK->name);
    }
}
