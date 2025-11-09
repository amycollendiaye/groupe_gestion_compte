<?php

namespace App\Observers;

use Illuminate\Support\Str;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function creating(User $user): void
    {
        if (empty($user->id)) {
            $user->id = (string) Str::uuid();

               if (empty($user->login)) {
            $nom = strtolower(preg_replace('/\s+/', '', $user->nom));
            $prenom = strtolower(preg_replace('/\s+/', '', $user->prenom));
            $baseLogin = $prenom . $nom; // ex: amycollendiaye
            $domaine = '@orangebank.com';

            do {
                $random = rand(10, 99);
                $login = $baseLogin . $random . $domaine;
            } while (User::where('login', $login)->exists());

            $user->login = $login;
        }
            if (empty($user->password)) {
            $user->password = Hash::make(Str::random(10));
        }
        }
    }
    public function created(){
        
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
