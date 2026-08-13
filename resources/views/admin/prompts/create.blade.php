@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Create Prompt</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.prompts.index') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-terminal-box-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Prompts</span>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Create Prompt</span>
                </li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.prompts.store') }}" method="POST">
        @csrf

        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    {{-- Course --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Assign to Course (Optional)</label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                            <option value="">Global Prompt (All Courses)</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Title --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Prompt Title</label>
                        <div class="form-floating">
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="e.g. IELTS Reading prompt template"
                                   value="{{ old('title') }}"
                                   required>
                            <label>Prompt Title</label>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Skill --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Skill / Module</label>
                        <select name="skill" class="form-select @error('skill') is-invalid @enderror" required>
                            <option value="">Select Skill</option>
                            <option value="reading" {{ old('skill') === 'reading' ? 'selected' : '' }}>Reading</option>
                            <option value="listening" {{ old('skill') === 'listening' ? 'selected' : '' }}>Listening</option>
                            <option value="speaking" {{ old('skill') === 'speaking' ? 'selected' : '' }}>Speaking</option>
                            <option value="writing" {{ old('skill') === 'writing' ? 'selected' : '' }}>Writing</option>
                        </select>
                        @error('skill')
                            <div class="invalid-feedback text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Prompt Text --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Prompt Text (Instructions for AI)</label>
                        <textarea name="prompt_text"
                                  class="form-control @error('prompt_text') is-invalid @enderror"
                                  style="height: 250px;"
                                  placeholder="Enter complete instructions for ChatGPT / Gemini here..."
                                  required>{{ old('prompt_text') }}</textarea>
                        @error('prompt_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Settings</h3>

                    {{-- Status --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-primary fw-normal text-white">
                            Save Prompt
                        </button>
                        <a href="{{ route('admin.prompts.index') }}"
                           class="btn btn-outline-border-color text-secondary fw-normal">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
