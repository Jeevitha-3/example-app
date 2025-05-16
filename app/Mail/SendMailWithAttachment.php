<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailWithAttachment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @return void
     */
    public function __construct()
    {
        // $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
       $photoPath = public_path('photo.jpg');

    if (!file_exists($photoPath)) {
        throw new \Exception("Attachment not found at $photoPath");
    }

    return $this->view('emails.custom')
        ->subject('Laravel email with attachment')
        ->attach($photoPath, [
            'as' => 'photo.jpg',
            'mime' => 'image/jpeg',
        ]);


    }
}



