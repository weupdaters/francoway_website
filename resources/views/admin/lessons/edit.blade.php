@extends('admin.layouts.app')

@section('title', 'Edit Lesson')

@section('content')

<div class="main-content-container overflow-hidden">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Edit Lesson for {{ $course->title }}</h3>
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

    <form action="{{ route('admin.lessons.update', [$course->id, $lesson->id]) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">
                <div class="card p-4 mb-4">

                    {{-- Section --}}
                    <div class="mb-3">
                        <label class="fw-semibold">Select Section</label>
                        <select class="form-select" name="section_id" id="sectionSelect" required>
                            @forelse ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ old('section_id', $lesson->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->title }}
                                </option>
                            @empty
                                <option value="">No section available</option>
                            @endforelse
                        </select>

                        <small class="text-primary mt-1 d-inline-block"
                               style="cursor:pointer"
                               data-bs-toggle="modal"
                               data-bs-target="#addSectionModal">
                            If no section available, please add one first. Click here to add.
                        </small>
                    </div>

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="fw-semibold">Lesson Title</label>
                        <input type="text"
                               class="form-control"
                               name="title"
                               value="{{ old('title', $lesson->title) }}"
                               required>
                    </div>

                    {{-- Type --}}
                    <div class="mb-3">
                        <label class="fw-semibold">Lesson Type</label>
                        <select name="lesson_type" id="lessonType" class="form-select" required>
                            <option value="">-- Select Type --</option>
                            @foreach (['video','pdf','image','audio','summary'] as $type)
                                <option value="{{ $type }}"
                                    {{ old('lesson_type', $lesson->lesson_type) === $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="fw-semibold">Description</label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  style="height:150px;">{!! old('description', $lesson->description) !!}</textarea>
                    </div>

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">
                <div class="card p-4 mb-4">

                    <div class="lesson-input mb-3 {{ $lesson->lesson_type !== 'video' ? 'd-none' : '' }}" id="videoInput">
                        <label>Replace Video</label>
                        <input type="file" name="video_file" class="form-control">
                    </div>

                    <div class="lesson-input mb-3 {{ $lesson->lesson_type !== 'pdf' ? 'd-none' : '' }}" id="pdfInput">
                        <label>Replace PDF</label>
                        <input type="file" name="pdf_file" class="form-control">
                    </div>

                    <div class="lesson-input mb-3 {{ $lesson->lesson_type !== 'image' ? 'd-none' : '' }}" id="imageInput">
                        <label>Replace Image</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>

                    <div class="lesson-input mb-3 {{ $lesson->lesson_type !== 'audio' ? 'd-none' : '' }}" id="audioInput">
                        <label>Replace Audio</label>
                        <input type="file" name="audio_file" class="form-control">
                    </div>

                    <div class="lesson-input mb-3 {{ $lesson->lesson_type !== 'summary' ? 'd-none' : '' }}" id="summaryInput">
                        <label>Summary</label>
                        <textarea name="summary" class="form-control">{{ old('summary', $lesson->summary) }}</textarea>
                    </div>

                    <button class="btn btn-primary w-100">
                        Update Lesson
                    </button>

                </div>
            </div>

        </div>
    </form>
</div>

{{-- ADD SECTION MODAL --}}
<div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add Section</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="text" id="sectionTitle" class="form-control"
                       placeholder="Section title">
                <div class="text-danger small d-none mt-2" id="sectionError"></div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="saveSectionBtn">Save</button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
$(document).ready(function () {

    ClassicEditor.create(document.querySelector('#description'));

    // lesson type toggle
    $('#lessonType').on('change', function () {
        $('.lesson-input').addClass('d-none');
        if (this.value === 'video') $('#videoInput').removeClass('d-none');
        if (this.value === 'pdf') $('#pdfInput').removeClass('d-none');
        if (this.value === 'image') $('#imageInput').removeClass('d-none');
        if (this.value === 'audio') $('#audioInput').removeClass('d-none');
        if (this.value === 'summary') $('#summaryInput').removeClass('d-none');
    });

    // save section via ajax
    $('#saveSectionBtn').on('click', function () {

        let title    = $('#sectionTitle').val().trim();
        let courseId = "{{ $course->id }}";

        $('#sectionError').addClass('d-none');

        if (!title) {
            $('#sectionError').text('Enter section title').removeClass('d-none');
            return;
        }

        $.ajax({
            url: "{{ route('admin.sections.store') }}",
            type: "POST",
            data: {
                title: title,
                course_id: courseId,
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (!data.success) {
                    $('#sectionError').text(data.message || 'Unable to save section')
                                      .removeClass('d-none');
                    return;
                }

                $('#sectionSelect').append(
                    `<option value="${data.section.id}" selected>${data.section.title}</option>`
                );

                $('#addSectionModal').modal('hide');
                $('#sectionTitle').val('');
            },
            error: function () {
                $('#sectionError').text('Unable to save section')
                                  .removeClass('d-none');
            }
        });
    });

});
</script>
@endpush
