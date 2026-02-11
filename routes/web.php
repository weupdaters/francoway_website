<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\HomeController;


//home page
Route::get('/', [HomeController::class, 'index'])->name('index');

 Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

 
    // Contact Page
Route::get('/contact', [HomeController::class, 'contactUs'])->name('contactUs');
Route::post('/contact', [HomeController::class, 'store'])->name('contact.store');


     Route::get('/courses', [HomeController::class, 'index'])->name('courses.index');
    Route::get('/courses/{id}', [HomeController::class, 'show'])->name('courses.show');

   
// Authentication Routes
Route::middleware('guest')->group(function () {


   

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // Password Reset
    Route::get('/password/request', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
    Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});


// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Dashboard (after login)
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    


    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

   
   
    

   //loading role-based routes
    require __DIR__ . '/admin.php';
    require __DIR__ . '/teacher.php';
    require __DIR__ . '/users.php';

    //contact page
   

});
