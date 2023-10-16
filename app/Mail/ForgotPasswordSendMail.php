<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class ForgotPasswordSendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    protected $firstName;
    /**
     * Create a new message instance.
     */
    public function __construct($url, $firstName = null)
    {
        $this->url = $url;
        $this->firstName = $firstName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password Send Mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->markdown('mail.password_reset')->with(
            [
                'firstName' => $this->firstName,
                'url' => $this->url
            ]
        );
    }
}
