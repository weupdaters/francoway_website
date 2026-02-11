@extends('users.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Edit Lesson</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>

                <li class="breadcrumb-item"><span>Lessons</span></li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Edit Lesson</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- MAIN FORM --}}
    <form action="{{ route('admin.lessons.store', $lesson->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Update Lesson</h3>

                    {{-- Course --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Select Course</label>
                        <select class="form-select" name="course_id">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lesson Title --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Lesson Title</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   name="title"
                                   value="{{ old('title', $lesson->title) }}"
                                   placeholder="Lesson Title">
                            <label>Lesson Title</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-20">
                        <label class="label fs-16">Lesson Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  style="height:163px;">{{ old('description', $lesson->description) }}</textarea>
                    </div>

                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Lesson Media</h3>

                    {{-- Video URL --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Lesson Video URL</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   name="video_url"
                                   value="{{ old('video_url', $lesson->video_url) }}"
                                   placeholder="Video URL">
                            <label>Video URL</label>
                        </div>
                    </div>

                    {{-- Upload Video --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Upload Lesson Video</label>
                        <input type="file" class="form-control" name="video_file">
                    </div>

                    @if($lesson->video_url)
                        <small class="text-secondary d-block mb-2">
                            Current Video: {{ $lesson->video_url }}
                        </small>
                    @endif

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit"
                                class="btn btn-primary fw-normal text-white">
                            Update Lesson
                        </button>

                        <a href="{{ route('admin.lessons.index') }}"
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
