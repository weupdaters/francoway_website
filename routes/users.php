<?php

use App\Http\Controllers\Users\CommentController;
use App\Http\Controllers\Users\CourseController;
use App\Http\Controllers\Users\LessonController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\SubscriptionController;

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->middleware(['auth', 'role:user'])
    ->name('users.')
    ->group(function () {

        /* ================= DASHBOARD ================= */
        Route::get('/dashboard', [UserController::class, 'dashboard'])
            ->name('dashboard');

        /* ================= COURSES ================= */
        Route::get('/courses', [CourseController::class, 'index'])
            ->name('courses.index');

        Route::get('/courses/{course}', [CourseController::class, 'show'])
            ->name('courses.show');

        Route::post('/courses/{course}/assign', [CourseController::class, 'assign'])
            ->name('courses.assign');

        /* ================= COURSE → LESSON PLAYER ================= */

        // Course open → first lesson auto open
        Route::get(
            '/courses/{course}/lessons',
            [LessonController::class, 'index']
        )->name('lessons.index');

        // Sidebar lesson click
        Route::get(
            '/courses/{course}/lessons/{lesson}',
            [LessonController::class, 'show']
        )->name('lessons.show');

        // Mark lesson as completed (AJAX)
        Route::post(
            '/courses/{course}/lessons/{lesson}/complete',
            [LessonController::class, 'complete']
        )
    ->name('lesson.complete');

    //plan
    Route::get('/buy-plan/{plan}',[SubscriptionController::class,'buyPlan'])
        ->name('buy.plan');

    /* ================= CHECKOUT / PURCHASE FLOW ================= */
    Route::get('/courses/{id}/checkout', [\App\Http\Controllers\Users\CheckoutController::class, 'checkout'])
        ->name('checkout');
    Route::post('/courses/{id}/purchase', [\App\Http\Controllers\Users\CheckoutController::class, 'purchase'])
        ->name('purchase');
    Route::get('/courses/{id}/success', [\App\Http\Controllers\Users\CheckoutController::class, 'success'])
        ->name('purchase.success');


        /* ================= LESSON COMMENTS ================= */
        Route::post('/lesson/comment', [CommentController::class, 'store'])
            ->name('comment.store');

        /* ================= STUDENT PROFILE ================= */
        Route::get('/profile', [UserController::class, 'profile'])
            ->name('profile.index');
        Route::post('/profile/update', [UserController::class, 'profileUpdate'])
            ->name('profile.update');
        Route::post('/profile/password', [UserController::class, 'profileUpdatePassword'])
            ->name('profile.password');
    });
