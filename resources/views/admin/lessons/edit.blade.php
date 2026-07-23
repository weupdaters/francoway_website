@extends('admin.layouts.app')

@section('title', 'Edit Lesson')

@section('content')

  <div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
      <h3 class="mb-0">Edit Lesson for {{ $course->title }}</h3>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14">Dashboard</span>
            </a>
          </li>
          <li class="breadcrumb-item active">
          <a href="{{ route('admin.courses.index', $course->id) }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14 hover">course</span>
            </a>
          </li>
          <li class="breadcrumb-item active">
            <a href="{{ route('admin.lessons.index', $course->id) }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14 hover">Lessons</span>
            </a>
          </li>
          <li class="breadcrumb-item active">
           <a href="{{ route('admin.lessons.edit', [$course->id, $lesson->id]) }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14 hover">{{ $lesson->title }}</span>
            </a>
          </li>
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

    <form action="{{ route('admin.lessons.update', [$course->id, $lesson->id]) }}" method="POST"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row">

        {{-- LEFT --}}
        <div class="col-lg-8">
          <div class="card p-4 mb-4 bg-white">

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

              <small class="text-primary mt-1 d-inline-block" style="cursor:pointer" data-bs-toggle="modal"
                data-bs-target="#addSectionModal">
                If no section available, please add one first. Click here to add.
              </small>
            </div>

            {{-- Title --}}
            <div class="mb-3">
              <label class="fw-semibold">Lesson Title</label>
              <input type="text" class="form-control" name="title" value="{{ old('title', $lesson->title) }}"
                required>
            </div>

            {{-- Type --}}
            <div class="mb-3">
              <label class="fw-semibold">Lesson Type</label>
              <select name="lesson_type" id="lessonType" class="form-select" required>
                <option value="">-- Select Type --</option>
                @foreach (['video', 'pdf', 'image', 'audio', 'summary'] as $type)
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
              <textarea name="description" id="description" class="form-control" style="height:150px;">{!! old('description', $lesson->description) !!}</textarea>
            </div>

          </div>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">
          <div class="card p-4 bg-white">

            {{-- VIDEO --}}
            <div class="lesson-input {{ $lesson->lesson_type !== 'video' ? 'd-none' : '' }}" id="videoInput">

              <label>Replace Video</label>

              @if ($lesson->video_file)
                <div class="mb-2 position-relative d-inline-block">

                  <video width="250" controls>
                    <source src="{{ asset('storage/' . $lesson->video_file) }}">
                  </video>

                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-file"
                    data-type="video">✕</button>
                </div>
              @endif

              <input type="file" name="video_file" class="form-control">
            </div>

            {{-- PDF --}}
            <div class="lesson-input {{ $lesson->lesson_type !== 'pdf' ? 'd-none' : '' }}" id="pdfInput">

              <label>Replace PDF</label>

              @if ($lesson->pdf_file)
                <div class="mb-2">

                  <a href="{{ asset('storage/' . $lesson->pdf_file) }}" target="_blank" class="btn btn-info">View PDF</a>

                  <button type="button" class="btn btn-danger btn-sm remove-file" data-type="pdf">✕</button>
                </div>
              @endif

              <input type="file" name="pdf_file" class="form-control">
            </div>

            {{-- IMAGE --}}
            <div class="lesson-input {{ $lesson->lesson_type !== 'image' ? 'd-none' : '' }}" id="imageInput">

              <label>Replace Image</label>

              @if ($lesson->image_file)
                <div class="mb-2 position-relative d-inline-block">

                  <img src="{{ asset('storage/' . $lesson->image_file) }}" width="200">

                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-file"
                    data-type="image">✕</button>
                </div>
              @endif

              <input type="file" name="image_file" class="form-control">
            </div>

            {{-- AUDIO --}}
            <div class="lesson-input {{ $lesson->lesson_type !== 'audio' ? 'd-none' : '' }}" id="audioInput">

              <label>Replace Audio</label>

              @if ($lesson->audio_file)
                <div class="mb-2">

                  <audio controls>
                    <source src="{{ asset('storage/' . $lesson->audio_file) }}">
                  </audio>
                
                  <button type="button" class="btn btn-danger btn-sm remove-file" data-type="audio" class="remove-file">✕</button>
                </div>
              @endif
          
              <input type="file" name="audio_file" class="form-control">
            </div>

            <button class="btn btn-primary w-100 mt-3">
              Update Lesson
            </button>

          </div>
        </div>

      </div>
    </form>

  </div>

@endsection

@push('scripts')
  {{-- CKEditor --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

  <script>
    $(document).ready(function() {

      ClassicEditor.create(document.querySelector('#description'));

      // lesson type toggle
      $('#lessonType').on('change', function() {
        $('.lesson-input').addClass('d-none');
        if (this.value === 'video') $('#videoInput').removeClass('d-none');
        if (this.value === 'pdf') $('#pdfInput').removeClass('d-none');
        if (this.value === 'image') $('#imageInput').removeClass('d-none');
        if (this.value === 'audio') $('#audioInput').removeClass('d-none');
        if (this.value === 'summary') $('#summaryInput').removeClass('d-none');
      });

      // save section via ajax
      $('#saveSectionBtn').on('click', function() {

        let title = $('#sectionTitle').val().trim();
        let courseId = "{{ $course->id }}";

        $('#sectionError').addClass('d-none');

        if (!title) {
          $('#sectionError').text('Enter section title').removeClass('d-none');
          return;
        }

        $.ajax({
          url: "{{ route('admin.sections.store', $course) }}",
          type: "POST",
          data: {
            title: title,
            course_id: courseId,
            _token: "{{ csrf_token() }}"
          },
          success: function(data) {
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
          error: function() {
            $('#sectionError').text('Unable to save section')
              .removeClass('d-none');
          }
        });
      });

    });


    // remove file
    $(document).on('click', '.remove-file', function() {

      if (!confirm("Remove this file?")) return;

      let type = $(this).data('type');

      $('#removeFile').val(type);

      $(this).parent().remove();
    });
  </script>
@endpush
