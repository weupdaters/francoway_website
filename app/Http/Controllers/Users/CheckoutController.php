<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUserSubscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout($id)
    {
        $course = Course::findOrFail($id);

        // Check if user is already enrolled
        $alreadySubscribed = CourseUserSubscription::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('subscription_status', 'active')
            ->first();

        if ($alreadySubscribed) {
            return redirect()->route('users.lessons.index', $course->id)
                ->with('info', 'You are already enrolled in this course.');
        }

        return view('users.checkout.index', compact('course'));
    }

    public function purchase(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $user   = auth()->user();

        $request->validate([
            'payment_method' => 'required|string|in:card,upi,bank_transfer',
            'card_name'      => 'required_if:payment_method,card|nullable|string|max:255',
            'card_number'    => 'required_if:payment_method,card|nullable|string|max:20',
            'upi_id'         => 'required_if:payment_method,upi|nullable|string|max:255',
        ]);

        // NOTE: This is a placeholder checkout pending real payment gateway integration.
        // TODO: Integrate Razorpay/Stripe before going live.

        try {
            DB::beginTransaction();

            // Race condition guard: re-check inside transaction
            $alreadySubscribed = CourseUserSubscription::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->where('subscription_status', 'active')
                ->lockForUpdate()
                ->first();

            if ($alreadySubscribed) {
                DB::rollBack();
                return redirect()->route('users.lessons.index', $course->id)
                    ->with('info', 'You are already enrolled in this course.');
            }

            $start  = Carbon::now();
            $expiry = $start->copy()->addMonths(12); // Default 1-year access

            $subscription = CourseUserSubscription::create([
                'user_id'             => $user->id,
                'course_id'           => $course->id,
                'start_date'          => $start,
                'expiry_date'         => $expiry,
                'price'               => $course->price,
                'total_amount'        => $course->price,
                'paid_amount'         => $course->price,
                'remaining_amount'    => 0,
                'payment_status'      => 'paid',
                'subscription_status' => 'active',
                'payment_method'      => $request->payment_method,
                'paid_by'             => 'student',
                'paid_at'             => now(),
            ]);

            Payment::create([
                'user_id'        => $user->id,
                'subscription_id'=> $subscription->id,
                'amount'         => $course->price,
                'payment_method' => $request->payment_method,
                'paid_by'        => 'student',
                'paid_at'        => now(),
                'status'         => 'success',
            ]);

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Enrollment failed. Please try again.');
        }

        return redirect()->route('users.purchase.success', $course->id);
    }

    public function success($id)
    {
        $course = Course::findOrFail($id);
        return view('users.checkout.success', compact('course'));
    }
}

