<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Get course from route parameters if present
        $course = $request->route('course');

        if ($course) {
            if (is_numeric($course)) {
                $course = \App\Models\Course::find($course);
            }

            if ($course && $course->isFree()) {
                return $next($request);
            }

            if ($course) {
                $subscription = DB::table('course_user_subscriptions')
                    ->where('user_id', $user->id)
                    ->where('course_id', $course->id)
                    ->latest()
                    ->first();

                if (!$subscription) {
                    return redirect()->route('users.checkout', $course->id)
                        ->with('error', 'You need to enroll in this course to access it.');
                }

                // Check expiry
                if ($subscription->expiry_date && \Carbon\Carbon::parse($subscription->expiry_date)->isPast()) {
                    DB::table('course_user_subscriptions')
                        ->where('id', $subscription->id)
                        ->update(['subscription_status' => 'expired', 'status' => 'expired']);

                    return redirect()->route('users.checkout', $course->id)
                        ->with('error', 'Your course subscription has expired. Please renew your plan to continue access.');
                }
            }
        }

        return $next($request);
    }

}
