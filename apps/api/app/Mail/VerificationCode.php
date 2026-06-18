<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    protected Model $user;

    /**
     * Create a new message instance.
     *
     * @param Model $user
     * @return void
     */
    public function __construct(Model $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Verification Code')
            ->markdown('emails.auth.verification-code')
            ->with([
                'userName'          => $this->user->fullname,
                'verificationCode'  => $this->user->verification_code,
            ]);
    }
}
