<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherAssignController extends Controller
{
    public function index()
    {
        $assignments = \DB::table('teacher_user')
            ->join('users as teachers', 'teachers.id', '=', 'teacher_user.teacher_id')
            ->join('users as users', 'users.id', '=', 'teacher_user.user_id')
            ->select(
                'teacher_user.*',
                'teachers.name as teacher_name',
                'users.name as user_name'
            )
            ->paginate(10);

        return view('teacher.teacher_assign.index', compact('assignments'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'user_id' => 'required'
        ]);

        $teacher = Teacher::findOrFail($request->teacher_id);

        $teacher->users()->syncWithoutDetaching($request->user_id);

        return back()->with('success', 'User assigned to teacher successfully');
    }

    public function destroy($teacherId, $userId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        $teacher->users()->detach($userId);

        return back()->with('success', 'User unassigned successfully');
    }
}
