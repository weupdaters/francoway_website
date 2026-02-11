@extends('teachers.layouts.app')

@section('title', 'Create Lesson')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Create Lesson</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.dashboard') }}" class="text-decoration-none">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active">Create Lesson</li>
            </ol>
        </nav>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('teacher.lessons.store', $course) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- 🔐 FIXED COURSE --}}
        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border mb-4">
                    <h5 class="mb-3">Lesson Details</h5>

                    {{-- Section --}}
                    <div class="mb-3">
                        <label class="form-label">Select Section</label>
                        <select class="form-select" name="section_id">
                            <option value="">-- No Section --</option>
                            @foreach($course->sections as $section)
                                <option value="{{ $section->id }}">
                                    {{ $section->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lesson Title --}}
                    <div class="mb-3">
                        <label class="form-label">Lesson Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               required>
                    </div>

                    {{-- Lesson Type --}}
                    <div class="mb-3">
                        <label class="form-label">Lesson Type</label>
                        <select name="lesson_type"
                                id="lessonType"
                                class="form-select"
                                required>
                            <option value="">-- Select Type --</option>
                            <option value="video">Video</option>
                            <option value="pdf">PDF</option>
                            <option value="image">Image</option>
                            <option value="audio">Audio</option>
                            <option value="summary">Summary</option>
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Lesson Description</label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  rows="6"></textarea>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border mb-4">
                    <h5 class="mb-3">Lesson Content</h5>

                    <div class="lesson-input d-none mb-3" id="videoInput">
                        <label>Upload Video</label>
                        <input type="file" name="video_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="pdfInput">
                        <label>Upload PDF</label>
                        <input type="file" name="pdf_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="imageInput">
                        <label>Upload Image</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="audioInput">
                        <label>Upload Audio</label>
                        <input type="file" name="audio_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="summaryInput">
                        <label>Summary</label>
                        <textarea name="summary" class="form-control"></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary w-100">
                            Save Lesson
                        </button>
                        <a href="{{ route('teacher.dashboard') }}"
                           class="btn btn-outline-secondary w-100">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#description'));

document.getElementById('lessonType').addEventListener('change', function () {
    document.querySelectorAll('.lesson-input')
        .forEach(el => el.classList.add('d-none'));

    if (this.value === 'video') videoInput.classList.remove('d-none');
    if (this.value === 'pdf') pdfInput.classList.remove('d-none');
    if (this.value === 'image') imageInput.classList.remove('d-none');
    if (this.value === 'audio') audioInput.classList.remove('d-none');
    if (this.value === 'summary') summaryInput.classList.remove('d-none');
});
</script>

@endsection
