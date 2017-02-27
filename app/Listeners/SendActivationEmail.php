<?php

namespace App\Listeners;

use Mail;
use App\Events\UserRegistered;
use App\Mail\SendActivationToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationEmail
{
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
     * @param  UserRegistered  $event
     * @return void
     */

		public function handle($event)
    {
      // Sending Email to a registered user
      Mail::to($event->user)->queue(new SendActivationToken($event->user->activationToken));
    }
}
