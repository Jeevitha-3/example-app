<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class RegistrationConfirmation extends Mailable
{
    
    use Queueable, SerializesModels;

    public $userData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
         return $this->subject('Thank You for Registering')
                    ->view('emails.registration_confirmation')
                    ->with('data', $this->userData);
    }
}
