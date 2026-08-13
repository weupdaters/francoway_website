@extends('admin.layouts.app')

@section('content')
  <div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
      <h3 class="mb-0">Create Course</h3>

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
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14 hover">Courses</span>
            </a>
          </li>
          <li class="breadcrumb-item active">
            <span class="text-secondary">Create Course</span>
          </li>
        </ol>
      </nav>
    </div>

    {{-- MAIN FORM --}}
    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">
          <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <h3 class="mb-20">Add a Course</h3>

            {{-- Course Title --}}
            <div class="mb-20">
              <label class="label fs-16 mb-2">Course Title</label>
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput1" name="title" value="{{ old('title') }}"
                  placeholder="Course Title">
                <label for="floatingInput1">Course Title</label>
              </div>
            </div>



            {{-- Description --}}
            <div class="form-group mb-20">
              <label class="label fs-16">Course Description</label>
              <textarea name="description" class="form-control" style="height:163px;">{{ old('description') }}</textarea>
            </div>

            {{-- Price --}}
            <div class="mb-20">
              <label class="label fs-16 mb-2">Course Price</label>
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput3" name="price" value="{{ old('price') }}"
                  placeholder="Enter rate">
                <label for="floatingInput3">Enter rate</label>
              </div>
            </div>

            {{-- Thumbnail --}}
            <div class="form-group mb-4 only-file-upload" id="file-upload">
              <label class="label fs-16 text-secondary">Course Avatar</label>
              <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                <div class="product-upload">
                  <label class="file-upload mb-0">
                    <i class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                    <span class="d-block text-body fs-14">
                      Drag and drop an image or
                      <span class="text-primary text-decoration-underline">Browse</span>
                    </span>
                  </label>
                  <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                    <input class="form__file bottom-0" type="file" name="thumbnail"
                      accept="image/jpeg, image/png, image/gif">
                  </label>
                </div>
              </div>
            </div>

            {{-- Cover Image --}}
            <div class="form-group mb-4 only-file-upload">
              <label class="label fs-16 text-secondary">Course Cover Image</label>
              <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                <div class="product-upload">
                  <label class="file-upload mb-0">
                    <i class="ri-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                    <span class="d-block text-body fs-14">
                      Drag and drop cover image or
                      <span class="text-primary text-decoration-underline">Browse</span>
                    </span>
                  </label>
                  <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                    <input class="form__file bottom-0" type="file" name="cover_image"
                      accept="image/jpeg, image/png, image/gif">
                  </label>
                </div>
              </div>
            </div>



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
                      <textarea name="prompts[reading]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Reading...">{{ old('prompts.reading') }}</textarea>
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
                      <textarea name="prompts[listening]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Listening...">{{ old('prompts.listening') }}</textarea>
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
                      <textarea name="prompts[speaking]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Speaking...">{{ old('prompts.speaking') }}</textarea>
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
                      <textarea name="prompts[writing]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Writing...">{{ old('prompts.writing') }}</textarea>
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
              <label class="label fs-16 mb-2">Status</label>
              <select class="form-select" name="status">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
              </select>
            </div>

            {{-- Language --}}
            <div class="mb-20">
              <label class="label fs-16 mb-2">Language</label>
              <select class="form-select" name="lang">
                <option value="en" {{ old('lang', app()->getLocale()) === 'en' ? 'selected' : '' }}>English</option>
                <option value="fr" {{ old('lang', app()->getLocale()) === 'fr' ? 'selected' : '' }}>French</option>
              </select>
            </div>
            {{-- Trial Video --}}
            <div class="mb-20">
              <label class="label fs-16 mb-2">Trial Video (Preview)</label>
              <div class="form-control h-100 text-center position-relative p-4">
                <div class="product-upload">
                  <label class="file-upload mb-0">
                    <i class="ri-video-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                    <span class="d-block text-body fs-14">
                      Upload trial video
                      <span class="text-primary text-decoration-underline">Browse</span>
                    </span>
                  </label>
                  <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                    <input class="form__file bottom-0" type="file" name="trial_video" accept="video/*">
                  </label>
                </div>
              </div>
            </div>


            {{-- Buttons --}}
            <div class="d-flex justify-content-between gap-2">
              <button type="submit" class="btn btn-primary fw-normal text-white">
                Save Course
              </button>

              <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-border-color text-secondary fw-normal">
                Cancel
              </a>
            </div>

          </div>
        </div>

      </div>
    </form>

  </div>
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



