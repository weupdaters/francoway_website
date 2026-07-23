<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TeacherAssignUser;

class CourseController extends Controller
{

   
     public function index()
    {
        // BUG-021 fix: only show courses assigned to this teacher
        $assignedCourseIds = TeacherAssignUser::where('teacher_id', auth()->id())
            ->pluck('course_id');

        $courses = Course::whereIn('id', $assignedCourseIds)->latest()->paginate(10);

        return view('teachers.courses.index', compact('courses'));
    }
    /**
     * Teacher → sirf apne courses dekhe (OLD – KEEP)
     * /teacher/courses
     */
    public function getUserCourses($user_id)
    {
        $alluserCourses = TeacherAssignUser::whereHas('course')
        ->with('course')
        ->where('teacher_id', auth()->id())
        ->where('user_id', $user_id)
        ->get();

        return view('teachers.course_lessons.index', compact('alluserCourses'));
    }

    /**
     * 🔥 NEW
     * Single Page:
     * Left = Courses
     * Right = Lessons (AJAX)
     * URL: /teacher/course-lessons
     */
    public function courseLessonPage()
    {
        $courses = TeacherAssignUser::whereHas('course')
            ->with('course')
            ->where('teacher_id', auth()->id())
            ->get();

        return view('teachers.lessons.index', compact('courses'));
    }

    /**
     * OPTIONAL (agar course detail page chahiye)
     * /teacher/courses/{course}
     */
    public function show(Course $course)
    {
        // 🔐 ownership check
        $isAssigned = TeacherAssignUser::where('teacher_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();
        abort_unless($isAssigned, 403);

        return view('teachers.courses.show', compact('course'));
    }
}
