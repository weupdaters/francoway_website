<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseUser;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            // 📊 STATS
            'totalUsers'       => User::count(),
            'enrolledStudents' => CourseUser::count(),
         

            // 📚 ALL COURSES
            'allCourses' => Course::withCount('users')
                ->latest()
                ->get(),

           

          

          
        ]);
    }
}
