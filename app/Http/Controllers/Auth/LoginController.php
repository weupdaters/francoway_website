<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Trim inputs to handle copy-paste whitespace/newline issues
        $request->merge([
            'email' => strtolower(trim($request->input('email'))),
            'password' => trim($request->input('password')),
        ]);

        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $dbUser = \App\Models\User::where('email', $request->input('email'))->first();
        \Log::info('Login Attempt Info', [
            'input_email' => $request->input('email'),
            'input_password_length' => strlen($request->input('password')),
            'input_password_hex' => bin2hex($request->input('password')),
            'db_user_found' => !is_null($dbUser),
            'db_role' => $dbUser ? $dbUser->role : null,
            'db_status' => $dbUser ? $dbUser->status : null,
            'password_matches' => $dbUser ? password_verify($request->input('password'), $dbUser->password) : false,
        ]);

        $key = Str::lower($request->input('email')).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again later.'
            ]);
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {

            RateLimiter::clear($key);
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            }

        
            return redirect()->route('users.dashboard');
        }

        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
