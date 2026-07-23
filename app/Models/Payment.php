<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
use App\Models\SubscriptionPlan;
use App\Models\CourseAssignment;
use App\Models\SubscriptionHistory;
use App\Models\CourseUserSubscription;



class Payment extends Model
{
protected $fillable = [
    'user_id',
    'subscription_id',
    'course_id',
    'plan_id',
    'assignment_id',
    'transaction_id',
    'amount',
    'payment_method',
    'paid_by',
    'paid_at',
    'status',
];

public function user()
{
return $this->belongsTo(User::class);
}
public function course()
{
return $this->belongsTo(Course::class);
}
public function plan()
{
return $this->belongsTo(SubscriptionPlan::class);
}
public function assignment()
{
return $this->belongsTo(CourseAssignment::class, 'assignment_id');
}
public function history()
{
return $this->hasOne(SubscriptionHistory::class, 'payment_id');
}
public function subscription()
{
    return $this->belongsTo(\App\Models\CourseUserSubscription::class, 'subscription_id');
}
}
