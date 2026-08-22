@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Edit Course</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.courses.index') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-book-open-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Courses</span>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Edit Course</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Validation Error Alert --}}
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show rounded-10 border-0 mb-4 shadow-sm" role="alert">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="ri-error-warning-fill fs-20"></i>
          <strong>Please fix the errors below:</strong>
        </div>
        <ul class="mb-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- MAIN FORM --}}
    <form action="{{ route('admin.courses.update', $course->slug ?? $course->id) }}"
          method="POST"
          enctype="multipart/form-data"
          id="courseEditForm">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Update Course</h3>

                    {{-- Title --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Title <span class="text-danger">*</span></label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   value="{{ old('title', $course->title) }}"
                                   placeholder="Course Title" required>
                            <label>Course Title</label>
                        </div>
                        @error('title')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-20">
                        <label class="label fs-16 mb-2">Course Description <span class="text-danger">*</span></label>
                        <textarea name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  style="height:163px;" required>{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Price ($ / CAD / USD) <span class="text-danger">*</span></label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control @error('price') is-invalid @enderror"
                                   name="price"
                                   value="{{ old('price', $course->price) }}"
                                   placeholder="e.g. 200 (Enter 0 for free course)" required>
                            <label>e.g. 200 (Enter 0 for free course)</label>
                        </div>
                        <small class="text-muted fs-12 d-block mt-1">Enter numeric value, e.g. 200 or 0 for Free course.</small>
                        @error('price')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label fs-16 text-secondary mb-2">Course Avatar / Thumbnail</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" accept="image/*">
                        @if($course->thumbnail)
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="rounded-2" style="width: 50px; height: 50px; object-fit: cover;">
                                <small class="text-secondary">Current file: {{ basename($course->thumbnail) }}</small>
                            </div>
                        @endif
                        @error('thumbnail')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Cover Image --}}
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label fs-16 text-secondary mb-2">Course Cover Image</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" accept="image/*">
                        @if($course->cover_image)
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <img src="{{ asset('storage/' . $course->cover_image) }}" alt="Cover Image" class="rounded-2" style="width: 80px; height: 45px; object-fit: cover;">
                                <small class="text-secondary">Current file: {{ basename($course->cover_image) }}</small>
                            </div>
                        @endif
                        @error('cover_image')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    @php
                        $prompts = [];
                        if ($course->custom_prompt) {
                            $prompts = json_decode($course->custom_prompt, true);
                            if (json_last_error() !== JSON_ERROR_NONE || !is_array($prompts)) {
                                $prompts = [
                                    'reading' => $course->custom_prompt,
                                    'listening' => '',
                                    'speaking' => '',
                                    'writing' => '',
                                ];
                            }
                        }
                        $readingPrompt = $prompts['reading'] ?? '';
                        $listeningPrompt = $prompts['listening'] ?? '';
                        $speakingPrompt = $prompts['speaking'] ?? '';
                        $writingPrompt = $prompts['writing'] ?? '';
                    @endphp

                    {{-- Custom AI Prompts --}}
                    <div class="mb-4">
                        <label class="label fs-16 mb-2">Custom AI Prompts</label>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="list-group rounded-3 shadow-sm border-0" id="promptModuleList" role="tablist">
                                    <button type="button" class="list-group-item list-group-item-action active border-0 py-3 d-flex align-items-center gap-2" id="reading-list" data-bs-toggle="list" href="#prompt-reading" role="tab" aria-controls="prompt-reading">
                                        <i class="ri-book-open-line fs-18"></i> <span>Reading</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center gap-2" id="listening-list" data-bs-toggle="list" href="#prompt-listening" role="tab" aria-controls="prompt-listening">
                                        <i class="ri-customer-service-line fs-18"></i> <span>Listening</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center gap-2" id="speaking-list" data-bs-toggle="list" href="#prompt-speaking" role="tab" aria-controls="prompt-speaking">
                                        <i class="ri-mic-line fs-18"></i> <span>Speaking</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center gap-2" id="writing-list" data-bs-toggle="list" href="#prompt-writing" role="tab" aria-controls="prompt-writing">
                                        <i class="ri-edit-2-line fs-18"></i> <span>Writing</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                   <div class="tab-content" id="promptTabContent">
                                    <div class="tab-pane fade show active p-3 bg-light rounded-3 border-0" id="prompt-reading" role="tabpanel" aria-labelledby="reading-list">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="label fs-13 text-muted uppercase mb-0">Reading Custom Prompt</label>
                                            <select class="form-select form-select-sm w-auto predefined-prompt-select" data-target="prompts[reading]">
                                                <option value="">Load Predefined Prompt...</option>
                                                @foreach($predefinedPrompts->where('skill', 'reading') as $p)
                                                    <option value="{{ $p->prompt_text }}">{{ $p->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <textarea name="prompts[reading]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Reading...">{{ old('prompts.reading', $readingPrompt) }}</textarea>
                                    </div>
                                    <div class="tab-pane fade p-3 bg-light rounded-3 border-0" id="prompt-listening" role="tabpanel" aria-labelledby="listening-list">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="label fs-13 text-muted uppercase mb-0">Listening Custom Prompt</label>
                                            <select class="form-select form-select-sm w-auto predefined-prompt-select" data-target="prompts[listening]">
                                                <option value="">Load Predefined Prompt...</option>
                                                @foreach($predefinedPrompts->where('skill', 'listening') as $p)
                                                    <option value="{{ $p->prompt_text }}">{{ $p->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <textarea name="prompts[listening]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Listening...">{{ old('prompts.listening', $listeningPrompt) }}</textarea>
                                    </div>
                                    <div class="tab-pane fade p-3 bg-light rounded-3 border-0" id="prompt-speaking" role="tabpanel" aria-labelledby="speaking-list">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="label fs-13 text-muted uppercase mb-0">Speaking Custom Prompt</label>
                                            <select class="form-select form-select-sm w-auto predefined-prompt-select" data-target="prompts[speaking]">
                                                <option value="">Load Predefined Prompt...</option>
                                                @foreach($predefinedPrompts->where('skill', 'speaking') as $p)
                                                    <option value="{{ $p->prompt_text }}">{{ $p->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <textarea name="prompts[speaking]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Speaking...">{{ old('prompts.speaking', $speakingPrompt) }}</textarea>
                                    </div>
                                    <div class="tab-pane fade p-3 bg-light rounded-3 border-0" id="prompt-writing" role="tabpanel" aria-labelledby="writing-list">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="label fs-13 text-muted uppercase mb-0">Writing Custom Prompt</label>
                                            <select class="form-select form-select-sm w-auto predefined-prompt-select" data-target="prompts[writing]">
                                                <option value="">Load Predefined Prompt...</option>
                                                @foreach($predefinedPrompts->where('skill', 'writing') as $p)
                                                    <option value="{{ $p->prompt_text }}">{{ $p->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <textarea name="prompts[writing]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Writing...">{{ old('prompts.writing', $writingPrompt) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Course Overview</h3>

                    {{-- Status --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status">
                            <option value="1" {{ old('status', $course->status ? '1' : '0') == '1' || old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="0" {{ old('status', $course->status ? '1' : '0') == '0' || old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Language --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Language</label>
                        <select class="form-select" name="lang">
                            <option value="en" {{ old('lang', $course->lang) === 'en' ? 'selected' : '' }}>English</option>
                            <option value="fr" {{ old('lang', $course->lang) === 'fr' ? 'selected' : '' }}>French</option>
                        </select>
                    </div>

                    {{-- Trial Video --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Trial Video</label>
                        <input type="file" class="form-control @error('trial_video') is-invalid @enderror" name="trial_video" accept="video/*">
                        @if($course->trial_video)
                            <small class="text-secondary d-block mt-1">
                                <i class="ri-video-line me-1"></i> Current video: {{ basename($course->trial_video) }}
                            </small>
                        @endif
                        @error('trial_video')
                            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2 mt-4">
                        <button type="submit"
                                class="btn btn-primary fw-normal text-white px-4"
                                id="updateCourseBtn">
                            <i class="ri-check-line me-1"></i> Update Course
                        </button>

                        <a href="{{ route('admin.courses.index') }}"
                           class="btn btn-outline-border-color text-secondary fw-normal">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </form>

</div>

@push('scripts')
<script>
  document.getElementById('courseEditForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('updateCourseBtn');
    if (btn) {
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Updating...';
      btn.classList.add('disabled');
    }
  });
</script>
@endpush

@endsection

@push('styles')
<style>
.list-group-item.active {
    background: #071530 !important;
    color: #ffffff !important;
    font-weight: 600;
}
.list-group-item:not(.active) {
    background-color: #f8fafc !important;
    color: #4a5568 !important;
}
.list-group-item:not(.active):hover {
    background-color: #eff3f9 !important;
    color: #071530 !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.predefined-prompt-select').forEach(select => {
        select.addEventListener('change', function() {
            const targetName = this.getAttribute('data-target');
            const textarea = document.querySelector(`textarea[name="${targetName}"]`);
            if (textarea && this.value) {
                if (confirm('Are you sure you want to load this predefined prompt? This will overwrite the current content in the textarea.')) {
                    textarea.value = this.value;
                } else {
                    this.value = '';
                }
            }
        });
    });
});
</script>
@endpush


