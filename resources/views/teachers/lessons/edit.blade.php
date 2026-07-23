@extends('teachers.layouts.app')

@section('title', 'Edit Lesson')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Edit Lesson</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.dashboard') }}" class="text-decoration-none">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active">Edit Lesson</li>
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
    <form method="POST"
          action="{{ route('teacher.lessons.update', $lesson) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border mb-4">
                    <h5 class="mb-3">Lesson Details</h5>

                    {{-- Course --}}
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $lesson->course->title }}"
                               readonly>
                    </div>

                    {{-- Section --}}
                    <div class="mb-3">
                        <label class="form-label">Select Section</label>
                        <select name="section_id" class="form-select">
                            <option value="">-- No Section --</option>
                            @foreach($lesson->course->sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ $lesson->section_id == $section->id ? 'selected' : '' }}>
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
                               value="{{ $lesson->title }}"
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
                            @foreach(['video','pdf','image','audio','summary'] as $type)
                                <option value="{{ $type }}"
                                    {{ $lesson->lesson_type === $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Lesson Description</label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  rows="6">{{ $lesson->description }}</textarea>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border mb-4">
                    <h5 class="mb-3">Lesson Content</h5>

                    {{-- Existing info --}}
                    @if($lesson->content)
                        <p class="text-muted small">
                            Current file: {{ basename($lesson->content) }}
                        </p>
                    @endif

                    <div class="lesson-input d-none mb-3" id="videoInput">
                        <label>Replace Video</label>
                        <input type="file" name="video_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="pdfInput">
                        <label>Replace PDF</label>
                        <input type="file" name="pdf_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="imageInput">
                        <label>Replace Image</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="audioInput">
                        <label>Replace Audio</label>
                        <input type="file" name="audio_file" class="form-control">
                    </div>

                    <div class="lesson-input d-none mb-3" id="summaryInput">
                        <label>Summary</label>
                        <textarea name="summary" class="form-control">
{{ $lesson->summary }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary w-100 text-white">
                            Update Lesson
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

function toggleInputs(type) {
    document.querySelectorAll('.lesson-input')
        .forEach(el => el.classList.add('d-none'));

    if (type === 'video') videoInput.classList.remove('d-none');
    if (type === 'pdf') pdfInput.classList.remove('d-none');
    if (type === 'image') imageInput.classList.remove('d-none');
    if (type === 'audio') audioInput.classList.remove('d-none');
    if (type === 'summary') summaryInput.classList.remove('d-none');
}

toggleInputs(document.getElementById('lessonType').value);

document.getElementById('lessonType')
    .addEventListener('change', e => toggleInputs(e.target.value));
</script>

@endsection
