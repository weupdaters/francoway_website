<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\TeacherUser;
use Illuminate\Http\Request;

class TeacherAssignController extends Controller
{
    /* =====================================================
     |  INDEX – list assignments + teachers
     ===================================================== */
    public function index()
    {
        $assignments = TeacherUser::with([
                'teacher:id,name',
                'user:id,name',
                'course:id,title',
            ])
            ->latest()
            ->paginate(10);

        $teachers = User::where('role', 'teacher')
            ->select('id','name')
            ->get();

        return view(
            'admin.teacher_assign.index',
            compact('assignments', 'teachers')
        );
    }

    /* =====================================================
     |  SHOW – single assignment (for view / modal / ajax)
     ===================================================== */
    public function show($id)
    {
        $assignment = TeacherUser::with([
                'teacher:id,name',
                'user:id,name',
                'course:id,title',
            ])
            ->findOrFail($id);

        return response()->json($assignment);
    }

    /* =====================================================
     |  AJAX – users list (students)
     ===================================================== */
    public function getUsersByTeacher($teacherId)
    {
        // NOTE: abhi teacher se depend nahi, sab users
        return User::where('role', 'user')
            ->orderBy('name')
            ->select('id', 'name')
            ->get();
    }

    /* =====================================================
     |  AJAX – courses by teacher (IMPORTANT FIX)
     ===================================================== */
    public function getCoursesByTeacher($teacherId)
    {
        return Course::where('teacher_id', $teacherId)
            ->where('status', 'published')   // optional but recommended
            ->orderBy('title')
            ->select('id', 'title')
            ->get();
    }

    /* =====================================================
     |  STORE – assign user to teacher + course
     ===================================================== */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'user_id'    => 'required|exists:users,id',
            'course_id'  => 'required|exists:courses,id',
        ]);

        // prevent duplicate
        $exists = TeacherUser::where([
            'teacher_id' => $request->teacher_id,
            'user_id'    => $request->user_id,
            'course_id'  => $request->course_id,
        ])->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This user is already assigned to this course'
            ], 422);
        }

        $assign = TeacherUser::create([
            'teacher_id' => $request->teacher_id,
            'user_id'    => $request->user_id,
            'course_id'  => $request->course_id,
        ]);

        // sync course_user pivot
        Course::find($request->course_id)
            ?->users()
            ->syncWithoutDetaching($request->user_id);

        return response()->json([
            'success' => true,
            'data'    => $assign
        ]);
    }

    /* =====================================================
     |  UPDATE – change user
     ===================================================== */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $assign = TeacherUser::findOrFail($id);

        $assign->update([
            'user_id' => $request->user_id
        ]);

        // keep pivot in sync
        $assign->course?->users()
            ->syncWithoutDetaching($request->user_id);

        return response()->json(['success' => true]);
    }

    /* =====================================================
     |  DELETE – remove assignment
     ===================================================== */
    public function destroy($id)
    {
        $assign = TeacherUser::findOrFail($id);

        $assign->course?->users()
            ->detach($assign->user_id);

        $assign->delete();

        return response()->json(['success' => true]);
    }
}
