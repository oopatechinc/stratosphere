<?php

namespace App\Mail;

use App\Models\Staff;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TenantRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Tenant $tenant, public Staff $staff)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tenant.registered')
            ->with([
                'contactName'  => $this->staff->first_name,
                'tenantName' => $this->tenant->name,
                'tenantStoreUrl' => $this->tenant->id . '/' . $this->tenant->name
            ]);
    }
}
