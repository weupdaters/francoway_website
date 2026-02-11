<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /* ===============================
        1️⃣ List Lessons
    ================================*/
    public function index(Course $course)
{
    $lessons = Lesson::with(['section'])
        ->where('course_id', $course->id)
        ->latest()
        ->paginate(10);

    return view('admin.lessons.index', compact('lessons', 'course'));
}


    /* ===============================
        2️⃣ Create Lesson Form
    ================================*/
    public function create(course $course )
    {
        return view('admin.lessons.create', [
            'course'    => $course,            
            'courses'  => Course::latest()->get(),
            'sections' => Section::latest()->get(),
        ]);
    }

    /* ===============================
        3️⃣ Store Lesson OR Section
    ================================*/
   public function store(Request $request, Course $course)
{
    /* ✅ SECTION CREATE */
    if ($request->filled('new_section_title')) {

        $request->validate([
            'new_section_title' => 'required|string|max:255',
        ]);

        Section::create([
            'course_id' => $course->id,   
            'title'     => $request->new_section_title,
        ]);

        return back()->with('success', 'Section created successfully');
    }

    /* ✅ LESSON CREATE */
    $data = $request->validate([
        'section_id'  => 'nullable|exists:sections,id',
        'title'       => 'required|string|max:255',
        'lesson_type' => 'required|string',
        'description' => 'nullable|string',

        'video_file'  => 'nullable|file|mimes:mp4,mov,avi',
        'pdf_file'    => 'nullable|file|mimes:pdf',
        'image_file'  => 'nullable|file|mimes:jpg,jpeg,png',
        'audio_file'  => 'nullable|file|mimes:mp3,wav',
        'summary'     => 'nullable|string',
    ]);

    // 👇 course_id URL se forcefully set
    $lesson = new Lesson($data);
    $lesson->course_id = $course->id;

    // 📁 File uploads
    $lesson->video_file = $this->uploadFile($request, 'video_file', 'lessons/videos');
    $lesson->pdf_file   = $this->uploadFile($request, 'pdf_file', 'lessons/pdfs');
    $lesson->image_file = $this->uploadFile($request, 'image_file', 'lessons/images');
    $lesson->audio_file = $this->uploadFile($request, 'audio_file', 'lessons/audio');

    $lesson->save();

    return redirect()
        ->route('admin.lessons.index', $course->id)
        ->with('success', 'Lesson created successfully');
}

    /* ===============================
        4️⃣ Show Lesson
    ================================*/
public function show(Course $course, Lesson $lesson)
{
    $lesson->load(['course', 'section', 'comments.user']);

    return view('admin.lessons.show', compact('lesson', 'course'));
}



    /* ===============================
        5️⃣ Edit Lesson
    ================================*/
    public function edit(Course $course, Lesson $lesson)
    {
        return view('admin.lessons.edit', [
            'course'    => $course,
            'lesson'   => $lesson,
            'courses'  => Course::all(),
            'sections' => Section::where('course_id', $lesson->course_id)->get(),
        ]);
    }

    /* ===============================
        6️⃣ Update Lesson
    ================================*/
    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'section_id'  => 'required|exists:sections,id',
            'title'       => 'required|string|max:255',
            'lesson_type' => 'required|string',
            'description' => 'nullable|string',

            'video_file'  => 'nullable|file|mimes:mp4,mov,avi',
            'pdf_file'    => 'nullable|file|mimes:pdf',
            'image_file'  => 'nullable|file|mimes:jpg,jpeg,png',
            'audio_file'  => 'nullable|file|mimes:mp3,wav',
            'summary'     => 'nullable|string',
        ]);

        $this->replaceFile($request, $lesson, 'video_file', 'lessons/videos');
        $this->replaceFile($request, $lesson, 'pdf_file', 'lessons/pdfs');
        $this->replaceFile($request, $lesson, 'image_file', 'lessons/images');
        $this->replaceFile($request, $lesson, 'audio_file', 'lessons/audio');

        $lesson->update($data);

        return redirect()
            ->route('admin.lessons.index')
            ->with('success', 'Lesson updated successfully');
    }

    /* ===============================
        7️⃣ Delete Lesson
    ================================*/
    public function destroy(Lesson $lesson)
    {
        $this->deleteAllFiles($lesson);
        $lesson->delete();

        return redirect()
            ->route('admin.lessons.index')
            ->with('success', 'Lesson deleted successfully');
    }

    /* =====================================================
        🔧 Helper Methods (Admin Level Clean Code)
    ======================================================*/

    private function uploadFile(Request $request, string $field, string $path)
    {
        return $request->hasFile($field)
            ? $request->file($field)->store($path, 'public')
            : null;
    }

    private function replaceFile(Request $request, Lesson $lesson, string $field, string $path)
    {
        if ($request->hasFile($field)) {
            Storage::disk('public')->delete($lesson->$field);
            $lesson->$field = $request->file($field)->store($path, 'public');
        }
    }

    private function deleteAllFiles(Lesson $lesson)
    {
        Storage::disk('public')->delete([
            $lesson->video_file,
            $lesson->pdf_file,
            $lesson->image_file,
            $lesson->audio_file,
        ]);
    }
}
