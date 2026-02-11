@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Courses List</h3>

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
                    <span>LMS</span>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Courses List</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Top Bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3>Courses</h3>

            <ul class="nav nav-tabs border-0 gap-2 tabs-default-active">

                <li>
                    <a href="{{ route('admin.courses.create') }}"
                       class="btn btn-primary fs-16 text-white text-decoration-none">
                        + Create Course
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request('type')==null ? 'active' : '' }}"
                       href="{{ route('admin.courses.index') }}">
                        All Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type')=='paid' ? 'active' : '' }}"
                       href="{{ route('admin.courses.index',['type'=>'paid']) }}">
                        Paid
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type')=='free' ? 'active' : '' }}"
                       href="{{ route('admin.courses.index',['type'=>'free']) }}">
                        Free
                    </a>
                </li>
            </ul>
        </div>

        {{-- Table --}}
        <div class="default-table-area mx-minus-1 table-courses">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>#{{ $course->id }}</td>

                            <td>
                                <a href="{{ route('admin.courses.show',$course->id) }}"
                                   class="text-decoration-none fs-16 fw-medium text-secondary hover-text">
                                    {{ $course->title }}
                                </a>
                            </td>

                            <td>
                                {{ $course->price > 0 ? '$'.$course->price : 'Free' }}
                            </td>

                            <td>
                                @if($course->status)
                                    <span class="text-success bg-success bg-opacity-10 default-badge">
                                        Published
                                    </span>
                                @else
                                    <span class="text-danger bg-danger bg-opacity-10 default-badge">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex justify-content-end gap-3">

                                    {{-- Add Lesson --}}
                                    <a href="{{ route('admin.lessons.index', $course->id) }}"
                                       data-bs-toggle="tooltip"
                                       data-bs-title="Add Lesson">
                                        <i class="material-symbols-outlined fs-18 text-success">
                                            playlist_add
                                        </i>
                                    </a>

                                    {{-- View --}}
                                    <a href="{{ route('admin.courses.show',$course->id) }}"
                                       data-bs-toggle="tooltip"
                                       data-bs-title="View">
                                        <i class="material-symbols-outlined fs-18 text-primary">
                                            visibility
                                        </i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.courses.edit',$course->id) }}"
                                       data-bs-toggle="tooltip"
                                       data-bs-title="Edit">
                                        <i class="material-symbols-outlined fs-18 text-warning">
                                            edit
                                        </i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.courses.destroy',$course->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-transparent border-0 p-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Delete"
                                                onclick="return confirm('Delete this course?')">
                                            <i class="material-symbols-outlined fs-18 text-danger">
                                                delete
                                            </i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                No courses found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-20">
                <span class="fs-15">
                    Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }}
                    of {{ $courses->total() }} entries
                </span>

                {{ $courses->links() }}
            </div>

        </div>
    </div>
</div>

@endsection
