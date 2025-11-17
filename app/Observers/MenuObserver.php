<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    /**
     * Handle the Menu "created" event.
     */
    public function created(Menu $menu): void
    {
        Cache::forget(CacheName::MENU->name);
    }

    /**
     * Handle the Menu "updated" event.
     */
    public function updated(Menu $menu): void
    {
        Cache::forget(CacheName::MENU->name);
    }

    /**
     * Handle the Menu "deleted" event.
     */
    public function deleted(Menu $menu): void
    {
        Cache::forget(CacheName::MENU->name);
    }

    /**
     * Handle the Menu "restored" event.
     */
    public function restored(Menu $menu): void
    {
        Cache::forget(CacheName::MENU->name);
    }

    /**
     * Handle the Menu "force deleted" event.
     */
    public function forceDeleted(Menu $menu): void
    {
        Cache::forget(CacheName::MENU->name);
    }
}
