<?php


use App\Http\Controllers\Admin\ChatGPTController;
use App\Http\Controllers\Admin\CourseAssignController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LessonCommentController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeacherAssignController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\CourseAssignmentController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Course Routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');

    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    //   Lesson Routes
    Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])
        ->name('lessons.create');
    Route::post('courses/{course}/lessons', [LessonController::class, 'store'])
        ->name('lessons.store');
    Route::get('courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])
        ->name('lessons.edit');
    Route::put('courses/{course}/lessons/{lesson}/update', [LessonController::class, 'update'])
        ->name('lessons.update');
    Route::delete('courses/{course}/lessons/{lesson}/destroy', [LessonController::class, 'destroy'])
        ->name('lessons.destroy');
    Route::get('/courses/{course}/lessons', [LessonController::class, 'index'])
        ->name('lessons.index');
    Route::get('courses/{course}/lessons/{lesson}/show', [LessonController::class, 'show'])
        ->name('lessons.show');


    //course assign routes
    
     Route::get('/course-assign', [CourseAssignController::class,'index'])
        ->name('course-assign.index');

 Route::get('/course-assign/create', [CourseAssignController::class,'create'])
->name('course-assign.create');

    Route::post('/course-assign', [CourseAssignController::class,'store'])
        ->name('course-assign.store');

    Route::get('/course-assign/{id}/edit', [CourseAssignController::class, 'edit'])
        ->name('course-assign.edit');
    
    Route::put('/course-assign/{id}', [CourseAssignController::class, 'update'])
        ->name('course-assign.update');

    Route::delete('/course-assign/{id}', [CourseAssignController::class, 'destroy'])
        ->name('course-assign.destroy');    

    //show course assign form
    Route::get('/course-assign/{id}', [CourseAssignController::class, 'show'])->name('course-assign.show');

    //lesson comment routes
    Route::resource('lesson-comments', LessonCommentController::class);

    //payment routes
        Route::get('/assignments', [CourseAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/create', [CourseAssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments/store', [CourseAssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{id}', [CourseAssignmentController::class, 'show'])
    ->name('assignments.show');

    Route::post('/assignments/{id}/payment', [CourseAssignmentController::class, 'addPayment'])
    ->name('assignments.add-payment');

      Route::patch('/assignments/{id}/inactive', [CourseAssignmentController::class, 'inactive'])
        ->name('course-assign.inactive');

    Route::patch('/assignments/{id}/active', [CourseAssignmentController::class, 'active'])
        ->name('course-assign.active');

    // Teacher Assign CRUD
    Route::get('/teacher-assign', [TeacherAssignController::class, 'index'])
    ->name('teacher.assign.index');

    Route::post('/teacher-assign', [TeacherAssignController::class, 'store'])
    ->name('teacher.assign.store');

    Route::get('/teacher-assign/{id}', [TeacherAssignController::class, 'show'])
    ->name('teacher.assign.show');

    Route::put('/teacher-assign/{id}', [TeacherAssignController::class, 'update'])
    ->name('teacher.assign.update');

    Route::delete('/teacher-assign/{id}', [TeacherAssignController::class, 'destroy'])
    ->name('teacher.assign.delete');

    // AJAX
    Route::get('/user/{user}/courses', [TeacherAssignController::class, 'getCoursesByUser']);


    //plan routes
     Route::resource('plans', PlanController::class);

    //resource routes
    Route::resource('resources', ResourceController::class)->names([
        'index' => 'resources.index',
        'create' => 'resources.create',
        'store' => 'resources.store',
        'show' => 'resources.show',
        'edit' => 'resources.edit',
        'update' => 'resources.update',
        'destroy' => 'resources.destroy',
    ]);


    //section routes
    Route::get('/sections/list', [LessonController::class, 'getSections'])->name('sections.list');
    Route::post('/sections/{course}/store', [LessonController::class, 'storeSectionLesson'])
    ->name('sections.store');

    Route::get('/courses/{course}/sections', function ($courseId) {
        return \App\Models\Section::where('course_id', $courseId)->get();
    })->name('sections.byCourse');

    //profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    //setting routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/chatgpt', [ChatGPTController::class, 'askChatGPT']);


});
