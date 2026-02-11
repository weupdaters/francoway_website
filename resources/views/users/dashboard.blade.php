@extends('users.layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4 px-lg-5">

    
    
   

    {{-- Courses Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 fw-bold mb-0">Assigned Courses</h2>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary rounded-pill px-3 py-2">
                        {{ $courses->count() }} course{{ $courses->count() !== 1 ? 's' : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if($courses->count())
        <div class="row g-4">
            @foreach($courses as $course)
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-shadow">
                        
                        {{-- Course Image with Overlay --}}
                        <div class="position-relative overflow-hidden rounded-top">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/'.$course->thumbnail) }}" 
                                     class="card-img-top" 
                                     alt="{{ $course->title }}"
                                     style="height: 200px; object-fit: cover; transition: transform 0.3s;">
                            @else
                                <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <div class="text-center text-white">
                                        <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                                        <h5 class="mb-0">{{ $course->title }}</h5>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Status Badge --}}
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-success d-flex align-items-center gap-1 px-3 py-2">
                                    <i class="fas fa-check-circle"></i>
                                    <span class="d-none d-sm-inline">Assigned</span>
                                </span>
                            </div>
                            
                            {{-- Hover Overlay --}}
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                                <button class="btn btn-light rounded-pill px-4 py-2">
                                    <i class="fas fa-play me-2"></i> Quick Preview
                                </button>
                            </div>
                        </div>

                        {{-- Course Content --}}
                        <div class="card-body d-flex flex-column p-4">
                            
                            {{-- Title --}}
                            <h5 class="card-title fw-bold mb-2 text-truncate">
                                {{ $course->title }}
                            </h5>
                            
                            {{-- Description --}}
                            <p class="card-text text-muted small mb-4 flex-grow-1" style="min-height: 60px;">
                                {{ \Illuminate\Support\Str::limit($course->description, 120) }}
                            </p>
                            
                            {{-- Progress Section --}}
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted fw-medium">Your Progress</small>
                                    <small class="text-primary fw-bold">0%</small>
                                </div>
                                <div class="progress rounded-pill" style="height: 6px;">
                                    <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                            
                            {{-- Action Buttons --}}
                            <div class="d-grid gap-2">
    <a href="{{ route('users.lessons.index', $course->id) }}" 
       class="btn btn-primary btn-lg shadow-sm d-flex align-items-center justify-content-center gap-3 rounded-4 py-3">
        
        <i class="fas fa-play"></i>
        <span class="fw-semibold">Start Learning</span>

    </a>
</div>

                            
                        </div>
                        
                      
                        
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="fas fa-book-open fa-4x text-primary opacity-25"></i>
                        </div>
                        <h3 class="fw-bold text-muted mb-3">No Courses Assigned</h3>
                        <p class="text-muted mb-4 px-3">
                            You haven't been assigned to any courses yet. Please contact your administrator 
                            or check back later for course assignments.
                        </p>
                        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4">
                            <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2 px-4 py-3">
                                <i class="fas fa-envelope"></i>
                                Contact Admin
                            </button>
                            <button class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-2 px-4 py-3">
                                <i class="fas fa-question-circle"></i>
                                Get Help
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Bottom Action Bar --}}
   

</div>

{{-- Add Bootstrap Icons if not already included --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Minimal custom CSS for hover effects */
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .hover-opacity-100 {
        transition: opacity 0.3s ease;
    }
    
    .hover-opacity-100:hover {
        opacity: 1 !important;
    }
    
    .transition-opacity {
        transition: opacity 0.3s ease;
    }
    
    .progress-bar {
        transition: width 0.6s ease;
    }
    
    .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .px-3 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        .card-body {
            padding: 1.25rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .btn span:not(.d-sm-inline) {
            display: none;
        }
        
        .btn i {
            margin-right: 0 !important;
        }
    }
</style>

<!-- Add Bootstrap JS for dropdowns -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection