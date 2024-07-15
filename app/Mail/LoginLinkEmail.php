<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $loginLink;

    /**
     * Create a new message instance.
     *
     * @param  string  $loginLink
     * @return void
     */
    public function __construct($loginLink)
    {
        $this->loginLink = $loginLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.login-link')
                    ->subject('Your Login Link') // Subject of the email
                    ->with([
                        'loginLink' => $this->loginLink,
                    ]);
    }
}
