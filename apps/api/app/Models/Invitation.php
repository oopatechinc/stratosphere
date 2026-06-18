<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    const INVITE_STATUS_INVITED    = 'invited';
    const INVITE_STATUS_REGISTERED = 'registered';

    protected $fillable = [
        'business_id',
        'admin_id',
        'sender_id',
        'role_id',
        'email',
        'status',
        'code',
        'last_email_sent'
    ];

    public function sender()
    {
        return $this->belongsTo('App\Models\Admin', 'sender_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }
}
