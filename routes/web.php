<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('index');

// About Page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Contact Page
Route::get('/contact', [HomeController::class, 'contactUs'])->name('contactUs');
Route::post('/contact', [HomeController::class, 'store'])->name('contact.store');

// Courses (public listing & detail)
Route::get('/courses', [HomeController::class, 'courses'])->name('courses.index');
Route::get('/courses/{id}', [HomeController::class, 'show'])->name('courses.show');

// Resources (public)
Route::get('/resources', [HomeController::class, 'resources'])->name('resources');
Route::get('/resource/show/{id}', [HomeController::class, 'showResource'])->name('resource.show');
Route::get('/resource/download/{id}', [HomeController::class, 'download'])->name('resource.download');

// Privacy Policy & Terms Conditions
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');



/*
|--------------------------------------------------------------------------
| Guest Routes (Only for non-logged users)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Forgot password page
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('auth.password.request');

// Send OTP email
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// OTP verification & reset password form
Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Submit OTP verification & update password
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Resend OTP email
Route::post('/resend-otp', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.otp.resend');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes (Only logged users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user && $user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('users.dashboard');
        }
    })->name('dashboard');

    // Logout (POST only - secure way)
    Route::post('/logout', [LoginController::class, 'logout' ])->name('auth.logout');
    

    // Chat Box
    Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
    Route::post('/messages/send', [HomeController::class, 'send'])->name('messages.send');  



// AI Practice Assistant (Requires Authentication)
    Route::get('/ai-practice', [HomeController::class, 'aiPractice'])->name('ai.practice');
    Route::post('/ai-practice/chat', [HomeController::class, 'chat'])->name('ai.chat');
    Route::post('/ai-practice/submit-answer', [HomeController::class, 'submitAnswer'])->name('ai.submit_answer');

    // Role Based Route Files
    require __DIR__ . '/admin.php';
    require __DIR__ . '/teacher.php';
    require __DIR__ . '/users.php';

});
