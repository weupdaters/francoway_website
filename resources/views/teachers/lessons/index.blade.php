@extends('teachers.layouts.app')

@section('title', 'Lessons List')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">
            Lessons – {{ $course->title }}
        </h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span>Courses</span>
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
            <h4 class="mb-0">Lessons List</h4>

            <div class="d-flex gap-3">
                <a href="{{ route('teacher.lessons.create', $course->id) }}"
                   class="btn btn-primary">
                    + Create Lesson
                </a>

                <a href="{{ route('teacher.courses.index') }}"
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
                            <h5 class="fw-semibold mb-1">
                                {{ $lesson->title }}
                            </h5>

                            {{-- Section --}}
                            <p class="text-muted fs-14 mb-1">
                                Section: {{ $lesson->section->title ?? 'No Section' }}
                            </p>

                            {{-- Type --}}
                            <span class="badge bg-info-subtle text-info">
                                {{ ucfirst($lesson->lesson_type ?? 'Lesson') }}
                            </span>

                        </div>

                        {{-- Action Icons Bottom --}}
                        <div class="border-top py-3">
                            <div class="d-flex justify-content-center gap-4">

                                {{-- Edit --}}
                                <a href="{{ route('teacher.lessons.edit', [$course->id, $lesson->id]) }}"
                                   data-bs-toggle="tooltip"
                                   title="Edit">
                                    <i class="material-symbols-outlined fs-22 text-success">
                                        edit
                                    </i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('teacher.lessons.destroy', [$course->id, $lesson->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-transparent border-0 p-0"
                                            data-bs-toggle="tooltip"
                                            title="Delete"
                                            onclick="return confirm('Delete this lesson?')">
                                        <i class="material-symbols-outlined fs-22 text-danger">
                                            delete
                                        </i>
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted mb-0">No lessons found for this course</p>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center p-20 border-top">
            @if($lessons->count())
                <span class="fs-14 text-muted">
                    Showing {{ $lessons->firstItem() }} to {{ $lessons->lastItem() }}
                    of {{ $lessons->total() }} entries
                </span>
            @endif

            {{ $lessons->links() }}
        </div>

    </div>
</div>

@endsection
