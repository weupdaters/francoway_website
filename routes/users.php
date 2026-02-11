<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\CourseController;
use App\Http\Controllers\Users\LessonController;
use App\Http\Controllers\Users\CommentController;   

Route::prefix('users')
    ->middleware(['auth'])
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
        Route::post('/courses/{course}/lessons/{lesson}/complete',
    [LessonController::class, 'complete'])
    ->name('lesson.complete');


            /* ================= LESSON COMMENTS ================= */
            Route::post('/lesson/comment', [CommentController::class, 'store'])
    ->name('comment.store');
    });
