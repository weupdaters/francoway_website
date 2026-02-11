@extends('users.layouts.app')

@section('title', 'Lessons List')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Lessons</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('users.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span>LMS</span>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Lessons</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Main Card --}}
    <div class="card bg-white rounded-10 border-0 mb-4">

        {{-- Top Bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20 border-bottom">
            <h4 class="mb-0">{{ $course->title }} – Lessons</h4>

            <div class="d-flex gap-3">
                <a href="{{ route('users.courses.index') }}"
                   class="btn btn-outline-secondary">
                    ← Back to Courses
                </a>
            </div>
        </div>

        {{-- Lessons Cards --}}
        <div class="row g-4 p-20">

            @forelse($lessons as $lesson)
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-12 d-flex flex-column">

                        {{-- Card Body --}}
                        <div class="card-body text-center flex-grow-1">

                            {{-- Icon --}}
                            <div class="mb-3">
                                <div class="rounded-circle bg-primary-subtle
                                            d-inline-flex align-items-center justify-content-center"
                                     style="width:70px;height:70px;">
                                    <i class="ri-video-line fs-30 text-primary"></i>
                                </div>
                            </div>

                            {{-- Lesson Title --}}
                            <h5 class="fw-semibold mb-2">
                                {{ $lesson->title }}
                            </h5>

                            {{-- Video Status --}}
                            @if($lesson->video_url || $lesson->video_file)
                                <span class="badge bg-success-subtle text-success">
                                    Video Available
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">
                                    No Video
                                </span>
                            @endif

                        </div>

                        {{-- Action --}}
                        <div class="border-top py-3 text-center">
                            <a href="{{ route('users.lessons.show', [$course->id, $lesson->id]) }}"
                               class="btn btn-sm btn-primary">
                                View Lesson
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted mb-0">No lessons found for this course.</p>
                </div>
            @endforelse

        </div>

    </div>
</div>

@endsection
