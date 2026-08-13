<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use App\Models\Course;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Prompt::with('course')->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('skill', 'like', "%{$search}%")
                  ->orWhere('prompt_text', 'like', "%{$search}%")
                  ->orWhereHas('course', function($cQuery) use ($search) {
                      $cQuery->where('title', 'like', "%{$search}%");
                  });
            });
        }

        $prompts = $query->paginate(10)->withQueryString();

        return view('admin.prompts.index', compact('prompts'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.prompts.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|exists:courses,id',
            'title' => 'required|string|max:255',
            'skill' => 'required|string|in:reading,listening,speaking,writing',
            'prompt_text' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Prompt::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'skill' => $request->skill,
            'prompt_text' => $request->prompt_text,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.prompts.index')
            ->with('success', 'Prompt created successfully');
    }

    public function edit($id)
    {
        $prompt = Prompt::findOrFail($id);
        $courses = Course::all();
        return view('admin.prompts.edit', compact('prompt', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'nullable|exists:courses,id',
            'title' => 'required|string|max:255',
            'skill' => 'required|string|in:reading,listening,speaking,writing',
            'prompt_text' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $prompt = Prompt::findOrFail($id);
        $prompt->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'skill' => $request->skill,
            'prompt_text' => $request->prompt_text,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.prompts.index')
            ->with('success', 'Prompt updated successfully');
    }

    public function destroy($id)
    {
        Prompt::destroy($id);

        return redirect()->back()
            ->with('success', 'Prompt deleted successfully');
    }
}
