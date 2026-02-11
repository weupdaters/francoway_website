<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // 🔹 Teacher ke assigned users (students) with their courses
        $users = $teacher->assignedUsers()
            ->with('courses')
            ->get();

        // 🔹 Sab unique courses (jo assigned users ke paas hain)
        $courses = $users
            ->pluck('courses')
            ->flatten()
            ->unique('id')
            ->values();

        return view('teachers.dashboard', compact('users', 'courses'));
    }
}
