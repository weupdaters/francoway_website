<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\CourseUserSubscription;
use App\Models\SubscriptionPlan;

class LessonController extends Controller
{
    
    public function index(Course $course)
    {
        // Block access if course is paid and payment is pending or subscription is expired
        if ($course->price > 0) {
            $subscription = CourseUserSubscription::where('user_id', auth()->id())
                ->where('course_id', $course->id)
                ->latest()
                ->first();
            if (!$subscription || $subscription->payment_status === 'pending' || ($subscription->expiry_date && \Carbon\Carbon::parse($subscription->expiry_date)->isPast())) {
                return redirect()->route('users.checkout', $course->id)->with('error', 'Please complete payment or renew your subscription to access this course.');
            }
        }

        // 🔹 Sections with lessons
        $sections = Section::where('course_id', $course->id)
            ->with(['lessons' => function ($q) {
                $q->orderBy('id');
            }])
            ->orderBy('id')
            ->get();

       
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

    // 🔑 Check subscription
    $subscription = CourseUserSubscription::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->where('subscription_status', 'active')
        ->first();

    // 📦 Get course plans
    $plans = SubscriptionPlan::where('course_id', $course->id)
        ->where('status', 1)
        ->get();

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
            'subscription'  => $subscription,
            'plans'         => $plans,
        ]);
    }

    return view('users.courses.show', [
        'course'        => $course,
        'sections'      => $sections,
        'currentLesson' => $lesson,
        'subscription'  => $subscription,
        'plans'         => $plans,
    ]);
}

    /**
     * Mark lesson as completed (AJAX)
     */
    public function complete(Course $course, Lesson $lesson)
    {
        abort_if($lesson->course_id !== $course->id, 404);

        $user = auth()->user();
        $alreadyCompleted = $user->lessons()->where('lesson_id', $lesson->id)->exists();

        if ($alreadyCompleted) {
            $user->lessons()->detach($lesson->id);
            $isCompleted = false;
        } else {
            $user->lessons()->syncWithoutDetaching([
                $lesson->id => [
                    'is_completed' => true,
                    'completed_at' => now(),
                ]
            ]);
            $isCompleted = true;
        }

        $courseLessonIds = $course->lessons()->pluck('id');
        $totalLessons = $courseLessonIds->count();
        $completedCount = $user->lessons()->whereIn('lesson_id', $courseLessonIds)->count();
        $progressPercentage = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;

        return response()->json([
            'success'            => true,
            'is_completed'       => $isCompleted,
            'lesson_id'          => $lesson->id,
            'progress_percentage'=> $progressPercentage,
            'completed_count'    => $completedCount,
            'total_lessons'      => $totalLessons,
            'course_status'      => $progressPercentage >= 100 ? 'Completed' : 'In Progress',
        ]);
    }
}
