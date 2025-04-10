<?php

namespace App\Mail;



class CandidatureStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $candidature;

    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
    }

    public function build()
    {
        return $this->subject('Mise à jour de votre candidature')
                    ->view('emails.candidature-status');
    }
}