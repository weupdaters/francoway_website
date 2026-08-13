<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $locale = app()->getLocale();
        $query = Course::latest();

        if ($locale === 'fr') {
            $query->where('lang', 'fr');
        } else {
            $query->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $courses = $query->paginate(10)->withQueryString();
        $allPrompts = \App\Models\Prompt::with('course')->latest()->paginate(10, ['*'], 'prompts_page')->withQueryString();
        return view('admin.courses.index', compact('courses', 'allPrompts'));
    }

    public function create()
    {
        $predefinedPrompts = Prompt::where('status', true)->get();
        return view('admin.courses.create', compact('predefinedPrompts'));
    }

    // =========================
    // STORE COURSE (ADMIN ONLY)
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required', // published / draft
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'trial_video' => 'nullable',
            'prompts' => 'nullable|array',
            'lang' => 'nullable|string|in:en,fr',
        ]);

        if (empty($data['lang'])) {
            $data['lang'] = app()->getLocale();
        }

        $prompts = $request->input('prompts', []);
        $cleanPrompts = [
            'reading' => $prompts['reading'] ?? null,
            'listening' => $prompts['listening'] ?? null,
            'speaking' => $prompts['speaking'] ?? null,
            'writing' => $prompts['writing'] ?? null,
        ];

        // Determine if there is any custom prompt configured
        $hasCustomPrompt = false;
        foreach ($cleanPrompts as $value) {
            if (!empty(trim($value ?? ''))) {
                $hasCustomPrompt = true;
                break;
            }
        }

        $data['has_custom_prompt'] = $hasCustomPrompt;
        $data['custom_prompt'] = $hasCustomPrompt ? json_encode($cleanPrompts) : null;



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
        $predefinedPrompts = Prompt::where('status', true)->get();
        return view('admin.courses.edit', compact('course', 'predefinedPrompts'));
    }

    // =========================
    // UPDATE COURSE
    // =========================
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'trial_video' => 'nullable',
            'prompts' => 'nullable|array',
            'lang' => 'nullable|string|in:en,fr',
        ]);

        $prompts = $request->input('prompts', []);
        $cleanPrompts = [
            'reading' => $prompts['reading'] ?? null,
            'listening' => $prompts['listening'] ?? null,
            'speaking' => $prompts['speaking'] ?? null,
            'writing' => $prompts['writing'] ?? null,
        ];

        // Determine if there is any custom prompt configured
        $hasCustomPrompt = false;
        foreach ($cleanPrompts as $value) {
            if (!empty(trim($value ?? ''))) {
                $hasCustomPrompt = true;
                break;
            }
        }

        $data['has_custom_prompt'] = $hasCustomPrompt;
        $data['custom_prompt'] = $hasCustomPrompt ? json_encode($cleanPrompts) : null;

        // 🔁 Update slug if title changed or if slug is currently empty
        if ($course->title !== $request->title || empty($course->slug)) {
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

    public function updatePrompt(Request $request, Course $course)
    {
        $request->validate([
            'prompts' => 'nullable|array',
        ]);

        $prompts = $request->input('prompts', []);
        $cleanPrompts = [
            'reading' => $prompts['reading'] ?? null,
            'listening' => $prompts['listening'] ?? null,
            'speaking' => $prompts['speaking'] ?? null,
            'writing' => $prompts['writing'] ?? null,
        ];

        // Determine if there is any custom prompt configured
        $hasCustomPrompt = false;
        foreach ($cleanPrompts as $value) {
            if (!empty(trim($value ?? ''))) {
                $hasCustomPrompt = true;
                break;
            }
        }

        $course->update([
            'has_custom_prompt' => $hasCustomPrompt,
            'custom_prompt' => $hasCustomPrompt ? json_encode($cleanPrompts) : null,
        ]);

        return redirect()
            ->back()
            ->with('success', 'AI custom prompts updated successfully');
    }

    public function destroy(Course $course)
    {
    
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
