<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        return view('users.courses.index', compact('courses'));
    }
    public function create()
    {
        return view('users.courses.create');
    }
    public function store(Request $request)
{
    $data = $request->validate([
        'title'        => 'required',
        'description'  => 'required',
        'price'        => 'required',
        'status'       => 'required',
        'thumbnail'    => 'nullable|image',
        'cover_image'  => 'nullable|image',
        'trial_video'  => 'nullable|mimes:mp4,mov,avi|max:50000',
    ]);

    if ($request->hasFile('thumbnail')) {
        $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
    }

    if ($request->hasFile('cover_image')) {
        $data['cover_image'] = $request->file('cover_image')->store('courses', 'public');
    }

    if ($request->hasFile('trial_video')) {
        $data['trial_video'] = $request->file('trial_video')->store('courses/videos', 'public');
    }

    Course::create($data);

    return redirect()->route('users.courses.index')
           ->with('success', 'Course created successfully');
}

    public function show(Course $course)
    {
        return view('users.courses.show', compact('course'));
    }
    public function edit(Course $course)
    {
      
        return view('users.courses.edit', compact('course'));
    }

public function update(Request $request, Course $course)
{
    $data = $request->validate([
        'title'        => 'required|string|max:255',
        'description'  => 'required',
        'price'        => 'required|numeric',
        'status'       => 'required|boolean',

        'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'trial_video'  => 'nullable|mimes:mp4,mov,avi|max:51200',
    ]);

    // 🔁 Handle file uploads + delete old files
    foreach (['thumbnail', 'cover_image', 'trial_video'] as $file) {

        if ($request->hasFile($file)) {

            // delete old file if exists
            if ($course->$file && Storage::disk('public')->exists($course->$file)) {
                Storage::disk('public')->delete($course->$file);
            }

            // store new file
            $data[$file] = $request->file($file)->store('courses', 'public');
        }
    }

    $course->update($data);

    return redirect()
        ->route('users.courses.index')
        ->with('success', 'Course updated successfully');
}


    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('users.courses.index')->with('success', 'Course deleted successfully');
    } 
    
    //assign course to user
    public function assign(Request $request, Course $course)
    {
        $user = User::find($request->user_id);
        $course->users()->attach($user);
        return redirect()->route('users.courses.index')->with('success', 'Course assigned successfully');
    }
}   