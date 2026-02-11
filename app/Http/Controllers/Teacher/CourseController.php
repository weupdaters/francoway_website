<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Teacher → sirf apne courses dekhe (OLD – KEEP)
     * /teacher/courses
     */
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->id())
            ->paginate(10);

        return view('teachers.course_lessons.index', compact('courses'));
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
        $courses = Course::where('teacher_id', auth()->id())->get();

        return view('teachers.lessons.index', compact('courses'));
    }

    /**
     * OPTIONAL (agar course detail page chahiye)
     * /teacher/courses/{course}
     */
    public function show(Course $course)
    {
        // 🔐 ownership check
        abort_unless(
            auth()->check() && auth()->id() === $course->teacher_id,
            403
        );

        return view('teachers.courses.show', compact('course'));
    }
}
