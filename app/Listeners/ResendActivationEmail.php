<?php

namespace App\Listeners;

use Mail;
use App\Mail\ResendActivationToken;
use App\Events\ResendActivation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResendActivationEmail
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
     * @param  ResendActivation  $event
     * @return void
     */
    public function handle(ResendActivation $event)
    {
			Mail::to($event->user)->send(new ResendActivationToken($event->user->activationToken));
    }
}
