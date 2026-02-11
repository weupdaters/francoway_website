<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CourseAssignController extends Controller
{
    /**
     * Show assign course form
     */
    public function create()
    {
        // only published courses
        $courses = Course::where('status', 'published')->get();

        // only active users
        $users = User::where('status', 1)->get();

        return view('admin.course_assign.create', compact('courses', 'users'));
    }

    /**
     * Store assigned course
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id'   => 'required|exists:users,id',
            'status'    => 'required|in:0,1',   // ✅ ADD THIS
        ]);

        DB::table('course_user')->updateOrInsert(
            [
                'course_id' => $request->course_id,
                'user_id'   => $request->user_id,
            ],
            [
                'status'      => $request->status, // ✅ CHANGE HERE
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'Course assigned successfully');
    }

    /**
     * Show assigned courses of a user
     */
    public function show($id)
    {
        $user = User::with([
            'courses' => function ($query) {
                $query->where('status', 'published');
            }
        ])->findOrFail($id);

        return view('admin.users.course-assign-show', compact('user'));
    }
}
