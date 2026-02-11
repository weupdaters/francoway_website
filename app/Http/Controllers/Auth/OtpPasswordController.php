<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.passwords.otp-email');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        // Do not reveal user existence
        if (!$user) {
            return back()->with('status', 'If the email exists, an OTP has been sent.');
        }

        $otp = random_int(100000, 999999);

        PasswordOtp::updateOrCreate(
            ['email' => $user->email],
            [
                'otp' => Hash::make($otp),
                'expires_at' => Carbon::now()->addMinutes(10),
                'used' => false,
            ]
        );

        Mail::send('emails.password-otp', [
            'otp' => $otp,
            'name' => $user->name,
        ], function ($mail) use ($user) {
            $mail->to($user->email)
                 ->subject('Password Reset OTP - Job Portal');
        });

        return redirect()->route('password.otp.verify')
            ->with('email', $user->email)
            ->with('status', 'OTP sent to your email.');
    }

    public function showVerifyForm()
    {
        return view('auth.passwords.otp-verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);

        $record = PasswordOtp::where('email', $request->email)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record || !Hash::check($request->otp, $record->otp)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        session(['password_reset_email' => $request->email]);
        $record->update(['used' => true]);

        return redirect()->route('password.otp.reset');
    }

    public function showResetForm()
    {
        abort_unless(session()->has('password_reset_email'), 403);
        return view('auth.passwords.otp-reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', session('password_reset_email'))->firstOrFail();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        session()->forget('password_reset_email');

        return redirect()->route('login')
            ->with('status', 'Password reset successfully. Please login.');
    }
}
