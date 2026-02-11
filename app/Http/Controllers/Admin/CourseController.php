<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    // =========================
    // STORE COURSE (ADMIN ONLY)
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required',
            'price'        => 'required|numeric',
            'status'       => 'required', // published / draft
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'trial_video'  => 'nullable|mimes:mp4,mov,avi|max:51200',
        ]);

        // ✅ ADMIN creates course → teacher_id NULL
        $data['teacher_id'] = null;

        // ✅ SLUG AUTO GENERATE (UNIQUE)
        $data['slug'] = Str::slug($request->title) . '-' . time();

        // 📂 File uploads
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

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course created successfully');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    // =========================
    // UPDATE COURSE
    // =========================
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required',
            'price'        => 'required|numeric',
            'status'       => 'required',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'trial_video'  => 'nullable|mimes:mp4,mov,avi|max:51200',
        ]);

        // 🔁 Update slug ONLY if title changed
        if ($course->title !== $request->title) {
            $data['slug'] = Str::slug($request->title) . '-' . $course->id;
        }

        // 🔁 Handle file uploads + delete old files
        foreach (['thumbnail', 'cover_image', 'trial_video'] as $file) {
            if ($request->hasFile($file)) {

                if ($course->$file && Storage::disk('public')->exists($course->$file)) {
                    Storage::disk('public')->delete($course->$file);
                }

                $path = $file === 'trial_video'
                    ? 'courses/videos'
                    : 'courses';

                $data[$file] = $request->file($file)->store($path, 'public');
            }
        }

        $course->update($data);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        // ❗ Optional: delete files from storage
        foreach (['thumbnail', 'cover_image', 'trial_video'] as $file) {
            if ($course->$file && Storage::disk('public')->exists($course->$file)) {
                Storage::disk('public')->delete($course->$file);
            }
        }

        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
