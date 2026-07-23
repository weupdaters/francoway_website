@extends('teachers.layouts.app')

@section('title', 'Create Lesson')

@section('content')
  @push('styles')
  <style>
    /* Custom CSS to match the reference image exactly */
    .tracking-wider {
      letter-spacing: 0.05em;
    }
    .text-primary-indigo {
      color: #4f46e5;
    }
    .text-purple {
      color: #8b5cf6;
    }
    
    /* Input Icon Group styling */
    .input-icon-group {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
    }
    .input-icon-group > i {
      position: absolute;
      left: 16px;
      color: #4f46e5; /* Theme indigo color */
      font-size: 16px;
      z-index: 5;
      pointer-events: none;
    }
    .input-icon-group .form-control,
    .input-icon-group .form-select {
      padding-left: 48px !important;
      padding-right: 65px !important;
      height: 52px !important;
      border: 1.5px solid #e2e8f0 !important;
      border-radius: 12px !important;
      background-color: #ffffff !important;
      color: #0f172a !important;
      font-size: 15px !important;
      font-weight: 500 !important;
    }
    .input-icon-group .form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
      background-position: right 16px center !important;
      background-size: 16px 12px !important;
      padding-right: 48px !important;
    }
    .input-icon-group .form-control:focus,
    .input-icon-group .form-select:focus {
      border-color: #6366f1 !important;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
    }
    .input-icon-group .char-counter {
      position: absolute;
      right: 16px;
      font-size: 13px;
      color: #94a3b8;
      font-weight: 500;
      pointer-events: none;
    }

    /* Section selector custom design */
    .section-select-wrapper {
      display: flex;
      gap: 12px;
      align-items: center;
      width: 100%;
    }
    .add-section-btn {
      width: 52px;
      height: 52px;
      border-radius: 12px;
      background-color: #eef2ff;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #4f46e5;
      transition: all 0.2s ease;
      flex-shrink: 0;
    }
    .add-section-btn:hover {
      background-color: #e0e7ff;
      color: #3730a3;
      transform: translateY(-1px);
    }

    /* Rich Text Editor Border styling */
    .editor-container .ck-editor__top {
      border-top-left-radius: 12px !important;
      border-top-right-radius: 12px !important;
      overflow: hidden;
      border: 1.5px solid #e2e8f0 !important;
      border-bottom: none !important;
    }
    .editor-container .ck-editor__main .ck-content {
      border-bottom-left-radius: 12px !important;
      border-bottom-right-radius: 12px !important;
      border: 1.5px solid #e2e8f0 !important;
      min-height: 200px;
    }
    .editor-container .ck-focused {
      border-color: #6366f1 !important;
      outline: none !important;
    }

    /* Gradient Save button */
    .btn-gradient-indigo {
      background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
      border: none !important;
      border-radius: 14px !important;
      font-weight: 700 !important;
      font-size: 15px !important;
      transition: all 0.25s ease !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25) !important;
    }
    .btn-gradient-indigo:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4) !important;
    }

    /* Tips & Icons styling */
    .tips-header-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: #faf5ff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }
    .tip-icon {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }
    .bg-light-blue { background-color: #eff6ff; }
    .text-blue { color: #3b82f6; }
    .bg-light-green { background-color: #f0fdf4; }
    .text-green { color: #22c55e; }
    .bg-light-yellow { background-color: #fefce8; }
    .text-yellow { color: #eab308; }
    .bg-light-pink { background-color: #fff1f2; }
    .text-pink { color: #ec4899; }
    
    /* Dark Theme Support */
    [data-bs-theme="dark"] .input-icon-group .form-control,
    [data-bs-theme="dark"] .input-icon-group .form-select {
      background-color: #1a1a1a !important;
      border-color: #2b2b2b !important;
      color: #f8fafc !important;
    }
    [data-bs-theme="dark"] .add-section-btn {
      background-color: #2b2b2b;
      color: #8b5cf6;
    }
    [data-bs-theme="dark"] .add-section-btn:hover {
      background-color: #3b3b3b;
    }
    [data-bs-theme="dark"] .bg-light-blue { background-color: rgba(59, 130, 246, 0.1); }
    [data-bs-theme="dark"] .bg-light-green { background-color: rgba(34, 197, 94, 0.1); }
    [data-bs-theme="dark"] .bg-light-yellow { background-color: rgba(234, 179, 8, 0.1); }
    [data-bs-theme="dark"] .bg-light-pink { background-color: rgba(236, 72, 153, 0.1); }
    [data-bs-theme="dark"] .tips-header-icon { background-color: rgba(139, 92, 246, 0.1); }
    [data-bs-theme="dark"] .editor-container .ck-editor__top,
    [data-bs-theme="dark"] .editor-container .ck-editor__main .ck-content {
      border-color: #2b2b2b !important;
      background-color: #1a1a1a !important;
      color: #ffffff !important;
    }
  </style>
  @endpush

  <div class="main-content-container overflow-hidden">

    {{-- Page Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
      <div class="p-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; background-color: #eef2ff !important; border-radius: 14px !important;">
        <i class="bi bi-journal-text text-primary fs-3"></i>
      </div>
      <div>
        <h3 class="mb-1 fw-bold text-dark fs-24">Create New Lesson</h3>
        <p class="text-muted mb-0 fs-14">Add lesson details to build engaging content for your students.</p>
      </div>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
      <div class="alert alert-danger rounded-12 mb-4">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('teacher.lessons.store', $course->id) }}" method="POST" enctype="multipart/form-data"
      class="needs-validation" novalidate>
      @csrf

      <div class="row">

        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">
          <div class="card bg-white p-4 rounded-20 border border-white mb-4">

            {{-- Section --}}
            <div class="mb-4">
              <label class="form-label text-primary-indigo fw-bold fs-11 tracking-wider mb-2">SECTION *</label>
              <div class="section-select-wrapper">
                <div class="input-icon-group">
                  <i class="bi bi-grid-3x3-gap"></i>
                  <select class="form-select" name="section_id" id="sectionSelect" required>
                    <option value="">-- Select Section --</option>
                    @foreach ($sections as $section)
                      <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                  </select>
                </div>
                <button type="button" class="add-section-btn" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                  <i class="bi bi-plus-lg fs-18"></i>
                </button>
              </div>
              <div class="mt-2 fs-13 text-muted">
                If the section you need is not listed, you can add a new one.
              </div>
              <div class="mt-1">
                <a href="javascript:void(0)" class="text-primary fw-semibold fs-13 text-decoration-none" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                  + Add New Section
                </a>
              </div>
            </div>

            {{-- Title --}}
            <div class="mb-4">
              <label class="form-label text-primary-indigo fw-bold fs-11 tracking-wider mb-2">LESSON TITLE *</label>
              <div class="input-icon-group">
                <i class="bi bi-type"></i>
                <input type="text" class="form-control" name="title" id="lessonTitleInput" placeholder="Enter lesson title" maxlength="150" required>
                <span class="char-counter" id="titleCharCounter">0 / 150</span>
              </div>
            </div>

            {{-- Type --}}
            <div class="mb-4">
              <label class="form-label text-primary-indigo fw-bold fs-11 tracking-wider mb-2">LESSON TYPE *</label>
              <div class="input-icon-group">
                <i class="bi bi-layers"></i>
                <select name="lesson_type" id="lessonType" class="form-select" required>
                  <option value="">Choose lesson type</option>
                  <option value="video">Video</option>
                  <option value="pdf">PDF</option>
                  <option value="image">Image</option>
                  <option value="audio">Audio</option>
                  <option value="summary">Summary</option>
                </select>
              </div>
            </div>

            {{-- Dynamic Inputs based on Lesson Type --}}
            <div class="dynamic-inputs-container">

              {{-- VIDEO --}}
              <div class="lesson-input d-none mb-4 p-3 bg-light rounded-12 border" id="videoInput">
                <label class="form-label fw-semibold mb-2"><i class="bi bi-camera-video text-primary me-1"></i>Upload Video</label>
                {{-- Live Preview --}}
                <div id="videoPreviewWrap" class="d-none mb-3">
                  <div style="position:relative;border-radius:10px;overflow:hidden;background:#071530;">
                    <video id="videoPreviewEl" controls style="width:100%;max-height:200px;display:block;"></video>
                    <button type="button" id="clearVideoBtn"
                      style="position:absolute;top:8px;right:8px;background:rgba(0,0,0,0.6);border:none;border-radius:50%;width:28px;height:28px;color:#fff;font-size:14px;cursor:pointer;">
                      ✕
                    </button>
                  </div>
                  <small class="text-muted mt-1 d-block" id="videoFileName"></small>
                </div>
                <input type="file" name="video_file" id="videoFileInput" class="form-control" accept="video/mp4,video/mov,video/avi">
              </div>

              {{-- PDF --}}
              <div class="lesson-input d-none mb-4 p-3 bg-light rounded-12 border" id="pdfInput">
                <label class="form-label fw-semibold mb-2"><i class="bi bi-file-earmark-pdf text-danger me-1"></i>Upload PDF</label>
                <div id="pdfPreviewWrap" class="d-none mb-2">
                  <div class="d-flex align-items-center gap-2 p-2 rounded" style="background:#fff0f0;border:1px dashed #e74c3c;">
                    <i class="bi bi-file-earmark-pdf-fill text-danger fs-3"></i>
                    <small class="text-dark fw-semibold" id="pdfFileName"></small>
                  </div>
                </div>
                <input type="file" name="pdf_file" id="pdfFileInput" class="form-control" accept="application/pdf">
              </div>

              {{-- IMAGE --}}
              <div class="lesson-input d-none mb-4 p-3 bg-light rounded-12 border" id="imageInput">
                <label class="form-label fw-semibold mb-2"><i class="bi bi-image text-success me-1"></i>Upload Image</label>
                {{-- Live Preview --}}
                <div id="imagePreviewWrap" class="d-none mb-3">
                  <div style="position:relative;display:inline-block;width:100%;">
                    <img id="imagePreviewEl" src="" alt="Preview"
                      style="width:100%;max-height:200px;object-fit:cover;border-radius:10px;border:1px solid #e0e0e0;">
                    <button type="button" id="clearImageBtn"
                      style="position:absolute;top:8px;right:8px;background:rgba(0,0,0,0.6);border:none;border-radius:50%;width:28px;height:28px;color:#fff;font-size:14px;cursor:pointer;">
                      ✕
                    </button>
                  </div>
                  <small class="text-muted mt-1 d-block" id="imageFileName"></small>
                </div>
                <input type="file" name="image_file" id="imageFileInput" class="form-control" accept="image/jpg,image/jpeg,image/png,image/webp">
              </div>

              {{-- AUDIO --}}
              <div class="lesson-input d-none mb-4 p-3 bg-light rounded-12 border" id="audioInput">
                <label class="form-label fw-semibold mb-2"><i class="bi bi-mic text-warning me-1"></i>Upload Audio</label>
                <div id="audioPreviewWrap" class="d-none mb-2">
                  <audio id="audioPreviewEl" controls style="width:100%;"></audio>
                  <small class="text-muted mt-1 d-block" id="audioFileName"></small>
                </div>
                <input type="file" name="audio_file" id="audioFileInput" class="form-control" accept="audio/mp3,audio/wav">
              </div>

              {{-- SUMMARY --}}
              <div class="lesson-input d-none mb-4 p-3 bg-light rounded-12 border" id="summaryInput">
                <label class="form-label fw-semibold mb-2"><i class="bi bi-file-text me-1"></i>Summary</label>
                <textarea name="summary" class="form-control" rows="4" placeholder="Enter summary here..."></textarea>
              </div>

            </div>

            {{-- Description --}}
            <div class="mb-3">
              <label class="text-muted fs-11 fw-bold tracking-wider mb-1 uppercase">DESCRIPTION</label>
              <h5 class="fw-bold mb-3 text-dark">RICH TEXT EDITOR</h5>
              <div class="editor-container">
                <textarea name="description" id="description" class="form-control"></textarea>
                <div class="d-flex justify-content-end mt-2">
                  <span class="fs-13 text-muted" id="wordCounter">Words: 0</span>
                </div>
              </div>
            </div>

          </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">
          
          {{-- Save Card --}}
          <div class="card p-4 mb-4 bg-white rounded-20 border border-white text-center">
            <button type="submit" class="btn btn-gradient-indigo w-100 mb-3 py-3 d-flex align-items-center justify-content-center gap-2 text-white">
              <i class="bi bi-floppy fs-16"></i>
              Save Lesson
            </button>
            <div class="d-flex align-items-center justify-content-center gap-2 text-success fs-13">
              <i class="bi bi-check-circle-fill"></i>
              <span>All changes are saved automatically</span>
            </div>
          </div>

          {{-- Tips Card --}}
          <div class="card p-4 bg-white rounded-20 border border-white">
            <div class="d-flex align-items-center gap-2 mb-4">
              <div class="tips-header-icon">
                <i class="bi bi-lightbulb-fill text-purple"></i>
              </div>
              <h5 class="fw-bold mb-0 text-dark">Tips for creating a great lesson</h5>
            </div>

            <div class="tips-list d-flex flex-column gap-3">
              <div class="tip-item d-flex gap-3">
                <div class="tip-icon bg-light-blue text-blue">
                  <i class="bi bi-type"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 fs-14 text-dark">Write a clear title</h6>
                  <p class="text-muted mb-0 fs-13">A good title helps students understand what they will learn.</p>
                </div>
              </div>

              <div class="tip-item d-flex gap-3">
                <div class="tip-icon bg-light-green text-green">
                  <i class="bi bi-layers"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 fs-14 text-dark">Choose the right type</h6>
                  <p class="text-muted mb-0 fs-13">Select the correct lesson type for better organization.</p>
                </div>
              </div>

              <div class="tip-item d-flex gap-3">
                <div class="tip-icon bg-light-yellow text-yellow">
                  <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 fs-14 text-dark">Add detailed content</h6>
                  <p class="text-muted mb-0 fs-13">Use rich text editor to add details, images, and media.</p>
                </div>
              </div>

              <div class="tip-item d-flex gap-3">
                <div class="tip-icon bg-light-pink text-pink">
                  <i class="bi bi-star"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 fs-14 text-dark">Stay organized</h6>
                  <p class="text-muted mb-0 fs-13">Use sections to keep your course structure clear.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </form>
  </div>

  {{-- ADD SECTION MODAL --}}
  <div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-16 border-0 shadow-lg">

        <div class="modal-header border-bottom-0 pb-0">
          <h5 class="fw-bold mt-2">Add Section</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body py-4">
          <label class="form-label text-muted fs-11 tracking-wider mb-2">SECTION TITLE</label>
          <input type="text" id="sectionTitle" class="form-control" placeholder="Enter section title..." style="height: 48px !important; border-radius: 10px !important;">
          <div class="text-danger small d-none mt-2" id="sectionError"></div>
        </div>

        <div class="modal-footer border-top-0 pt-0 gap-2">
          <button class="btn btn-light rounded-12 px-4" data-bs-dismiss="modal" style="height: 44px !important;">Cancel</button>
          <button class="btn btn-gradient-indigo px-4" id="saveSectionBtn" style="height: 44px !important; color: white !important;">Save Section</button>
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

      // Character counter for title
      const titleInput = $('#lessonTitleInput');
      const charCounter = $('#titleCharCounter');
      titleInput.on('input', function() {
        charCounter.text(`${this.value.length} / 150`);
      });

      // Classic Editor with Word count
      ClassicEditor.create(document.querySelector('#description'))
        .then(editor => {
          const updateWordCount = () => {
            const data = editor.getData();
            const text = data.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
            const words = text ? text.split(/\s+/).length : 0;
            $('#wordCounter').text(`Words: ${words}`);
          };
          editor.model.document.on('change:data', updateWordCount);
          updateWordCount();
        })
        .catch(error => {
          console.error(error);
        });

      // lesson type toggle
      $('#lessonType').on('change', function() {
        const selected = this.value;
        $('.lesson-input').slideUp(200);
        
        if (selected === 'video') $('#videoInput').slideDown(200);
        if (selected === 'pdf') $('#pdfInput').slideDown(200);
        if (selected === 'image') $('#imageInput').slideDown(200);
        if (selected === 'audio') $('#audioInput').slideDown(200);
        if (selected === 'summary') $('#summaryInput').slideDown(200);
      });

      // ---- IMAGE PREVIEW ----
      $('#imageFileInput').on('change', function() {
        const file = this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        $('#imagePreviewEl').attr('src', url);
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
        const url = URL.createObjectURL(file);
        const v = document.getElementById('videoPreviewEl');
        v.src = url;
        v.load();
        $('#videoFileName').text(file.name + ' (' + (file.size / 1024 / 1024).toFixed(1) + ' MB)');
        $('#videoPreviewWrap').removeClass('d-none');
      });
      $('#clearVideoBtn').on('click', function() {
        $('#videoFileInput').val('');
        const v = document.getElementById('videoPreviewEl');
        v.src = '';
        $('#videoFileName').text('');
        $('#videoPreviewWrap').addClass('d-none');
      });

      // ---- AUDIO PREVIEW ----
      $('#audioFileInput').on('change', function() {
        const file = this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        const a = document.getElementById('audioPreviewEl');
        a.src = url;
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

      // AJAX Save Section
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
          url: "{{ route('teacher.sections.store') }}",
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
              // Option to show success
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
