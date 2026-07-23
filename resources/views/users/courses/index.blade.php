@extends('users.layouts.app')

@section('title', 'My Courses | ' . ($settings['site_name'] ?? 'Francoway'))

@push('styles')
<style>
    /* Premium card container styling */
    .courses-card-wrapper {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        border: 1px solid #EAEAEA;
    }

    /* Page title & breadcrumb */
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

    /* Tabs styling */
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
        background-color: rgba(227, 27, 35, 0.04);
    }
    .mirror-tabs .nav-link.active {
        background-color: #E31B23 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(227, 27, 35, 0.2);
    }

    /* Course Card Row Item Styling */
    .course-item-card {
        background: #ffffff;
        border: 1px solid #EAEAEA;
        border-radius: 18px;
        padding: 20px;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        margin-bottom: 16px;
    }

    .course-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(7, 21, 48, 0.06);
        border-color: #CBD5E1;
    }

    .course-thumb-box {
        width: 130px;
        height: 95px;
        border-radius: 14px;
        overflow: hidden;
        flex-shrink: 0;
        position: relative;
        background: linear-gradient(135deg, #071530 0%, #101F42 100%);
    }

    .course-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .course-thumb-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 800;
        font-size: 22px;
        font-family: 'Outfit', sans-serif;
    }

    .hover-text-danger:hover {
        color: #E31B23 !important;
    }

    /* Buttons styling */
    .btn-action-primary {
        background-color: #071530;
        color: #ffffff;
        font-weight: 700;
        font-size: 12.5px;
        padding: 9px 20px;
        border-radius: 50px;
        transition: all 0.25s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-action-primary:hover {
        background-color: #E31B23;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(227, 27, 35, 0.25);
    }

    .btn-action-outline {
        background-color: transparent;
        border: 1.5px solid #E31B23 !important;
        color: #E31B23 !important;
        font-weight: 700;
        font-size: 12.5px;
        padding: 8px 18px;
        border-radius: 50px;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-action-outline:hover {
        background-color: #E31B23 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(227, 27, 35, 0.2);
        transform: translateY(-1px);
    }

    .progress-bar-gradient {
        background: linear-gradient(90deg, #E53935 0%, #8B5CF6 100%);
        border-radius: 10px;
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
    <div class="courses-card-wrapper mb-4">

        {{-- Top Bar and Tabs --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 pb-2 border-bottom">
            <h4 class="fw-extrabold text-dark font-outfit mb-0" style="font-size: 17px;">Enrolled Course List</h4>

            {{-- Filter Tabs --}}
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

        {{-- ================= COURSES CARD LIST ================= --}}
        <div class="courses-list-content">
            @forelse($courses as $course)
                @php
                    $totalLessons = $course->lessons ? $course->lessons->count() : 0;
                    $completedLessons = $course->lessons ? auth()->user()->lessons()->whereIn('lesson_id', $course->lessons->pluck('id'))->count() : 0;
                    $progress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
                    $initials = strtoupper(substr($course->title, 0, 2));
                @endphp

                <div class="course-item-card">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        
                        {{-- Left: Thumbnail + Title Info --}}
                        <div class="d-flex align-items-center gap-3 flex-grow-1">
                            <div class="course-thumb-box">
                                @if($course->thumbnail || $course->cover_image)
                                    <img src="{{ asset('storage/' . ($course->thumbnail ?? $course->cover_image)) }}" alt="{{ $course->title }}" class="course-thumb-img" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('d-none');">
                                    <div class="course-thumb-placeholder d-none">
                                        {{ $initials }}
                                    </div>
                                @else
                                    <div class="course-thumb-placeholder">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge bg-light text-secondary border font-fw" style="font-size: 10.5px; border-radius: 6px;">
                                        #{{ $course->id }}
                                    </span>
                                    @if($progress >= 100)
                                        <span class="badge bg-success bg-opacity-10 text-success fw-bold" style="font-size: 11px; border-radius: 6px;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Completed
                                        </span>
                                    @elseif($progress > 0)
                                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold" style="font-size: 11px; border-radius: 6px;">
                                            <i class="bi bi-play-circle-fill me-1"></i> In Progress
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary fw-bold" style="font-size: 11px; border-radius: 6px;">
                                            Enrolled
                                        </span>
                                    @endif
                                </div>

                                <h5 class="fw-bold text-dark mb-1" style="font-size: 16px; font-family: 'Outfit', sans-serif;">
                                    <a href="{{ route('users.lessons.index', $course->id) }}" class="text-decoration-none text-dark hover-text-danger">
                                        {{ $course->title }}
                                    </a>
                                </h5>

                                <div class="d-flex flex-wrap align-items-center gap-3 text-muted small mt-1" style="font-size: 12.5px;">
                                    <span><i class="bi bi-journal-text me-1 text-danger"></i> {{ $totalLessons }} Lessons</span>
                                    <span><i class="bi bi-tag me-1 text-secondary"></i> {{ $course->price > 0 ? '₹' . number_format($course->price) : 'Free' }}</span>
                                </div>

                                {{-- Progress Bar --}}
                                <div class="mt-2.5" style="max-width: 340px;">
                                    <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 11.5px;">
                                        <span class="text-muted fw-semibold">Course Progress</span>
                                        <span class="fw-bold text-dark">{{ $progress }}%</span>
                                    </div>
                                    <div class="progress" style="height: 6px; background-color: #E2E8F0; border-radius: 10px;">
                                        <div class="progress-bar {{ $progress >= 100 ? 'bg-success' : 'progress-bar-gradient' }}" 
                                             role="progressbar" 
                                             style="width: {{ $progress }}%;" 
                                             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Actions --}}
                        <div class="d-flex align-items-center gap-2 align-self-md-center mt-2 mt-md-0">
                            <a href="{{ route('users.lessons.index', $course->id) }}" class="btn-action-primary">
                                <i class="bi bi-play-fill fs-6"></i>
                                <span>{{ $progress > 0 ? 'Continue' : 'Open Course' }}</span>
                            </a>
                            <a href="{{ route('ai.practice', ['course_id' => $course->id]) }}" class="btn-action-outline">
                                <i class="bi bi-robot fs-6"></i>
                                <span>AI Practice</span>
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted bg-light rounded-16 border border-dashed">
                    <i class="bi bi-journal-x fs-1 d-block mb-2 text-secondary"></i>
                    <h6 class="fw-bold text-dark mb-1">No Courses Found</h6>
                    <p class="small mb-0">You have not enrolled in any courses in this category yet.</p>
                </div>
            @endforelse
        </div>

        {{-- ================= PAGINATION ================= --}}
        @if($courses instanceof \Illuminate\Pagination\LengthAwarePaginator && $courses->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
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
