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

        // Delete any previous tokens for this email to ensure fresh state
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // Generate a new 6-digit numeric OTP code
        $otp = (string) random_int(100000, 999999);

        // Save fresh OTP to password_reset_tokens table
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($otp),
            'created_at' => now(),
        ]);

        // Send fresh OTP via Email (including OTP in Subject so Gmail doesn't group threads)
        try {
            Mail::send('emails.password-otp', [
                'otp' => $otp,
                'name' => $user->name,
            ], function ($message) use ($user, $otp) {
                $message->to($user->email)
                        ->subject("Your Password Reset OTP Code: {$otp} - Francoway Academy");
            });
            Log::info("Sent new OTP {$otp} to {$user->email}");
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());
        }

        return redirect()->route('password.reset', ['email' => $user->email])
            ->with('status', 'A new 6-digit OTP code has been sent to your email address.');
    }
}