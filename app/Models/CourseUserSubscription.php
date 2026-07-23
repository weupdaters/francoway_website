<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseUserSubscription extends Model
{
    protected $fillable = [
    'user_id',
    'course_id',
    'plan_id',
    'duration_value',
    'duration_type',
    'start_date',
    'expiry_date',
    'payment_status',
    'subscription_status',
    'total_amount',
    'paid_amount',
    'remaining_amount',
    'status',
    'payment_method',
    'paid_by',
    'paid_at',
    ];

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class, 'subscription_id');
    }
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected $appends = ['days_left', 'plan_status'];

public function getDaysLeftAttribute()
{
    if (!$this->expiry_date) return null;
    return now()->diffInDays($this->expiry_date, false);
}

public function getPlanStatusAttribute()
{
    if (!$this->expiry_date) return 'unlimited';

    $days = $this->days_left;

    if ($days < 0) return 'expired';
    if ($days == 0) return 'today';
    return 'active';
}
public function payments()
{
    return $this->hasMany(Payment::class, 'subscription_id');
}

}
