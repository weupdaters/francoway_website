<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseUserSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    /**
     * Create or extend course subscription for student.
     */
    public function createSubscription(User $user, Course $course, string $duration_type = 'months', int $duration_value = 12, string $payment_status = 'paid'): CourseUserSubscription
    {
        return DB::transaction(function () use ($user, $course, $duration_type, $duration_value, $payment_status) {
            $start = Carbon::now();
            $expiry = null;

            if ($duration_type === 'days') {
                $expiry = $start->copy()->addDays($duration_value);
            } elseif ($duration_type === 'weeks') {
                $expiry = $start->copy()->addWeeks($duration_value);
            } elseif ($duration_type === 'months') {
                $expiry = $start->copy()->addMonths($duration_value);
            } elseif ($duration_type === 'years') {
                $expiry = $start->copy()->addYears($duration_value);
            } elseif ($duration_type === 'lifetime') {
                $expiry = null;
            }

            $subscription = CourseUserSubscription::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'start_date' => $start,
                'expiry_date' => $expiry,
                'price' => $course->price,
                'total_amount' => $course->price,
                'paid_amount' => $payment_status === 'paid' ? $course->price : 0,
                'remaining_amount' => 0,
                'duration_type' => $duration_type,
                'duration_value' => $duration_value,
                'payment_status' => $payment_status,
                'subscription_status' => 'active',
                'status' => 'active',
                'paid_by' => 'student',
                'paid_at' => now(),
            ]);

            DB::table('course_user')->updateOrInsert(
                ['course_id' => $course->id, 'user_id' => $user->id],
                ['status' => 'active', 'updated_at' => now(), 'created_at' => now()]
            );

            return $subscription;
        });
    }

    /**
     * Process expired subscriptions across database.
     */
    public function processExpiredSubscriptions(): int
    {
        return DB::table('course_user_subscriptions')
            ->where('subscription_status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<', Carbon::now())
            ->update([
                'subscription_status' => 'expired',
                'status' => 'expired',
                'updated_at' => Carbon::now(),
            ]);
    }
}
