<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDemoRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string|null $note
    ) {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('emails.support.demo-request')
            ->with('name', $this->name)
            ->with('email', $this->email)
            ->with('phone', $this->phone)
            ->with('note', $this->note);
    }
}
