<?php

namespace App\Http\Services;

use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Log;

class TwilloService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new TwilioClient(
            env('TWILIO_SID'),
            env('TWILIO_TOKEN')
        );

        $this->from = env('TWILIO_FROM');
    }

    /**
     * Envoie un SMS via Twilio
     */
    public function sendSms(string $to, string $message): bool
    {
        try {
            $this->client->messages->create($to, [
                'from' => $this->from,
                'body' => $message,
            ]);

            Log::info("📩 SMS envoyé à {$to} : {$message}");
            return true;
        } catch (\Exception $e) {
            Log::error("❌ Erreur envoi SMS Twilio : " . $e->getMessage());
            return false;
        }
    }
}
