<?php

namespace App\Mail;

use App\Models\Compte;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompteCreatedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public  $compte;


    /**
     * Create a new message instance.
     */
    public function __construct(Compte $compte, User $user)
    {
        $this->compte = $compte;
        $this->user = $user;
    }


    public  function build()
    {
        return  $this->subject('Votre compte Orange Bank a été créé')->view('emails.compte_created');
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.compte_created',  // Utilisez la vue correcte
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
