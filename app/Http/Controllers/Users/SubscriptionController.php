<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\CourseUserSubscription;
use Carbon\Carbon;

class SubscriptionController extends Controller
{

public function buyPlan($plan_id)
{

$plan = SubscriptionPlan::findOrFail($plan_id);

$user_id = auth()->id();

$start = Carbon::now();

$expiry = null;

if($plan->duration_type == 'days'){
$expiry = $start->copy()->addDays($plan->duration_value);
}

if($plan->duration_type == 'weeks'){
$expiry = $start->copy()->addWeeks($plan->duration_value);
}

if($plan->duration_type == 'months'){
$expiry = $start->copy()->addMonths($plan->duration_value);
}

if($plan->duration_type == 'years'){
$expiry = $start->copy()->addYears($plan->duration_value);
}

CourseUserSubscription::create([

'user_id' => $user_id,
'course_id' => $plan->course_id,
'plan_id' => $plan->id,

'start_date' => $start,
'expiry_date' => $expiry,

'payment_status' => 'paid',
'subscription_status' => 'active'

]);

return redirect()
->route('users.dashboard')
->with('success','Course Purchased Successfully');

}

}