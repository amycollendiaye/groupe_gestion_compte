<?php

namespace App\Observers;

use Illuminate\Support\Str;

use App\Models\Compte;

class CompteObserver
{
    /**
     * Handle the Compte "created" event.
     */
    public function creating(Compte $compte): void
    {
        if (empty($compte->id)) {
            $compte->id = (string) Str::uuid();
        }
        if (empty($compte->numero_compte)) {
            // Génération d'un numéro unique
            do {
                $numero = 'ORANGEBANK-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            } while (Compte::where('numero_compte', $numero)->exists());

            $compte->numero_compte = $numero;
        } else {
            $compte->numero_compte = 'ORANGEBANK-' . str_replace(' ', '', $compte);
        }
    }

    /**
     * Handle the Compte "updated" event.
     */
    public function updated(Compte $compte): void
    {
        //
    }
    /**
     * Handle the Compte "deleted" event.
     */
    public function deleted(Compte $compte): void
    {
        //
    }

    /**
     * Handle the Compte "restored" event.
     */
    public function restored(Compte $compte): void
    {
        //
    }

    /**
     * Handle the Compte "force deleted" event.
     */
    public function forceDeleted(Compte $compte): void
    {
        //
    }
}
