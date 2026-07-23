@extends('admin.layouts.app')

@section('title', 'Create Lesson')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">{{ $course->title }}</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li
        
                <li class="breadcrumb-item">
                <a href="{{ route('admin.courses.index') }}" class="text-decoration-none">
                    <span class="text-body fs-14 hover">Courses</span>
                </a>
                </li>

                <li class="breadcrumb-item">
                <a href="{{ route('admin.lessons.index', $course->id) }}" class="text-decoration-none">
                    <span class="text-body fs-14 hover">Lesson</span>
                </a>
                </li> 

                <li class="breadcrumb-item active">
                    <span class="text-secondary">Create Lesson</span>
                </li>
            </ol>
        </nav>
    </div>

  <div class="main-content-container overflow-hidden">

    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-20 rounded-10 border border-white">
      <h3>Create Lesson</h3>
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

    <form action="{{ route('admin.lessons.store', $course->id) }}" method="POST" enctype="multipart/form-data"
      class="needs-validation " novalidate>
      @csrf

      <div class="row">

        {{-- LEFT --}}
        <div class="col-lg-8">
          <div class="card bg-white p-20 rounded-10 border border-white mb-4">
          

            {{-- Section --}}
            <div class="mb-20">
              <label class="label fs-16 mb-2">Select Section</label>
              <select class="form-select" name="section_id" id="sectionSelect" required>
                @forelse ($sections as $section)
                  <option value="{{ $section->id }}">{{ $section->title }}</option>
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
              <input type="text" class="form-control" name="title" required>
            </div>

            {{-- Type --}}
            <div class="mb-3">
              <label class="fw-semibold">Lesson Type</label>
              <select name="lesson_type" id="lessonType" class="form-select" required>
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
              <label class="fw-semibold">Description</label>
              <textarea name="description" id="description" class="form-control" style="height:150px;"></textarea>
            </div>

          </div>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">
          <div class="card bg-white p-20 rounded-10 border border-white mb-4">

            <div class="lesson-input d-none mb-3" id="videoInput">
              <label class="fw-semibold"><i class="bi bi-camera-video text-primary me-1"></i>Upload Video</label>
              <div id="videoPreviewWrap" class="d-none mb-2">
                <div style="position:relative;border-radius:8px;overflow:hidden;background:#071530;">
                  <video id="videoPreviewEl" controls style="width:100%;max-height:180px;display:block;"></video>
                  <button type="button" id="clearVideoBtn"
                    style="position:absolute;top:6px;right:6px;background:rgba(0,0,0,0.6);border:none;border-radius:50%;width:26px;height:26px;color:#fff;font-size:13px;cursor:pointer;">✕</button>
                </div>
                <small class="text-muted mt-1 d-block" id="videoFileName"></small>
              </div>
              <input type="file" name="video_file" id="videoFileInput" class="form-control" accept="video/mp4,video/mov,video/avi">
            </div>

            <div class="lesson-input d-none mb-3" id="pdfInput">
              <label class="fw-semibold"><i class="bi bi-file-earmark-pdf text-danger me-1"></i>Upload PDF</label>
              <div id="pdfPreviewWrap" class="d-none mb-2">
                <div class="d-flex align-items-center gap-2 p-2 rounded" style="background:#fff0f0;border:1px dashed #e74c3c;">
                  <i class="bi bi-file-earmark-pdf-fill text-danger fs-3"></i>
                  <small class="text-dark fw-semibold" id="pdfFileName"></small>
                </div>
              </div>
              <input type="file" name="pdf_file" id="pdfFileInput" class="form-control" accept="application/pdf">
            </div>

            <div class="lesson-input d-none mb-3" id="imageInput">
              <label class="fw-semibold"><i class="bi bi-image text-success me-1"></i>Upload Image</label>
              <div id="imagePreviewWrap" class="d-none mb-2">
                <div style="position:relative;display:inline-block;width:100%;">
                  <img id="imagePreviewEl" src="" alt="Preview"
                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e0e0e0;">
                  <button type="button" id="clearImageBtn"
                    style="position:absolute;top:6px;right:6px;background:rgba(0,0,0,0.6);border:none;border-radius:50%;width:26px;height:26px;color:#fff;font-size:13px;cursor:pointer;">✕</button>
                </div>
                <small class="text-muted mt-1 d-block" id="imageFileName"></small>
              </div>
              <input type="file" name="image_file" id="imageFileInput" class="form-control" accept="image/jpg,image/jpeg,image/png,image/webp">
            </div>

            <div class="lesson-input d-none mb-3" id="audioInput">
              <label class="fw-semibold"><i class="bi bi-mic text-warning me-1"></i>Upload Audio</label>
              <div id="audioPreviewWrap" class="d-none mb-2">
                <audio id="audioPreviewEl" controls style="width:100%;"></audio>
                <small class="text-muted mt-1 d-block" id="audioFileName"></small>
              </div>
              <input type="file" name="audio_file" id="audioFileInput" class="form-control" accept="audio/mp3,audio/wav">
            </div>

            <div class="lesson-input d-none mb-3" id="summaryInput">
              <label class="fw-semibold">Summary</label>
              <textarea name="summary" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary w-100">Save Lesson</button>

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
          <input type="text" id="sectionTitle" class="form-control" placeholder="Section title">
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

      // ---- IMAGE PREVIEW ----
      $('#imageFileInput').on('change', function() {
        const file = this.files[0];
        if (!file) return;
        $('#imagePreviewEl').attr('src', URL.createObjectURL(file));
        $('#imageFileName').text(file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)');
        $('#imagePreviewWrap').removeClass('d-none');
      });
      $('#clearImageBtn').on('click', function() {
        $('#imageFileInput').val('');
        $('#imagePreviewEl').attr('src', '');
        $('#imageFileName').text('');
        $('#imagePreviewWrap').addClass('d-none');
      });

      // ---- VIDEO PREVIEW ----
      $('#videoFileInput').on('change', function() {
        const file = this.files[0];
        if (!file) return;
        const v = document.getElementById('videoPreviewEl');
        v.src = URL.createObjectURL(file);
        v.load();
        $('#videoFileName').text(file.name + ' (' + (file.size / 1024 / 1024).toFixed(1) + ' MB)');
        $('#videoPreviewWrap').removeClass('d-none');
      });
      $('#clearVideoBtn').on('click', function() {
        $('#videoFileInput').val('');
        document.getElementById('videoPreviewEl').src = '';
        $('#videoFileName').text('');
        $('#videoPreviewWrap').addClass('d-none');
      });

      // ---- AUDIO PREVIEW ----
      $('#audioFileInput').on('change', function() {
        const file = this.files[0];
        if (!file) return;
        const a = document.getElementById('audioPreviewEl');
        a.src = URL.createObjectURL(file);
        a.load();
        $('#audioFileName').text(file.name);
        $('#audioPreviewWrap').removeClass('d-none');
      });

      // ---- PDF INDICATOR ----
      $('#pdfFileInput').on('change', function() {
        const file = this.files[0];
        if (!file) return;
        $('#pdfFileName').text(file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)');
        $('#pdfPreviewWrap').removeClass('d-none');
      });


      $('#saveSectionBtn').on('click', function() {

        let title = $('#sectionTitle').val().trim();
        let courseId = "{{ $course->id }}";

        $('#sectionError').addClass('d-none');

        if (!title || !courseId) {
          $('#sectionError')
            .text('Select course & enter section title')
            .removeClass('d-none');
          return;
        }

        $.ajax({
          url: "{{ route('admin.sections.store', $course->id) }}",
          type: "POST",
          data: {
            title: title,
            course_id: courseId,
            _token: "{{ csrf_token() }}"
          },
          success: function(data) {
            if (!data.success) {
              $('#sectionError')
                .text(data.message || 'Unable to save section')
                .removeClass('d-none');
              return;
            } else {
              showToast(data.message || 'Section added successfully!', 'success');
            }


            // add new section to dropdown
            $('#sectionSelect').append(
              `<option value="${data.section.id}" selected>${data.section.title}</option>`
            );

            // close modal
            $('#addSectionModal').modal('hide');

            // reset input
            $('#sectionTitle').val('');
          },
          error: function(xhr) {

            let msg = 'Unable to save section';

            if (xhr.responseJSON && xhr.responseJSON.message) {
              msg = xhr.responseJSON.message;
            }

            $('#sectionError')
              .text(msg)
              .removeClass('d-none');
          }
        });
      });

    });
  </script>
@endpush
