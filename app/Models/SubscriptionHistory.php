<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SubscriptionHistory extends Model
{
    protected $fillable = [
        'subscription_id',
        'old_start_date',
        'old_expiry_date',
        'new_start_date',
        'new_expiry_date',
        'action'
    ];
}