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
            ->get()
            ->unique('course_id');

        if ($alluserCourses->isEmpty()) {
            $alluserCourses = TeacherAssignUser::whereHas('course')
                ->with('course')
                ->where('teacher_id', auth()->id())
                ->get()
                ->unique('course_id');
        }

        $selectedCourseId = optional($alluserCourses->first())->course_id;

        return view('teachers.course_lessons.index', compact('alluserCourses', 'selectedCourseId'));
    }

    /**
     * 🔥 NEW
     * Single Page:
     * Left = Courses
     * Right = Lessons (AJAX)
     * URL: /teacher/course-lessons/{course?}
     */
    public function courseLessonPage($course = null)
    {
        $selectedCourseId = is_numeric($course) ? (int)$course : (is_object($course) ? $course->id : null);

        $alluserCourses = TeacherAssignUser::whereHas('course')
            ->with('course')
            ->where('teacher_id', auth()->id())
            ->get()
            ->unique('course_id');

        return view('teachers.course_lessons.index', compact('alluserCourses', 'selectedCourseId'));
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
