<?php

namespace App\Mail;

use App\Models\ActivationToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResendActivationToken extends Mailable
{
    use Queueable, SerializesModels;

		public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ActivationToken $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resent Activation Email')->view('email.auth.activation');
    }
}
