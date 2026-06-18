<?php

namespace App\Mail;

use App\Models\Staff;
use App\Models\Tenant;
use App\Models\Invitation;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly Model $sender,
        private readonly Invitation $invitation,
        private readonly Tenant $tenant
    ) {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $completionUrl = config('platform.admin_url') . '/register?email=' . $this->invitation->email . '&code=' . $this->invitation->code;
        return $this->markdown('emails.admin.invited')
            ->subject('You have been invited!')
            ->with([
                'senderName'  => $this->sender->full_name,
                'tenantName' => $this->tenant->name,
                'completionUrl' => $completionUrl,
                'invitationCode' => $this->invitation->code
            ]);
    }
}
