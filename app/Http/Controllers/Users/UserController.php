<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =========================
    // ADMIN SIDE (USERS CRUD)
    // =========================

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
            'status'   => 'required|in:active,inactive',
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('users.index')->with('success', 'User Created');
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('users.edit', compact('users'));            
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);

        $data = $request->only('name', 'email', 'role', 'status', 'description');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $users->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted');
    }

    // =========================
    // USER DASHBOARD
    // =========================

    public function dashboard()
    {
        $courses = auth()->user()
            ->courses()
            ->with('lessons')
            ->get();

        return view('users.dashboard', compact('courses'));
    }

    // =========================
    // USER COURSE + LESSON VIEW
    // =========================

    public function show(Course $course, Lesson $lesson = null)
    {
        $course->load('lessons');

        if (!$lesson) {
            $lesson = $course->lessons->first();
        }

        return view('users.courses.show', compact('course', 'lesson'));
    }
}
