@extends('admin.layouts.app')

@section('title', 'Lesson Details')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Lesson Details</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.lessons.index', $lesson->course_id) }}"
                       class="d-flex align-items-center text-decoration-none">
                        <span class="text-body fs-14 hover">Lessons</span>
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    <span class="text-secondary fs-14">Lesson Details</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">
            <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                <h3 class="mb-20 fw-bolder">Lesson Information</h3>

                <div class="mb-20">
                    <label class="label fs-16 mb-2 fw-bold">Lesson Title</label>
                    <p class="text-secondary mb-0">{{ $lesson->title }}</p>
                </div>

                <div class="mb-20">
                    <label class="label fs-16 mb-2 fw-bold">Course</label>
                    <p class="text-secondary mb-0">
                        {{ optional($lesson->course)->title ?? 'N/A' }}
                    </p>
                </div>

                <div class="mb-20">
                    <label class="label fs-16 mb-2 fw-bold">Section</label>
                    <p class="text-secondary mb-0">
                        {{ optional($lesson->section)->title ?? 'N/A' }}
                    </p>
                </div>

                <div class="mb-20">
                    <label class="label fs-16 mb-2 fw-bold">Description</label>
                    <div class="text-secondary">
                        {!! $lesson->description ?: '<em>No description available</em>' !!}
                    </div>
                </div>

            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">
            <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                <h3 class="mb-20">Lesson Media</h3>

                {{-- VIDEO --}}
                @if($lesson->video_file)
                    <video controls width="100%" class="mb-3 rounded">
                        <source src="{{ asset('storage/'.$lesson->video_file) }}" type="video/mp4">
                    </video>

                {{-- AUDIO --}}
                @elseif($lesson->audio_file)
                    <audio controls class="w-100 mb-3">
                        <source src="{{ asset('storage/'.$lesson->audio_file) }}" type="audio/mpeg">
                    </audio>

                {{-- PDF --}}
                @elseif($lesson->pdf_file)
                    <a href="{{ asset('storage/'.$lesson->pdf_file)  }}"
                       target="_blank"
                       class="btn btn-outline-primary w-100 mb-3">
                        View PDF
                    </a>

                {{-- IMAGE --}}
                @elseif($lesson->image_file)
                    <img src="{{ asset('storage/'.$lesson->image_file) }}"
                         class="img-fluid rounded mb-3">

                @else
                    <p class="text-muted">No media available</p>
                @endif

                {{-- Buttons --}}
                <div class="d-flex justify-content-between gap-2 mt-4">
                    <a href="{{ route('admin.lessons.edit', [$lesson->course_id, $lesson->id]) }}"
                       class="btn btn-primary fw-normal text-white w-50">
                        Edit
                    </a>

                    <a href="{{ route('admin.lessons.index', $lesson->course_id) }}"
                       class="btn btn-outline-border-color text-secondary fw-normal w-50">
                        Back
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection
