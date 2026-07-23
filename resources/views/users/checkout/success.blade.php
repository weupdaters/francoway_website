@extends('users.layouts.app')

@section('title', 'Purchase Successful | ' . ($settings['site_name'] ?? 'Francoway'))

@section('content')
<div class="py-5 bg-light min-h-screen d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <!-- Success Card -->
                <div class="card border-0 shadow-lg p-5 text-center position-relative overflow-hidden" style="border-radius: 24px; background-color: #ffffff;">
                    
                    <!-- Colorful Top Bar -->
                    <div class="position-absolute top-0 start-0 end-0" style="height: 6px; background: linear-gradient(90deg, #4ade80, #E31B23, #0B1E43);"></div>

                    <!-- Icon -->
                    <div class="d-inline-flex align-items-center justify-center rounded-circle bg-success bg-opacity-10 text-success mb-4" style="width: 72px; height: 72px; margin: 0 auto;">
                        <i class="fas fa-check fs-2 text-success"></i>
                    </div>

                    <!-- Header -->
                    <h3 class="fw-black text-dark text-uppercase tracking-wide mb-2">
                        Enrollment <span class="text-success">Successful!</span>
                    </h3>
                    <p class="text-muted small fw-bold text-uppercase tracking-widest mb-3">Merci Beaucoup!</p>
                    <p class="text-muted small px-3 mb-4">
                        Your payment was processed and verified. You now have full access to study materials and lessons.
                    </p>

                    <!-- Receipt Details -->
                    <div class="bg-light rounded-3 p-4 text-start mb-4 border">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted fw-bold text-uppercase">Course Name</span>
                            <span class="text-dark fw-bold text-end truncate ps-3" style="max-width: 60%;">{{ $course->title }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted fw-bold text-uppercase">Amount Paid</span>
                            <span class="text-danger fw-black">₹{{ number_format($course->price, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted fw-bold text-uppercase">Access Period</span>
                            <span class="text-success fw-bold text-uppercase">12 Months</span>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span class="text-muted fw-bold text-uppercase">Status</span>
                            <span class="badge bg-success text-uppercase px-2 py-1">Active</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="d-grid gap-2.5">
                        <a href="{{ route('users.lessons.index', $course->id) }}" class="btn btn-primary btn-learning py-3 rounded-3 text-uppercase fw-bold">
                            🚀 Start Learning Now
                        </a>
                        <a href="{{ route('users.dashboard') }}" class="btn btn-outline-secondary py-2.5 rounded-3 text-uppercase small fw-bold">
                            Go to Dashboard
                        </a>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>

<style>
    .fw-black {
        font-weight: 900;
    }
    .min-h-screen {
        min-height: 80vh;
    }
    .btn-learning {
        background-color: #0b1e43 !important;
        border-color: #0b1e43 !important;
        transition: all 0.3s ease;
    }
    .btn-learning:hover {
        background-color: #E31B23 !important;
        border-color: #E31B23 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(227, 27, 35, 0.2);
    }
</style>
@endsection
