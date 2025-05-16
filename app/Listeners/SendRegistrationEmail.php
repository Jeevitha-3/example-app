<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRegistrationEmail 
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    /**
     * Handle the event.    
     *
     * @param  object  $event
     * @return void
     */
    
    public function handle(UserRegistered $event)
    {
        Mail::to($event->userData['email'])
            ->send(new RegistrationConfirmation($event->userData));
    }
}
