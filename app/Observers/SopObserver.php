<?php

namespace App\Observers;

use App\Models\Sop;

class SopObserver
{
    public function creating(Sop $sop): void
    {

    }
    /**
     * Handle the Sop "created" event.
     */
    public function created(Sop $sop): void
    {
        //
    }

    /**
     * Handle the Sop "updated" event.
     */
    public function updated(Sop $sop): void
    {
        //
    }

    /**
     * Handle the Sop "deleted" event.
     */
    public function deleted(Sop $sop): void
    {
        //
    }

    /**
     * Handle the Sop "restored" event.
     */
    public function restored(Sop $sop): void
    {
        //
    }

    /**
     * Handle the Sop "force deleted" event.
     */
    public function forceDeleted(Sop $sop): void
    {
        //
    }
}
