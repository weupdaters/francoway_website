@extends('teachers.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Courses List</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span>LMS</span>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Courses</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Top Bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3>My Courses</h3>
        </div>

        {{-- Table --}}
        <div class="default-table-area mx-minus-1 table-courses">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>#{{ $course->id }}</td>

                            <td class="fw-medium">
                                {{ $course->title }}
                            </td>

                            

                            <td>
                                @if($course->status)
                                    <span class="text-success bg-success bg-opacity-10 default-badge">
                                        Active
                                    </span>
                                @else
                                    <span class="text-danger bg-danger bg-opacity-10 default-badge">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex justify-content-end gap-3">

                                    {{-- Manage Lessons --}}
                                    <a href="{{ route('teacher.course-lessons', $course->id) }}"
                                       data-bs-toggle="tooltip"
                                       data-bs-title="Manage Lessons">
                                        <i class="material-symbols-outlined fs-18 text-primary">
                                            menu_book
                                        </i>
                                    </a>

                                    {{-- Add Lesson --}}
                                    <a href="{{ route('teacher.lessons.create', $course->id) }}"
                                       data-bs-toggle="tooltip"
                                       data-bs-title="Add Lesson">
                                        <i class="material-symbols-outlined fs-18 text-success">
                                            playlist_add
                                        </i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No courses assigned to you
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-20">
                @if($courses->count())
                    <span class="fs-15">
                        Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }}
                        of {{ $courses->total() }} entries
                    </span>
                @endif

                {{ $courses->links() }}
            </div>

        </div>
    </div>
</div>

@endsection
