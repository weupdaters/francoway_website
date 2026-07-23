@extends('admin.layouts.app')

@section('content')

<style>
.course-card {
    border-radius: 18px;
    transition: all 0.3s ease;
    background: #ffffff;
}

.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.course-avatar {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    background: linear-gradient(135deg,#4e73df,#1cc88a);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
    font-weight: 600;
}

.progress {
    height: 6px;
    border-radius: 20px;
    background-color: #f1f3f7;
}

.progress-bar {
    border-radius: 20px;
}
</style>
{{-- Breadcrumb --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Course LIst</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
        
                <li class="breadcrumb-item"><span>Courses</span></li>
                
            </ol>
        </nav>
    </div>

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1 bg-white p-3 border border-white rounded-10">
        <h3 class="mb-0 fw-semibold">Courses</h3>

        <a href="{{ route('admin.courses.create') }}"
           class="btn btn-primary px-4">
            + Create Course
        </a>
    </div>

    <div class="row g-4">

        @forelse($courses as $course)

        @php
            $progress = $course->status ? 90 : 40;
        @endphp

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm course-card h-100 p-4">

                {{-- Top Section --}}
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div class="d-flex align-items-center">
                        <div class="course-avatar me-3">
                            {{ strtoupper(substr($course->title,0,1)) }}
                        </div>

                        <div>
                            <h5 class="mb-1 fw-semibold">
                                {{ $course->title }}
                            </h5>
                            <small class="text-muted">
                                Course ID: #{{ $course->id }}
                            </small>
                        </div>
                    </div>

                    @if($course->status)
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                            Published
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                            Draft
                        </span>
                    @endif

                </div>

                {{-- Price & Prompt --}}
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <span class="fs-5 fw-bold text-dark">
                        {{ $course->price > 0 ? '$'.$course->price : 'Free Course' }}
                    </span>
                    @if($course->has_custom_prompt)
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                            Custom Prompt
                        </span>
                    @endif
                </div>

                {{-- Progress --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="text-muted">Completion</small>
                        <small class="fw-semibold">{{ $progress }}%</small>
                    </div>

                    <div class="progress">
                        <div class="progress-bar bg-primary"
                             style="width: {{ $progress }}%">
                        </div>
                    </div>
                </div>

                {{-- Button --}}
                <div class="mt-auto">
                    <a href="{{ route('admin.courses.show',$course->id) }}"
                       class="btn btn-primary w-100 rounded-pill">
                        View Details
                    </a>
                </div>

                {{-- Icons --}}
                <div class="d-flex justify-content-end gap-3 mt-4">

                    <a href="{{ route('admin.lessons.index', $course->id) }}">
                        <img src="https://img.icons8.com/color/48/add.png" style="width: 18px; height: 18px; object-fit: contain;" alt="add lessons">
                    </a>

                   

                    <a href="{{ route('admin.courses.edit',$course->id) }}">
                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                    </a>

                    <form action="{{ route('admin.courses.destroy',$course->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-transparent border-0 p-0"
                                onclick="return confirm('Delete this course?')">
                            <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                        </button>
                    </form>


                </div>

            </div>
        </div>

        @empty
            <div class="col-12 text-center">
                No courses found
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-5 flex-wrap gap-2">
        <span>
            Showing {{ $courses->firstItem() ?? 0 }}
            to {{ $courses->lastItem() ?? 0 }}
            of {{ $courses->total() }} entries
        </span>

        {{ $courses->links() }}
    </div>

</div>

@endsection