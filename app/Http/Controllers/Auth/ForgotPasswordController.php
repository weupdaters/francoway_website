<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Rate limiting: max 3 OTP requests per email per 5 minutes (BUG-012)
        $rateLimitKey = 'otp-request:' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return back()->withErrors([
                'email' => "Too many password reset attempts. Please wait {$seconds} seconds before trying again.",
            ]);
        }

        RateLimiter::hit($rateLimitKey, 300); // 5 minute window

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Don't reveal whether email exists (security best practice)
            return back()->with('status', 'If an account exists with that email address, a 6-digit OTP code has been sent.');
        }

        // Delete any previous tokens for this email
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // Generate a new 6-digit numeric OTP code
        $otp = (string) random_int(100000, 999999);

        // Save fresh OTP to password_reset_tokens table
        DB::table('password_reset_tokens')->insert([
            'email'      => $user->email,
            'token'      => Hash::make($otp),
            'created_at' => now(),
        ]);

        // Send OTP via Email
        try {
            Mail::send('emails.password-otp', [
                'otp'  => $otp,
                'name' => $user->name,
            ], function ($message) use ($user, $otp) {
                $message->to($user->email)
                        ->subject("Your Password Reset OTP Code: {$otp} - Francoway Academy");
            });
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());
        }

        return redirect()->route('password.reset', ['email' => $user->email])
            ->with('status', 'A new 6-digit OTP code has been sent to your email address.');
    }
}