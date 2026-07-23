<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('status', 'If an account exists with that email address, a 6-digit OTP code has been sent.');
        }

        // Generate 6-digit numeric OTP code
        $otp = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Save OTP to password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($otp),
                'created_at' => now(),
            ]
        );

        // Send OTP via Email
        try {
            Mail::send('emails.password-otp', [
                'otp' => $otp,
                'name' => $user->name,
            ], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your Password Reset OTP - Francoway Academy');
            });
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());
        }

        return redirect()->route('password.reset', ['email' => $user->email])
            ->with('status', 'A 6-digit OTP code has been sent to your email address.');
    }
}