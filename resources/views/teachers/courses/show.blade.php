@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Course Details</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
            
                <li class="breadcrumb-item"><span>Courses</span></li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">View Course</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">
            <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                <h3 class="mb-20">{{ $course->title }}</h3>

                {{-- Description --}}
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Description</label>
                    <div class="text-body fs-16">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </div>

                {{-- Price --}}
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Price</label>
                    <p class="fs-16 fw-medium text-secondary">
                        ₹ {{ $course->price }}
                    </p>
                </div>

                {{-- Thumbnail --}}
                @if($course->thumbnail)
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Thumbnail</label>
                        <div>
                            <img src="{{ asset('storage/'.$course->thumbnail) }}"
                                 class="rounded-3"
                                 style="max-width: 250px;"
                                 onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 800 500\'><defs><linearGradient id=\'bg\' x1=\'0%\' y1=\'0%\' x2=\'100%\' y2=\'100%\'><stop offset=\'0%\' style=\'stop-color:%23071530;stop-opacity:1\'/><stop offset=\'100%\' style=\'stop-color:%23101F42;stop-opacity:1\'/></linearGradient></defs><rect width=\'100%\' height=\'100%\' fill=\'url(%23bg)\'/><g transform=\'translate(400, 220)\' text-anchor=\'middle\'><text x=\'0\' y=\'20\' fill=\'%23ffffff\' font-family=\'Outfit, sans-serif\' font-size=\'24\' font-weight=\'800\'>NO IMAGE</text></g></svg>';">
                        </div>
                    </div>
                @endif

                {{-- Cover Image --}}
                @if($course->cover_image)
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Cover Image</label>
                        <div>
                            <img src="{{ asset('storage/'.$course->cover_image) }}"
                                 class="rounded-3"
                                 style="max-width: 100%;"
                                 onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 800 500\'><defs><linearGradient id=\'bg\' x1=\'0%\' y1=\'0%\' x2=\'100%\' y2=\'100%\'><stop offset=\'0%\' style=\'stop-color:%23071530;stop-opacity:1\'/><stop offset=\'100%\' style=\'stop-color:%23101F42;stop-opacity:1\'/></linearGradient></defs><rect width=\'100%\' height=\'100%\' fill=\'url(%23bg)\'/><g transform=\'translate(400, 220)\' text-anchor=\'middle\'><text x=\'0\' y=\'20\' fill=\'%23ffffff\' font-family=\'Outfit, sans-serif\' font-size=\'24\' font-weight=\'800\'>NO IMAGE</text></g></svg>';">
                        </div>
                    </div>
                @endif

                {{-- Custom AI Prompt --}}
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Custom AI Prompt</label>
                    <div class="border rounded p-3 bg-light">
                        <p class="mb-2"><strong>Use Custom Prompt:</strong> {{ $course->has_custom_prompt ? 'Yes' : 'No' }}</p>
                        @if($course->has_custom_prompt && $course->custom_prompt)
                            <p class="mb-1"><strong>Prompt Content:</strong></p>
                            <div class="bg-white p-3 border rounded text-dark fs-14" style="white-space: pre-wrap; font-family: monospace;">{{ $course->custom_prompt }}</div>
                        @else
                            <p class="text-muted fs-14 mb-0">No custom prompt configured.</p>
                        @endif
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
                    @if($course->status == 1)
                        <span class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                            Active
                        </span>
                    @else
                        <span class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                            Inactive
                        </span>
                    @endif
                </div>

                {{-- Trial Video --}}
                @if($course->trial_video)
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Trial Video</label>
                        <video controls style="width:100%; border-radius:10px;">
                            <source src="{{ asset('storage/'.$course->trial_video) }}" type="video/mp4">
                        </video>
                    </div>
                @endif

                {{-- Buttons --}}
                <div class="d-flex justify-content-between gap-2">
                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                       class="btn btn-primary fw-normal text-white">
                        Edit Course
                    </a>

                    <a href="{{ route('admin.courses.index') }}"
                       class="btn btn-outline-border-color text-secondary fw-normal">
                        Back
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection
