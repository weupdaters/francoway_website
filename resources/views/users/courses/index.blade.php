@extends('users.layouts.app')

@section('title', 'My Courses | ' . ($settings['site_name'] ?? 'Francoway'))

@push('styles')
<style>
    /* Premium white card container styling matching dashboard */
    .courses-list-card-container {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        border: 1px solid #EAEAEA;
    }
    
    /* Breadcrumb & Title styling */
    .page-title-text {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 24px;
        color: #071530;
    }
    .breadcrumb-item a {
        color: #5A6A85;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb-item a:hover {
        color: #E31B23;
    }
    .breadcrumb-item.active {
        color: #E31B23;
        font-weight: 700;
    }

    /* Tabs styling matching red accents */
    .mirror-tabs .nav-link {
        color: #5A6A85;
        font-weight: 700;
        font-size: 13.5px;
        border-radius: 10px !important;
        padding: 8px 18px;
        transition: all 0.25s;
        border: 1px solid transparent !important;
    }
    .mirror-tabs .nav-link:hover {
        color: #E31B23;
        background-color: rgba(227, 27, 35, 0.02);
    }
    .mirror-tabs .nav-link.active {
        background-color: #E31B23 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(227, 27, 35, 0.15);
    }

    /* Premium Table styling */
    .mirror-table {
        margin-bottom: 0;
    }
    .mirror-table thead th {
        background-color: #F8FAFC !important;
        color: #071530 !important;
        font-weight: 800;
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border-bottom: 1px solid #EAEAEA !important;
    }
    .mirror-table tbody td {
        padding: 18px 20px;
        color: #5A6A85;
        font-size: 14px;
        border-bottom: 1px solid #F1F5F9;
    }
    .mirror-table tbody tr {
        transition: background-color 0.2s;
    }
    .mirror-table tbody tr:hover {
        background-color: #F8FAFC;
    }
    .mirror-course-link {
        font-weight: 700;
        color: #071530;
        text-decoration: none;
        transition: color 0.2s;
    }
    .mirror-course-link:hover {
        color: #E31B23;
    }

    /* Status badge design */
    .status-badge-inline {
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 8px;
        display: inline-block;
    }

    /* Open Course Button */
    .btn-open-course-mirror {
        background-color: #0B1F4D;
        color: #ffffff;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.25s;
        border: none;
    }
    .btn-open-course-mirror:hover {
        background-color: #E31B23;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(227, 27, 35, 0.2);
    }

    /* Start Quiz Button matching website colors */
    .btn-start-quiz-mirror {
        background-color: transparent;
        border: 1.5px solid #E31B23 !important;
        color: #E31B23 !important;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-start-quiz-mirror:hover {
        background-color: #E31B23 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(227, 27, 35, 0.2);
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-2">

    {{-- ================= HEADER & BREADCRUMBS ================= --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="page-title-text mb-0">My Courses</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('users.dashboard') }}" class="d-flex align-items-center">
                        <i class="bi bi-house-door-fill me-1.5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">My Courses</li>
            </ol>
        </nav>
    </div>

    {{-- ================= CARD BOX CONTAINER ================= --}}
    <div class="courses-list-card-container mb-4">

        {{-- Top Bar and Tabs --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <h4 class="fw-extrabold text-dark font-outfit mb-0" style="font-size: 16px;">Enrolled Course List</h4>

            {{-- Tabs styling --}}
            <ul class="nav nav-tabs border-0 gap-2 mirror-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ request('type') == null ? 'active' : '' }}" href="{{ route('users.courses.index') }}">
                        All Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') == 'paid' ? 'active' : '' }}" href="{{ route('users.courses.index', ['type' => 'paid']) }}">
                        Paid
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type') == 'free' ? 'active' : '' }}" href="{{ route('users.courses.index', ['type' => 'free']) }}">
                        Free
                    </a>
                </li>
            </ul>
        </div>

        {{-- ================= TABLE AREA ================= --}}
        <div class="table-responsive rounded-3 border">
            <table class="table mirror-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
                        <th>Course Title</th>
                        <th style="width: 150px;">Price</th>
                        <th style="width: 150px;">Access Status</th>
                        <th class="text-end" style="width: 150px;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td class="fw-bold text-dark font-outfit">#{{ $course->id }}</td>

                            {{-- Course Name --}}
                            <td>
                                <a href="{{ route('users.lessons.index', $course->id) }}" class="mirror-course-link">
                                    {{ $course->title }}
                                </a>
                            </td>

                            {{-- Price --}}
                            <td class="fw-bold font-outfit">
                                {{ $course->price > 0 ? '₹' . number_format($course->price) : 'Free' }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($course->status)
                                    <span class="status-badge-inline text-success bg-success bg-opacity-10">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </span>
                                @else
                                    <span class="status-badge-inline text-danger bg-danger bg-opacity-10">
                                        <i class="bi bi-x-circle-fill me-1"></i> Expired
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('users.lessons.index', $course->id) }}" class="btn btn-open-course-mirror">
                                        Open Course
                                    </a>
                                    <a href="{{ route('ai.practice', ['course_id' => $course->id]) }}" class="btn-start-quiz-mirror">
                                        <i class="bi bi-robot"></i> Start Quiz
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-info-circle fs-3 d-block mb-2 text-secondary"></i>
                                No courses found in this category.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ================= PAGINATION ================= --}}
        @if($courses instanceof \Illuminate\Pagination\LengthAwarePaginator && $courses->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span class="small text-muted">
                    Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} of {{ $courses->total() }} entries
                </span>
                <div>
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
