<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        $activeSubscription = DB::table('course_user_subscriptions')
            ->where('user_id', $user->id)
            ->where('subscription_status', 'active')
            ->where('expiry_date', '>=', now())
            ->exists();

        if (!$activeSubscription) {
            auth()->logout();
            return redirect('/login')->with('error', 'Subscription expired');
        }

        return $next($request);
    }

}
