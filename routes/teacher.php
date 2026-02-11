<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\LessonController;

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->as('teacher.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [TeacherController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | COURSES
        |--------------------------------------------------------------------------
        */

        // Optional: old simple courses list
        Route::get('/courses', [CourseController::class, 'index'])
            ->name('courses.index');

        // 🔥 MAIN: View Course Lessons (View Detail button yahin aayega)
        Route::get('/course-lessons/{course}',
            [CourseController::class, 'index'])
            ->name('course_lessons.index');

        // (Optional) old combined page – agar already use ho rahi ho
        Route::get('/course-lessons',
            [CourseController::class, 'courseLessonPage'])
            ->name('course-lessons');

        /*
        |--------------------------------------------------------------------------
        | LESSONS (AJAX ONLY)
        |--------------------------------------------------------------------------
        */
           Route::get(
            '/ajax/course/{course}/lessons',
            [LessonController::class, 'ajaxLessons']
        )->name('ajax.course.lessons');

        // DELETE LESSON (AJAX)
        Route::post(
            '/ajax/lesson/{lesson}',
            [LessonController::class, 'destroy']
        )->name('ajax.lesson.destroy');


        /*
        |--------------------------------------------------------------------------
        | LESSONS (CREATE / EDIT PAGES)
        |--------------------------------------------------------------------------
        */

        Route::get('/courses/{course}/lessons/create',
            [LessonController::class, 'create'])
            ->name('lessons.create');

        Route::post('/courses/{course}/lessons',
            [LessonController::class, 'store'])
            ->name('lessons.store');

        Route::get('/lessons/{lesson}/edit',
            [LessonController::class, 'edit'])
            ->name('lessons.edit');

        Route::put('/lessons/{lesson}',
            [LessonController::class, 'update'])
            ->name('lessons.update');
        Route::get('/lessons/{lesson}',
            [LessonController::class, 'show'])
            ->name('lessons.show');

       // add comment on lesson
Route::post(
    '/lessons/{lesson}/comment',
    [LessonController::class, 'storeComment']
)->name('lesson.comment');

// reply to comment (teacher)
Route::post(
    '/comments/{comment}/reply',
    [LessonController::class, 'replyComment']
)->name('comment.reply');

    
    });
