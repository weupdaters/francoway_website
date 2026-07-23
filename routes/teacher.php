<?php


use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/course-lessons/{user}/user', [CourseController::class, 'getUserCourses']) ->name('course_lessons_user.index');

        // (Optional) old combined page – agar already use ho rahi ho
        Route::get('/course-lessons', [CourseController::class, 'courseLessonPage']) ->name('course-lessons');

        /*
        |--------------------------------------------------------------------------
        | LESSONS (AJAX ONLY)
        |--------------------------------------------------------------------------
        */
        Route::get('/ajax/course/{course}/lessons', [LessonController::class, 'ajaxLessons'])->name('ajax.course.lessons');

        // DELETE LESSON (AJAX - POST with method spoofing for CSRF safety)
        Route::delete('/ajax/lesson/{lesson}', [LessonController::class, 'destroy'])
    ->name('ajax.lesson.destroy');


        /*
        |--------------------------------------------------------------------------
        | LESSONS (CREATE / EDIT PAGES)
        |--------------------------------------------------------------------------
        */
        //section routes
        // Route::get('/sections/list', [LessonController::class, 'getSections'])->name('sections.list');
        Route::post('/sections/store', [LessonController::class, 'storeSectionLesson'])
        ->name('sections.store');

        Route::get('/courses/{course}/sections', function ($courseId) {
            return \App\Models\Section::where('course_id', $courseId)->get();
        })->name('sections.byCourse');

        Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create']) ->name('lessons.create');

        Route::post(
            '/courses/{course}/lessons',
            [LessonController::class, 'store']
        )
            ->name('lessons.store');

        Route::get(
            '/lessons/{lesson}/edit',
            [LessonController::class, 'edit']
        )
            ->name('lessons.edit');

        Route::put(
            '/lessons/{lesson}',
            [LessonController::class, 'update']
        )
            ->name('lessons.update');
        Route::get(
            '/lessons/{lesson}',
            [LessonController::class, 'show']
        )
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
