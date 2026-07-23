<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\Payment;
use App\Models\CourseUserSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{

public function buyPlan($plan_id)
{

if(!Auth::check()){
return redirect()->route('login');
}

$user_id = Auth::id();

$plan = SubscriptionPlan::findOrFail($plan_id);


/*
|--------------------------------------------------------------------------
| Check if already subscribed
|--------------------------------------------------------------------------
*/

$already = CourseUserSubscription::where('user_id',$user_id)
->where('course_id',$plan->course_id)
->where('subscription_status','active')
->first();

if($already){
return back()->with('error','You already purchased this course');
}


/*
|--------------------------------------------------------------------------
| Calculate expiry
|--------------------------------------------------------------------------
*/

$start = Carbon::now();

$expiry = null;

switch ($plan->duration_type) {

case 'days':
$expiry = $start->copy()->addDays($plan->duration_value);
break;

case 'weeks':
case 'months':
$expiry = $start->copy()->addMonths($plan->duration_value);
break;

case 'years':
$expiry = $start->copy()->addYears($plan->duration_value);
break;

default:
$expiry = null;
break;

}


/*
|--------------------------------------------------------------------------
| Payment + Subscription Transaction
|--------------------------------------------------------------------------
*/

DB::beginTransaction();

try{

Payment::create([

'user_id' => $user_id,
'course_id' => $plan->course_id,
'plan_id' => $plan->id,

'amount' => $plan->price,

'payment_method' => 'manual',
'transaction_id' => uniqid('TXN_'),

'status' => 'success'

]);


CourseUserSubscription::create([

'user_id' => $user_id,
'course_id' => $plan->course_id,
'plan_id' => $plan->id,

'start_date' => $start,
'expiry_date' => $expiry,

'payment_status' => 'paid',
'subscription_status' => 'active'

]);

DB::commit();

}catch(\Exception $e){

DB::rollBack();

return back()->with('error','Payment failed. Please try again.');

}

return back()->with('success','Course purchased successfully');

}

}