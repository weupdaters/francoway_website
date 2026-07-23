<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAssignUser;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // All assignments for this teacher
        $assignments = TeacherAssignUser::with(['user', 'course'])
            ->where('teacher_id', $teacher->id)
            ->get();

        // Get unique users
        $users = $assignments
            ->pluck('user')
            ->unique('id')
            ->values();

        // Get unique courses
        $courses = $assignments
            ->pluck('course')
            ->unique('id')
            ->values();

        return view('teachers.dashboard', compact('users', 'courses', 'assignments'));
    }
}
