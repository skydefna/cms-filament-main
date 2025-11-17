<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\KategoriLayanan;
use Illuminate\Support\Facades\Cache;

class KategoriLayananObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(KategoriLayanan $post): void
    {
        Cache::forget(CacheName::KATEGORI_LAYANAN->name);        
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(KategoriLayanan $post): void
    {
        Cache::forget(CacheName::KATEGORI_LAYANAN->name);    
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(KategoriLayanan $post): void
    {
        Cache::forget(CacheName::KATEGORI_LAYANAN->name);    
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(KategoriLayanan $post): void
    {
        Cache::forget(CacheName::KATEGORI_LAYANAN->name);        
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(KategoriLayanan $post): void
    {
        Cache::forget(CacheName::KATEGORI_LAYANAN->name);        
    }
}
