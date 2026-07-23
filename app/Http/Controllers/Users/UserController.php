<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\SubscriptionPlan;
use App\Models\CourseUserSubscription;
use App\Models\AiPracticeAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

// =========================
// ADMIN USERS LIST
// =========================
public function index()
{
    $users = User::latest()->get();
    return view('users.index', compact('users'));
    
}


// =========================
// USER DASHBOARD
// =========================
public function dashboard()
{
    $userId = auth()->id();
    $user   = auth()->user();

    // Enrolled course IDs
    $courseIds = CourseUserSubscription::where('user_id', $userId)
        ->pluck('course_id')
        ->unique();

    $courses = Course::whereIn('id', $courseIds)->latest()->get();

    // Per-course completion percentage
    $totalLessonsCompleted = 0;
    $totalLessonsAll       = 0;

    foreach ($courses as $course) {
        $totalLessons = $course->lessons->count();
        $completedLessons = $user->lessons()
            ->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->count();

        $course->completionPercentage = $totalLessons > 0
            ? round(($completedLessons / $totalLessons) * 100)
            : 0;

        $totalLessonsCompleted += $completedLessons;
        $totalLessonsAll       += $totalLessons;
    }

    // Overall progress across all courses
    $overallProgress = $totalLessonsAll > 0
        ? round(($totalLessonsCompleted / $totalLessonsAll) * 100)
        : 0;

    // AI Practice attempts count
    $aiPracticeAttempts = AiPracticeAttempt::where('user_id', $userId)->latest()->get();
    $aiAttemptsCount    = $aiPracticeAttempts->count();

    // Active subscriptions count
    $activeSubscriptions = CourseUserSubscription::where('user_id', $userId)
        ->where('subscription_status', 'active')
        ->count();

    // Next expiry: find the nearest active subscription expiry
    $nextExpiry = CourseUserSubscription::where('user_id', $userId)
        ->where('subscription_status', 'active')
        ->whereNotNull('expiry_date')
        ->where('expiry_date', '>=', now())
        ->orderBy('expiry_date')
        ->value('expiry_date');

    $daysToExpiry = $nextExpiry ? now()->diffInDays(\Carbon\Carbon::parse($nextExpiry), false) : null;

    // Profile completion percentage
    $profileFields   = ['name', 'email', 'phone', 'bio', 'image'];
    $filledFields    = collect($profileFields)->filter(fn($f) => !empty($user->$f))->count();
    $profileComplete = round(($filledFields / count($profileFields)) * 100);

    return view('users.dashboard', compact(
        'courses',
        'aiPracticeAttempts',
        'aiAttemptsCount',
        'activeSubscriptions',
        'overallProgress',
        'totalLessonsCompleted',
        'totalLessonsAll',
        'daysToExpiry',
        'nextExpiry',
        'profileComplete'
    ));
}


// =========================
// CREATE USER
// =========================
public function create()
{
    return view('users.create');
}


// =========================
// STORE USER
// =========================
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,user',
        'status' => 'required|in:active,inactive',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'status' => $request->status,
        'description' => $request->description,
    ]);

    return redirect()->route('users.index')
        ->with('success', 'User Created');
}


// =========================
// EDIT USER
// =========================
public function edit($id)
{
    $users = User::findOrFail($id);
    return view('users.edit', compact('users'));
}


// =========================
// UPDATE USER
// =========================
public function update(Request $request, $id)
{
    $users = User::findOrFail($id);

    $data = $request->only('name', 'email', 'role', 'status', 'description');

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $users->update($data);

    return redirect()->route('users.index')
        ->with('success', 'User updated successfully');
}


// =========================
// DELETE USER
// =========================
public function destroy($id)
{
    User::findOrFail($id)->delete();

    return redirect()->route('users.index')
        ->with('success', 'User Deleted');
}


// =========================
// USER COURSE PAGE (MAIN LOGIC)
// =========================
public function show(Course $course)
{
    $userId = auth()->id();

    $subscription = CourseUserSubscription::where('user_id', $userId)
        ->where('course_id', $course->id)
        ->where('subscription_status', 'active')
        ->where(function ($q) {
            $q->whereNull('expiry_date') 
              ->orWhere('expiry_date', '>=', now()); 
        })
        ->first();

    if (!$subscription) {
        return redirect()->route('users.dashboard')
            ->with('error', '🔒 Your course access has expired. Please renew.');
    }

    // =========================
    // PLANS
    // =========================
    $plans = SubscriptionPlan::where('course_id', $course->id)
        ->where('status', 1)
        ->get();

    // =========================
    // SECTIONS + LESSONS
    // =========================
    $sections = Section::where('course_id', $course->id)
        ->with(['lessons' => function ($q) {
            $q->orderBy('id');
        }])->get();

    // =========================
    // FIRST LESSON AUTO SELECT
    // =========================
    $currentLesson = null;

    foreach ($sections as $section) {
        if ($section->lessons->isNotEmpty()) {
            $currentLesson = $section->lessons->first();
            break;
        }
    }

    // =========================
    // COMPLETION (future use)
    // =========================
    $completionPercentage = 0;

    return view('users.courses.show', compact(
        'course',
        'sections',
        'currentLesson',
        'completionPercentage',
        'subscription',
        'plans'
    ));
}

// =========================
// STUDENT PROFILE EDIT PAGE
// =========================
public function profile()
{
    $user = auth()->user();
    return view('users.profile', compact('user'));
}

// =========================
// STUDENT PROFILE UPDATE
// =========================
public function profileUpdate(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    /* IMAGE UPDATE */
    if ($request->hasFile('image')) {
        if ($user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->store('profiles', 'public');
    }

    /* DATA UPDATE */
    $user->update([
        'name'  => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return back()->with('success', 'Profile updated successfully ✅');
}

// =========================
// STUDENT PASSWORD UPDATE
// =========================
public function profileUpdatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password'         => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect ❌');
    }

    $user->update([
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    return back()->with('success', 'Password updated successfully 🔐');
}

}