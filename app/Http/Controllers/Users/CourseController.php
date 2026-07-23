<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\SubscriptionPlan;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Comment;

class CourseController extends Controller
{
    /**
     * MY ENROLLED COURSES LIST (LMS)
     */
    public function index(Request $request)
    {
        $userId = auth()->id();
        $type = $request->query('type');

        $courseIds = \App\Models\CourseUserSubscription::where('user_id', $userId)
            ->pluck('course_id')
            ->unique();

        $query = Course::whereIn('id', $courseIds);

        if ($type === 'paid') {
            $query->where('price', '>', 0);
        } elseif ($type === 'free') {
            $query->where('price', 0);
        }

        $courses = $query->latest()->paginate(10)->withQueryString();

        return view('users.courses.index', compact('courses'));
    }

    /**
     * COURSE PAGE
     */
    public function show($courseId)
    {
        $user = auth()->user();

        // Course
        $course = Course::with('lessons')->findOrFail($courseId);

        // Subscription check
        $subscription = $user->subscriptions()
            ->where('course_id', $courseId)
            ->first();

        // Plans (for buy page)
        $plans = SubscriptionPlan::where('course_id', $courseId)->get();

        // Sections with lessons
        $sections = Section::with(['lessons' => function ($q) {
            $q->orderBy('id');
        }])->where('course_id', $courseId)->get();

        // Default lesson (first lesson)
        $currentLesson = Lesson::where('course_id', $courseId)->first();

        // Progress calculation
        $completedLessons = $user->lessons()
            ->where('course_id', $courseId)
            ->count();

        $totalLessons = Lesson::where('course_id', $courseId)->count();

        $course->completionPercentage = $totalLessons > 0
            ? round(($completedLessons / $totalLessons) * 100)
            : 0;

        return view('users.courses.show', compact(
            'course',
            'subscription',
            'plans',
            'sections',
            'currentLesson'
        ));
    }

    /**
     * SINGLE LESSON VIEW
     */
    public function showLesson($courseId, $lessonId)
    {
        $user = auth()->user();

        // Course
        $course = Course::with('lessons')->findOrFail($courseId);

        // Subscription check
        $subscription = $user->subscriptions()
            ->where('course_id', $courseId)
            ->first();

        if (!$subscription) {
            return redirect()->route('course.show', $courseId)
                ->with('error', 'Please purchase this course first.');
        }

        // Sections + lessons
        $sections = Section::with(['lessons' => function ($q) {
            $q->orderBy('id');
        }])->where('course_id', $courseId)->get();

        // Current lesson with comments + user
        $currentLesson = Lesson::with(['comments.user'])
            ->where('id', $lessonId)
            ->firstOrFail();

        // Progress
        $completedLessons = $user->lessons()
            ->where('course_id', $courseId)
            ->count();

        $totalLessons = Lesson::where('course_id', $courseId)->count();

        $course->completionPercentage = $totalLessons > 0
            ? round(($completedLessons / $totalLessons) * 100)
            : 0;

        return view('users.courses.show', compact(
            'course',
            'subscription',
            'sections',
            'currentLesson'
        ));
    }

    /**
     * MARK LESSON COMPLETE (AJAX)
     */
    public function markComplete($courseId, $lessonId)
    {
        $user = auth()->user();

        // avoid duplicate
        if (!$user->lessons()->where('lesson_id', $lessonId)->exists()) {
            $user->lessons()->attach($lessonId);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lesson marked as completed'
        ]);
    }

    /**
     * STORE COMMENT
     */
   public function storeComment(Request $request)
{
    $request->validate([
        'lesson_id' => 'required|exists:lessons,id',
        'comment' => 'required|string|max:1000'
    ]);

    Comment::create([
        'user_id'   => auth()->id(),
        'lesson_id' => $request->lesson_id,
        'parent_id' => $request->parent_id ?? null,
        'comment'   => $request->comment
    ]);

    return back()->with('success', 'Comment added');
}
}