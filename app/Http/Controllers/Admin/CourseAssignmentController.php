<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseAssignment;
use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use App\Models\CourseUserSubscription;
use App\Models\SubscriptionHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CourseAssignmentController extends Controller
{
    // =========================
    // LIST (FILTER + SEARCH + SORT)
    // =========================
    public function index(Request $request)
    {
        $query = CourseUserSubscription::with(['user','course']);

        // 🔍 SEARCH (User / Course)
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->whereHas('user', function($u) use ($request) {
                    $u->where('name','like','%'.$request->search.'%');
                })
                ->orWhereHas('course', function($c) use ($request) {
                    $c->where('title','like','%'.$request->search.'%');
                });
            });
        }

        // 🎯 PAYMENT FILTER
        if ($request->payment) {
            $query->where('status', $request->payment);
        }

        // ↕ SORT
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $assignments = $query->paginate(10)->withQueryString();

        // 🔥 PLAN STATUS + DAYS LEFT
        foreach ($assignments as $a) {

            $subscription = CourseUserSubscription::where('user_id', $a->user_id)
                ->where('course_id', $a->course_id)
                ->latest()
                ->first();

            if ($subscription) {

                $a->daysLeft = $subscription->expiry_date
                    ? now()->diffInDays($subscription->expiry_date, false)
                    : null;

                if (!$subscription->expiry_date) {
                    $a->plan_status = 'unlimited';
                } elseif ($a->daysLeft < 0) {
                    $a->plan_status = 'expired';
                } elseif ($a->daysLeft == 0) {
                    $a->plan_status = 'today';
                } else {
                    $a->plan_status = 'active';
                }

            } else {
                $a->daysLeft = null;
                $a->plan_status = 'unlimited';
            }
        }

        return view('admin.History_Page.index', compact('assignments'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        

        return view('admin.assignments.create', compact('users','courses'));
    }

    // =========================
    // STORE ASSIGNMENT
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'course_id' => 'required',
        ]);

        $course = Course::findOrFail($request->course_id);

        CourseUserSubscription::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'price' => $course->price ?? 0,
            'total_amount' => $course->price ?? 0,
            'paid_amount' => 0,
            'remaining_amount' => $course->price ?? 0,
            'status' => 'unpaid',
            'payment_method' => $request->payment_method,
            'paid_by' => 'admin',
            'paid_at' => now(), 
        ]);

        return redirect()->route('admin.assignments.index')
            ->with('success','Course Assigned Successfully');
    }

    // =========================
    // SHOW DETAILS
    // =========================
    public function show($id)
    {
        $assignment = CourseUserSubscription::with('user','course','payments')->findOrFail($id);

        return view('admin.History_Page.show', compact('assignment'));
    }

public function addPayment(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required'
    ]);

    $assignment = CourseUserSubscription::findOrFail($id);

    // ✅ SAVE PAYMENT
    Payment::create([
        'user_id' => $assignment->user_id,
        'subscription_id' => $assignment->id, // ✅ correct
        'amount' => $request->amount,
        'payment_method' => $request->payment_method,
        'paid_by' => 'admin',
        'paid_at' => now(),
        'status' => 'success'
    ]);

    // =========================
    // AMOUNT LOGIC
    // =========================
    $assignment->paid_amount += $request->amount;
    $assignment->remaining_amount = $assignment->total_amount - $assignment->paid_amount;

    if ($assignment->remaining_amount <= 0) {

        $startDate = now();
        $expiryDate = now()->addMonth();

        $assignment->update([
            'start_date' => $startDate,
            'expiry_date' => $expiryDate,
            'subscription_status' => 'active',
            'payment_status' => 'paid'
        ]);

    } else {
        $assignment->payment_status = 'pending';
    }

    $assignment->save();

    return back()->with('success','Payment Added Successfully');
}

    // =========================
    // RENEW SUBSCRIPTION
    // =========================
    public function renew($id)
    {
        $sub = CourseUserSubscription::findOrFail($id);

        $start = now();
        $expiry = now()->addMonth();

        SubscriptionHistory::create([
            'subscription_id' => $sub->id,
            'old_start_date' => $sub->start_date,
            'old_expiry_date' => $sub->expiry_date,
            'new_start_date' => $start,
            'new_expiry_date' => $expiry,
            'action' => 'renewed'
        ]);

        $sub->update([
            'start_date' => $start,
            'expiry_date' => $expiry,
            'subscription_status' => 'active'
        ]);

        return back()->with('success','Subscription Renewed');
    }

    public function inactive($id)
{
    $sub = CourseUserSubscription::findOrFail($id);

    $sub->subscription_status = 'cancelled'; // ya inactive bhi kar sakte ho
    $sub->save();

    return back()->with('success', 'Course Inactivated Successfully');
}

public function active($id)
{
    $sub = CourseUserSubscription::findOrFail($id);

    $sub->subscription_status = 'active';
    $sub->save();

    return back()->with('success', 'Course Activated Successfully');
}

}