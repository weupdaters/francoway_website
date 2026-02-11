<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;

class LessonController extends Controller
{
    /**
     * Course open → first lesson auto open
     */
    public function index(Course $course)
    {
        // 🔹 Sections with lessons
        $sections = Section::where('course_id', $course->id)
            ->with(['lessons' => function ($q) {
                $q->orderBy('id');
            }])
            ->orderBy('id')
            ->get();

        /**
         * 🔥 FALLBACK
         * Agar sections nahi hain, but lessons hain
         */
        if ($sections->isEmpty()) {

            $lessons = Lesson::where('course_id', $course->id)
                ->orderBy('id')
                ->get();

            return view('users.courses.show', [
                'course'        => $course,
                'sections'      => collect([
                    (object)[
                        'title'   => 'Lessons',
                        'lessons' => $lessons
                    ]
                ]),
                'currentLesson' => $lessons->first(),
            ]);
        }

        // 🔹 First available lesson
        $currentLesson = null;
        foreach ($sections as $section) {
            if ($section->lessons->isNotEmpty()) {
                $currentLesson = $section->lessons->first();
                break;
            }
        }

        return view('users.courses.show', compact(
            'course',
            'sections',
            'currentLesson'
        ));
    }

    /**
     * Sidebar lesson click
     */
    public function show(Course $course, Lesson $lesson)
    {
        // 🔐 Security check
        abort_if($lesson->course_id !== $course->id, 404);

        $sections = Section::where('course_id', $course->id)
            ->with(['lessons' => function ($q) {
                $q->orderBy('id');
            }])
            ->orderBy('id')
            ->get();

        // 🔥 SAME FALLBACK FOR DIRECT LESSON URL
        if ($sections->isEmpty()) {

            $lessons = Lesson::where('course_id', $course->id)
                ->orderBy('id')
                ->get();

            return view('users.courses.show', [
                'course'        => $course,
                'sections'      => collect([
                    (object)[
                        'title'   => 'Lessons',
                        'lessons' => $lessons
                    ]
                ]),
                'currentLesson' => $lesson,
            ]);
        }

        return view('users.courses.show', [
            'course'        => $course,
            'sections'      => $sections,
            'currentLesson' => $lesson,
        ]);
    }

    /**
     * Mark lesson as completed (AJAX)
     */
    public function complete(Course $course, Lesson $lesson)
    {
        abort_if($lesson->course_id !== $course->id, 404);

        auth()->user()->lessons()->syncWithoutDetaching([
            $lesson->id => [
                'is_completed' => true,
                'completed_at' => now(),
            ]
        ]);

        return response()->json([
            'success'   => true,
            'lesson_id'=> $lesson->id,
        ]);
    }
}
