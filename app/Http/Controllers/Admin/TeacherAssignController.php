<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;

use App\Models\CourseAssignment;
use App\Models\TeacherAssignUser;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherAssignController extends Controller
{
    // =========================
    // LIST PAGE
    // =========================
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = TeacherAssignUser::with(['teacher', 'user', 'course'])->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('teacher', function($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('course', function($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%");
                });
            });
        }

        $assignments = $query->paginate(10)->withQueryString();

        $teachers = User::where('role', 'teacher')->get();
        $users = User::where('role', 'user')->get();
        $courses = Course::orderBy('title')->get();

        return view('admin.teacher_assign.index', compact(
            'assignments',
            'teachers',
            'users',
            'courses'
        ));
    }

    // =========================
    // SHOW SINGLE
    // =========================
    public function show($id)
    {
        return response()->json(
            TeacherAssignUser::with(['teacher', 'user', 'course'])->findOrFail($id)
        );
    }

    // =========================
    // GET COURSES BY USER (AJAX)
    // =========================
public function getCoursesByUser($userId)
{
    try {
        $courses = \DB::table('course_user_subscriptions')
            ->where('course_user_subscriptions.user_id', $userId)
            ->join('courses', 'courses.id', '=', 'course_user_subscriptions.course_id')
            ->select('courses.id', 'courses.title')
            ->get();

        return response()->json($courses);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
}

    // =========================
    // STORE (ASSIGN TEACHER)
    // =========================
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'teacher_id' => 'required|exists:users,id',
                'user_id'    => 'required|exists:users,id',
                'course_id'  => 'required|exists:courses,id',
            ]);

            // Prevent duplicate
            $exists = TeacherAssignUser::where([
                'teacher_id' => $validated['teacher_id'],
                'user_id'    => $validated['user_id'],
                'course_id'  => $validated['course_id'],
            ])->exists();

            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'Already assigned'
                ], 422);
            }

            // Create assignment
            TeacherAssignUser::create($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Teacher assigned successfully'
                ]);
            }

            return redirect()->route('admin.teacher.assign.index')->with('success', 'Teacher assigned successfully');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        try {
            $assign = TeacherAssignUser::findOrFail($id);

            $validated = $request->validate([
                'user_id'    => 'required|exists:users,id',
                'course_id'  => 'required|exists:courses,id',
                'teacher_id' => 'required|exists:users,id',
            ]);

            $assign->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        try {
            TeacherAssignUser::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Delete failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}