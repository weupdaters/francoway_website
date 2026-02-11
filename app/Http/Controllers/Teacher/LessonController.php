<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;

class LessonController extends Controller
{
    /* =====================================================
        LIST LESSONS (LOAD FIX)
    ======================================================*/
    public function index(Course $course)
    {
        abort_if($course->teacher_id !== auth()->id(), 403);

        $lessons = Lesson::where('course_id', $course->id)
            ->with('section')
            ->latest()
            ->get();

        return view('teachers.lessons.index', compact('course', 'lessons'));
    }

    /* =====================================================
        CREATE
    ======================================================*/
    public function create(Course $course)
    {
        abort_if($course->teacher_id !== auth()->id(), 403);

        $sections = Section::where('course_id', $course->id)->get();

        return view('teachers.lessons.create', compact('course', 'sections'));
    }

    /* =====================================================
        STORE
    ======================================================*/
    public function store(Request $request, Course $course)
    {
        abort_if($course->teacher_id !== auth()->id(), 403);

        $data = $request->validate([
            'section_id'   => 'nullable|exists:sections,id',
            'title'        => 'required|string|max:255',
            'lesson_type'  => 'required|in:video,pdf,image,audio,summary',
            'description'  => 'nullable|string',

            'video_file'   => 'nullable|file|mimes:mp4,mov,avi',
            'audio_file'   => 'nullable|file|mimes:mp3,wav',
            'pdf_file'     => 'nullable|file|mimes:pdf',
            'image_file'   => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'summary'      => 'nullable|string',
        ]);

        $lesson = new Lesson();
        $lesson->course_id   = $course->id;
        $lesson->teacher_id  = auth()->id();
        $lesson->section_id  = $data['section_id'] ?? null;
        $lesson->title       = $data['title'];
        $lesson->lesson_type = $data['lesson_type'];
        $lesson->description = $data['description'] ?? null;

        if ($lesson->lesson_type === 'video') {
            $lesson->video_file = $this->uploadFile($request, 'video_file', 'lessons/videos');
        }

        if ($lesson->lesson_type === 'audio') {
            $lesson->audio_file = $this->uploadFile($request, 'audio_file', 'lessons/audio');
        }

        if ($lesson->lesson_type === 'pdf') {
            $lesson->pdf_file = $this->uploadFile($request, 'pdf_file', 'lessons/pdfs');
        }

        if ($lesson->lesson_type === 'image') {
            $lesson->image_file = $this->uploadFile($request, 'image_file', 'lessons/images');
        }

        if ($lesson->lesson_type === 'summary') {
            $lesson->summary = $data['summary'] ?? null;
        }

        $lesson->save();

        return redirect()
            ->route('teacher.course.lessons', $course)
            ->with('success', 'Lesson created successfully');
    }

    /* =====================================================
        DELETE
    ======================================================*/
    public function destroy(Lesson $lesson)
    {
        abort_if($lesson->teacher_id !== auth()->id(), 403);

        $this->deleteAllFiles($lesson);
        $lesson->delete();

        return response()->json(['success' => true]);
    }

    /* =====================================================
        HELPERS
    ======================================================*/
    private function uploadFile(Request $request, string $field, string $path)
    {
        return $request->hasFile($field)
            ? $request->file($field)->store($path, 'public')
            : null;
    }

    private function deleteAllFiles(Lesson $lesson)
    {
        $files = array_filter([
            $lesson->video_file,
            $lesson->audio_file,
            $lesson->pdf_file,
            $lesson->image_file,
        ]);

        if ($files) {
            Storage::disk('public')->delete($files);
        }
    }

    
public function ajaxLessons($id)
{
    $course = Course::findOrFail($id);

    $lessons = Lesson::where('course_id', $id)
        ->orderBy('id')
        ->get();

    return response()->json([
        'course'  => $course,
        'lessons' => $lessons
    ]);
}

public function edit($id)
{
    $lesson = Lesson::findOrFail($id);

    $course = Course::find($lesson->course_id);

    return view('teachers.lessons.edit', compact('lesson', 'course'));
}

//show lesson
public function show($id)
{
    $lesson = Lesson::findOrFail($id);

    $course = Course::find($lesson->course_id);

    return view('teachers.lessons.show', compact('lesson', 'course'));

}

//update
/* =====================================================
    UPDATE
======================================================*/
public function update(Request $request, Lesson $lesson)
{
    abort_if($lesson->teacher_id !== auth()->id(), 403);

    $data = $request->validate([
        'section_id'   => 'nullable|exists:sections,id',
        'title'        => 'required|string|max:255',
        'lesson_type'  => 'required|in:video,pdf,image,audio,summary',
        'description'  => 'nullable|string',

        'video_file'   => 'nullable|file|mimes:mp4,mov,avi',
        'audio_file'   => 'nullable|file|mimes:mp3,wav',
        'pdf_file'     => 'nullable|file|mimes:pdf',
        'image_file'   => 'nullable|image|mimes:jpg,jpeg,png,webp',
        'summary'      => 'nullable|string',
    ]);

    $lesson->section_id  = $data['section_id'] ?? null;
    $lesson->title       = $data['title'];
    $lesson->lesson_type = $data['lesson_type'];
    $lesson->description = $data['description'] ?? null;

    // 🧹 Purani files delete agar nayi aa rahi ho
    if ($request->hasFile('video_file')) {
        Storage::disk('public')->delete($lesson->video_file);
        $lesson->video_file = $this->uploadFile($request, 'video_file', 'lessons/videos');
    }

    if ($request->hasFile('audio_file')) {
        Storage::disk('public')->delete($lesson->audio_file);
        $lesson->audio_file = $this->uploadFile($request, 'audio_file', 'lessons/audio');
    }

    if ($request->hasFile('pdf_file')) {
        Storage::disk('public')->delete($lesson->pdf_file);
        $lesson->pdf_file = $this->uploadFile($request, 'pdf_file', 'lessons/pdfs');
    }

    if ($request->hasFile('image_file')) {
        Storage::disk('public')->delete($lesson->image_file);
        $lesson->image_file = $this->uploadFile($request, 'image_file', 'lessons/images');
    }

    if ($lesson->lesson_type === 'summary') {
        $lesson->summary = $data['summary'] ?? null;
    }

    $lesson->save();

    return redirect()
        ->route('teacher.lessons.show', $lesson->id)
        ->with('success', 'Lesson updated successfully');
}

//comment store
public function storeComment(Request $request, Lesson $lesson)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $lesson->comments()->create([
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);

    return back()->with('success', 'Comment added');
}

/* =====================================================
    REPLY TO COMMENT (Teacher)
======================================================*/
public function replyComment(Request $request, Comment $comment)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment->replies()->create([
        'lesson_id' => $comment->lesson_id,   // ✅ VERY IMPORTANT
        'user_id'   => auth()->id(),
        'comment'   => $request->comment,
    ]);

    return back()->with('success', 'Reply added');
}


}
