<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /* =====================================================
        LIST LESSONS (LOAD FIX)
    ======================================================*/
    public function index(Request $request, Course $course)
    {
        $search = $request->query('search');
        $query = Lesson::where('course_id', $course->id)->with('section')->latest();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $lessons = $query->paginate(10)->withQueryString();

        return view('admin.lessons.index', compact('course', 'lessons'));
    }

    /* =====================================================
        CREATE
    ======================================================*/
    public function create(Course $course)
    {


        $sections = Section::where('course_id', $course->id)->get();

        return view('admin.lessons.create', compact('course', 'sections'));
    }


    public function storeSectionLesson(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);
        $section = Section::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Section created successfully.',
            'section' => $section,
        ]);

    }


    /* =====================================================
        STORE
    ======================================================*/
    public function store(Request $request, Course $course)
    {

        $data = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'title' => 'required|string|max:255',
            'lesson_type' => 'required|in:video,pdf,image,audio,summary',
            'description' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:51200',
            'audio_file' => 'nullable|file|mimes:mp3,wav',
            'pdf_file' => 'nullable|file|mimes:pdf',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'summary' => 'nullable|string',
        ]);

        $lesson = new Lesson();
        $lesson->course_id = $course->id;
        $lesson->teacher_id = auth()->id();
        $lesson->section_id = $data['section_id'] ?? null;
        $lesson->title = $data['title'];
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
            ->route('admin.lessons.index', $course)
            ->with('success', 'Lesson created successfully');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->deleteAllFiles($lesson);
        $lesson->delete();

        return redirect()
            ->route('admin.lessons.index', $course)
            ->with('success', 'Lesson deleted successfully');
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
            'course' => $course,
            'lessons' => $lessons,
        ]);
    }

    public function edit(Course $course, Lesson $lesson)
    {

        if ($lesson->course_id != $course->id) {
            return redirect()->route('admin.lessons.index', $course)
                ->with('error', 'Lesson does not belong to this course.');
        }

        $sections = Section::where('course_id', $course->id)
            ->orderBy('id')
            ->get();

        return view('admin.lessons.edit', compact('lesson', 'course', 'sections'));
    }


    //show lesson
    public function show(Course $course, Lesson $lesson)
{
    if ($lesson->course_id !== $course->id) {
        abort(404);
    }

    return view('admin.lessons.show', compact('lesson', 'course'));
}

    //update
    /* =====================================================
        UPDATE
    ======================================================*/
    public function update(Request $request, Course $course, Lesson $lesson)
    {

        if ($lesson->course_id != $course->id) {
            abort(404);
        }

        /* ---------------- VALIDATION ---------------- */

        $request->validate([
            'title' => 'required|string|max:255',
            'lesson_type' => 'required|in:video,pdf,image,audio,summary',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi',
            'pdf_file' => 'nullable|file|mimes:pdf',
            'image_file' => 'nullable|image',
            'audio_file' => 'nullable|file|mimes:mp3,wav',
            'summary' => 'nullable|string',
        ]);


        /* ---------------- BASIC UPDATE ---------------- */

        $lesson->title = $request->title;
        $lesson->lesson_type = $request->lesson_type;
        $lesson->description = $request->description;
        if ($request->lesson_type == 'summary') {
    $lesson->summary = $request->summary;
}
        


        /* ---------------- REMOVE SECTION ---------------- */

        if ($request->remove_section) {
            $lesson->section_id = null;
        } else {
            $lesson->section_id = $request->section_id;
        }


        /* ---------------- REMOVE FILE BUTTON ---------------- */

        if ($request->remove_file) {

            if ($request->remove_file == 'video') {
                $this->deleteFile($lesson->video_file);
                $lesson->video_file = null;
                
            }

            if ($request->remove_file == 'pdf') {
                $this->deleteFile($lesson->pdf_file);
                $lesson->pdf_file = null;
            }

            if ($request->remove_file == 'image') {
                $this->deleteFile($lesson->image_file);
                $lesson->image_file = null;
            }

            if ($request->remove_file == 'audio') {
                $this->deleteFile($lesson->audio_file);
                $lesson->audio_file = null;
            }
            if ($request->remove_file == 'summary') {
                $lesson->summary = null;
            }
        }


        /* ---------------- NEW FILE UPLOAD ---------------- */

        if ($request->hasFile('video_file')) {

            $this->deleteFile($lesson->video_file);

            $lesson->video_file = $this->uploadFile(
                $request,
                'video_file',
                'lessons/videos'
            );
        }


        if ($request->hasFile('pdf_file')) {

            $this->deleteFile($lesson->pdf_file);

            $lesson->pdf_file = $this->uploadFile(
                $request,
                'pdf_file',
                'lessons/pdfs'
            );
        }


        if ($request->hasFile('image_file')) {

            $this->deleteFile($lesson->image_file);

            $lesson->image_file = $this->uploadFile(
                $request,
                'image_file',
                'lessons/images'
            );
        }


        if ($request->hasFile('audio_file')) {

            $this->deleteFile($lesson->audio_file);

            $lesson->audio_file = $this->uploadFile(
                $request,
                'audio_file',
                'lessons/audios'
            );
        
        }


        /* ---------------- SAVE ---------------- */

        $lesson->save();

        return back()->with('success', 'Lesson Updated Successfully');
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
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Reply added');
    }

    private function deleteFile($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }




}
