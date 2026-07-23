<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->query('email', old('email')),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|min:8|confirmed',
        ], [
            'otp.required' => 'Please enter the 6-digit OTP code sent to your email.',
            'otp.digits' => 'The OTP code must be exactly 6 digits.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->otp, $record->token)) {
            return back()->withInput()->withErrors(['otp' => 'Invalid OTP code. Please check your email or request a new code.']);
        }

        // Check 15 minute expiration
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return back()->withInput()->withErrors(['otp' => 'This OTP code has expired. Please request a new code.']);
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Delete used token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully. Please sign in with your new password.');
    }
}
