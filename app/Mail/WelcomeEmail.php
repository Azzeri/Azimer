<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @author Mariusz Waloszczyk
 */
class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @author Mariusz Waloszczyk
     */
    public function __construct(
        public string $email,
        public string $password
    ) {
    }

    /**
     * Build the message.
     *
     * @author Mariusz Waloszczyk
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail/welcome-email');
    }
}
