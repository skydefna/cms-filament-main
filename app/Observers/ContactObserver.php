<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     */
    public function created(Contact $contact): void
    {
        Cache::forget(CacheName::CONTACT->name);
    }

    /**
     * Handle the Contact "updated" event.
     */
    public function updated(Contact $contact): void
    {
        Cache::forget(CacheName::CONTACT->name);
    }

    /**
     * Handle the Contact "deleted" event.
     */
    public function deleted(Contact $contact): void
    {
        Cache::forget(CacheName::CONTACT->name);
    }

    /**
     * Handle the Contact "restored" event.
     */
    public function restored(Contact $contact): void
    {
        Cache::forget(CacheName::CONTACT->name);
    }

    /**
     * Handle the Contact "force deleted" event.
     */
    public function forceDeleted(Contact $contact): void
    {
        Cache::forget(CacheName::CONTACT->name);
    }
}
