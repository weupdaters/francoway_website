<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionActivityLog extends Model
{
    protected $fillable = [
        'subscription_id',
        'user_id',
        'course_id',
        'action',
        'message',
        'meta',
        'logged_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'logged_at' => 'datetime',
    ];

    public function subscription()
    {
        return $this->belongsTo(CourseUserSubscription::class, 'subscription_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}