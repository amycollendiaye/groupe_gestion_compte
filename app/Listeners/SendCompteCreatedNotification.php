<?php

namespace App\Listeners;

use App\Events\CompteCreated;
use App\Mail\CompteCreatedMail;
use App\Http\Services\TwilioService;
use App\Http\Services\TwilloService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class SendCompteCreatedNotification
{
    protected $twilioService;

    public function __construct(TwilloService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function handle(CompteCreated $event)
    {
        Log::info('Listener SendCompteCreatedNotification appelé');
        $user = $event->user;

        if ($event->isClientNew) {
            // 🔹 Envoi Email
            Mail::to($user->email)->send(new CompteCreatedMail($event->compte,$user));

            // 🔹 Envoi SMS de bienvenue
            $this->twilioService->sendSms(
                $user->telephone,
                "Bienvenue chez Orange Bank ! Votre compte a été créé avec succès 🎉"
            );
        } else {
            // 🔹 Envoi SMS de confirmation
            $this->twilioService->sendSms(
                $user->telephone,
                "Votre nouveau compte a été ajouté avec succès à votre profil Orange Bank."
            );
        }
    }
}
