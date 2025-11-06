<?php

namespace App\Observers;
use Illuminate\Support\Str;

use App\Models\Admin;

class AdminObserver
{
    /**
     * Handle the Admin "created" event.
     */
    public function creating(Admin $admin): void
    {
        if (empty($admin->id)) {
                $admin->id = (string) Str::uuid();
            }
    }

    /**
     * Handle the Admin "updated" event.
     */
    public function updated(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "deleted" event.
     */
    public function deleted(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "restored" event.
     */
    public function restored(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "force deleted" event.
     */
    public function forceDeleted(Admin $admin): void
    {
        //
    }
}
