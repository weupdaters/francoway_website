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
                    <div class="text-secondary" style="line-height:1.7; font-size:14.5px;">
                        {!! $lesson->description ? $lesson->description : '<em>No description available</em>' !!}
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
                    <div style="width:100%; border-radius:12px; overflow:hidden;">
                        <video
                            style="width:100%; height:240px; display:block; object-fit:contain; background:#000; border-radius:12px;"
                            controls>
                            <source src="{{ asset('storage/'.$lesson->video_file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                {{-- AUDIO --}}
                @elseif($lesson->audio_file)
                    <audio controls class="w-100 mb-3" style="border-radius:12px;">
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
                    <div style="width:100%; text-align:center;">
                        <img src="{{ asset('storage/'.$lesson->image_file) }}"
                             style="max-width:100%; max-height:280px; width:auto; height:auto; object-fit:contain; border-radius:12px; display:block; margin:0 auto;"
                             alt="Lesson Image">
                    </div>

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
