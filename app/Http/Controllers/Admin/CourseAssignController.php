<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseAssignController extends Controller
{

/*
|--------------------------------------------------------------------------
| LIST ASSIGNMENTS
|--------------------------------------------------------------------------
*/

public function index(Request $request)
{
    $search = $request->query('search');
    
    $query = DB::table('course_user_subscriptions')
        ->leftJoin('users','users.id','=','course_user_subscriptions.user_id')
        ->leftJoin('courses','courses.id','=','course_user_subscriptions.course_id')
        ->leftJoin('subscription_plans','subscription_plans.id','=','course_user_subscriptions.plan_id')
        ->select(
            'course_user_subscriptions.*',
            'users.name as user_name',
            'courses.title as course_title',
            'subscription_plans.plan_name',
            'course_user_subscriptions.duration_type',
            'course_user_subscriptions.duration_value',
            'course_user_subscriptions.price'
        );
        
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('users.name', 'like', "%{$search}%")
              ->orWhere('courses.title', 'like', "%{$search}%")
              ->orWhere('subscription_plans.plan_name', 'like', "%{$search}%");
        });
    }

    $assignments = $query->orderBy('course_user_subscriptions.id', 'desc')->paginate(10)->withQueryString();

    return view('admin.course_assign.index',compact('assignments'));
}


/*
|--------------------------------------------------------------------------
| CREATE PAGE
|--------------------------------------------------------------------------
*/

public function create()
{

$users = User::all();
$courses = Course::all();
$plans = SubscriptionPlan::all();

return view('admin.course_assign.create',compact(
'users',
'courses',
'plans'
));

}


/*
|--------------------------------------------------------------------------
| STORE ASSIGNMENT
|--------------------------------------------------------------------------
*/

public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'course_id' => 'required|exists:courses,id',
        'course_type' => 'required|in:free,paid',
        'duration_value' => 'nullable|integer|min:1',
        'duration_type' => 'nullable|in:days,weeks,months,years,lifetime',
    ]);

    $payment_status = $request->course_type;
    $start_date = date('Y-m-d');
    $expiry_date = null;
    $duration_value = $request->duration_value;
    $duration_type = $request->duration_type;

    if ($payment_status == 'paid') {
        $duration = (int) ($duration_value ?? 1);
        if ($duration_type == 'days') {
            $expiry_date = date('Y-m-d', strtotime($start_date . " + $duration days"));
        } elseif ($duration_type == 'weeks') {
            $expiry_date = date('Y-m-d', strtotime($start_date . " + $duration weeks"));
        } elseif ($duration_type == 'months') {
            $expiry_date = date('Y-m-d', strtotime($start_date . " + $duration months"));
        } elseif ($duration_type == 'years') {
            $expiry_date = date('Y-m-d', strtotime($start_date . " + $duration years"));
        } elseif ($duration_type == 'lifetime') {
            $expiry_date = null;
        }
    } else {
        $duration_value = null;
        $duration_type = null;
    }

    DB::table('course_user_subscriptions')->insert([
        'user_id' => $request->user_id,
        'course_id' => $request->course_id,
        'plan_id' => null,
        'price' => $request->price ?? 0,
        'total_amount' => $request->price ?? 0,
        'paid_amount' => $payment_status == 'paid' ? ($request->price ?? 0) : 0,
        'remaining_amount' => 0,
        'status' => $payment_status == 'paid' ? 'paid' : 'free',
        'start_date' => $start_date,
        'expiry_date' => $expiry_date,
        'duration_value' => $duration_value,
        'duration_type' => $duration_type,
        'payment_status' => $payment_status,
        'subscription_status' => 'active',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Also sync course_user pivot table for Eloquent relationship
    DB::table('course_user')->updateOrInsert(
        ['course_id' => $request->course_id, 'user_id' => $request->user_id],
        ['status' => 'active', 'updated_at' => now(), 'created_at' => now()]
    );

    return redirect()
        ->route('admin.course-assign.index')
        ->with('success', 'Course Assigned Successfully');
}


/*
|--------------------------------------------------------------------------
| EDIT PAGE
|--------------------------------------------------------------------------
*/

public function edit($id)
{

$assignment = DB::table('course_user_subscriptions')
->where('id',$id)
->first();

$users = User::all();
$courses = Course::all();
$plans = SubscriptionPlan::all();

return view('admin.course_assign.edit',compact(
'assignment',
'users',
'courses',
'plans'
));

}


/*
|--------------------------------------------------------------------------
| UPDATE ASSIGNMENT
|--------------------------------------------------------------------------
*/

public function update(Request $request, $id)
{

$assignment = DB::table('course_user_subscriptions')
->where('id',$id)
->first();

$payment_status = $request->course_type;

$start_date = $request->start_date ?? $assignment->start_date;

$expiry_date = null;

$duration_value = $request->duration_value;
$duration_type = $request->duration_type;

$price = $request->price;


if($payment_status == 'paid'){

$duration = (int)$duration_value;

if($duration_type == 'days'){
$expiry_date = date('Y-m-d', strtotime($start_date." + $duration days"));
}

if($duration_type == 'weeks'){
$expiry_date = date('Y-m-d', strtotime($start_date." + $duration weeks"));
}

if($duration_type == 'months'){
$expiry_date = date('Y-m-d', strtotime($start_date." + $duration months"));
}

if($duration_type == 'years'){
$expiry_date = date('Y-m-d', strtotime($start_date." + $duration years"));
}

}else{

$duration_value = null;
$duration_type = null;
$expiry_date = null;
$price = null;

}

DB::table('course_user_subscriptions')
->where('id',$id)
->update([

'user_id'=>$request->user_id,
'course_id'=>$request->course_id,

'price'=>$price,
'total_amount'=>$price,
'paid_amount'=>$payment_status == 'paid' ? $price : 0,
'remaining_amount'=>0,
'status'=>$payment_status == 'paid' ? 'paid' : 'unpaid',

'duration_value'=>$duration_value,
'duration_type'=>$duration_type,

'start_date'=>$start_date,
'expiry_date'=>$expiry_date,

'payment_status'=>$payment_status,

'subscription_status'=>$request->status ? 'active' : 'inactive',

'updated_at'=>now()

]);

return redirect()
->route('admin.course-assign.index')
->with('success','Assignment Updated Successfully');

}

/*
|--------------------------------------------------------------------------
| DELETE ASSIGNMENT
|--------------------------------------------------------------------------
*/

public function destroy($id)
{

DB::table('course_user_subscriptions')
->where('id',$id)
->delete();

return redirect()
->route('admin.course-assign.index')
->with('success','Assignment Deleted');

}

}