<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            // 📊 STATS FOR THE 2026 DASHBOARD FIGURES
            'totalStudents'    => User::where('role', 'user')->count(),
            'totalTeachers'    => User::where('role', 'teacher')->count(),
            'totalCourses'     => Course::count(),
            'totalRevenue'     => Payment::where('status', 'paid')->sum('amount'),
            
            // 📚 ALL COURSES
            'allCourses' => Course::withCount('users')
                ->latest()
                ->get(),
        ]);
    }
}
