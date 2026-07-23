@extends('admin.layouts.app')

@section('content')
<div class="main-content-container overflow-hidden">
    
    {{-- Welcome Hero Header Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="rounded-20 p-4 pb-0 welcome-card mb-4 position-relative" style="background: linear-gradient(135deg, #071530 0%, #1a2a4a 100%); color: #ffffff; min-height: 180px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.05); box-shadow: 0 10px 30px rgba(7, 21, 48, 0.15);">
                <div class="row align-items-center">
                    <div class="col-md-7 ps-4 py-3">
                        <span class="fs-14 d-block text-white-50 text-uppercase fw-bold mb-1" style="letter-spacing: 1px;">{{ date('F d, Y') }}</span>
                        <h3 class="fs-28 fw-bold text-white mb-2">Welcome Back, {{ auth()->user()->name }}!</h3>
                        <p class="fs-15 text-white-70 mb-0">Manage FrancoWay platform courses, students, and system configurations from your premium dashboard panel.</p>
                    </div>
                    <div class="col-md-5 text-center text-md-end d-none d-md-block pe-4">
                        <img src="{{ asset('admin/images/welcome.png') }}" alt="welcome" style="height: 150px; width: auto; object-fit: contain; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 📊 2026 STATS METRIC FIGURES (4 Column Premium Layout) --}}
    <div class="row g-4 mb-4">
        
        {{-- Total Students --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-20 p-4 h-100 bg-white" style="transition: all 0.2s ease;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-12 p-3 d-inline-flex align-items-center justify-content-center" style="background-color: rgba(30, 144, 255, 0.1); width: 50px; height: 50px;">
                        <i class="ri-user-follow-fill text-primary fs-3"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success fs-11 fw-bold">Active Users</span>
                </div>
                <h6 class="text-secondary fw-semibold mb-1 text-uppercase fs-12" style="letter-spacing: 0.5px;">Total Students</h6>
                <h3 class="fw-bold mb-0 text-dark" style="font-size: 26px;">{{ number_format($totalStudents) }}</h3>
            </div>
        </div>

        {{-- Total Teachers --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-20 p-4 h-100 bg-white" style="transition: all 0.2s ease;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-12 p-3 d-inline-flex align-items-center justify-content-center" style="background-color: rgba(255, 165, 0, 0.1); width: 50px; height: 50px;">
                        <i class="ri-presentation-fill text-warning fs-3"></i>
                    </div>
                    <span class="badge bg-info-subtle text-info fs-11 fw-bold">Instructors</span>
                </div>
                <h6 class="text-secondary fw-semibold mb-1 text-uppercase fs-12" style="letter-spacing: 0.5px;">Total Teachers</h6>
                <h3 class="fw-bold mb-0 text-dark" style="font-size: 26px;">{{ number_format($totalTeachers) }}</h3>
            </div>
        </div>

        {{-- Total Courses --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-20 p-4 h-100 bg-white" style="transition: all 0.2s ease;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-12 p-3 d-inline-flex align-items-center justify-content-center" style="background-color: rgba(40, 167, 69, 0.1); width: 50px; height: 50px;">
                        <i class="ri-book-open-fill text-success fs-3"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning fs-11 fw-bold">Live Catalog</span>
                </div>
                <h6 class="text-secondary fw-semibold mb-1 text-uppercase fs-12" style="letter-spacing: 0.5px;">Total Courses</h6>
                <h3 class="fw-bold mb-0 text-dark" style="font-size: 26px;">{{ number_format($totalCourses) }}</h3>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-20 p-4 h-100 bg-white" style="transition: all 0.2s ease;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-12 p-3 d-inline-flex align-items-center justify-content-center" style="background-color: rgba(138, 43, 226, 0.1); width: 50px; height: 50px;">
                        <i class="ri-money-dollar-circle-fill text-purple fs-3" style="color: #8a2be2;"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger fs-11 fw-bold">Processed</span>
                </div>
                <h6 class="text-secondary fw-semibold mb-1 text-uppercase fs-12" style="letter-spacing: 0.5px;">Total Revenue</h6>
                <h3 class="fw-bold mb-0 text-dark" style="font-size: 26px;">₹{{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>

    </div>

    {{-- Courses List Table Card --}}
    <div class="card bg-white rounded-20 border border-light shadow-sm mb-4">
        
        {{-- Card Header --}}
        <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
            <h4 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="ri-book-3-fill text-primary"></i> All Courses Catalog
            </h4>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary" style="height: 40px;">
                <i class="ri-add-circle-fill"></i> Add Course
            </a>
        </div>

        {{-- Table --}}
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle bg-white mb-0">
                <thead>
                    <tr>
                        <th class="py-3 px-4" style="width: 80px;">ID</th>
                        <th class="py-3 px-4">Course Details</th>
                        <th class="py-3 px-4" style="width: 150px;">Enrolled Students</th>
                        <th class="py-3 px-4 text-end" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($allCourses as $course)
                    <tr>
                        <td class="px-4 fw-bold text-secondary">#{{ $course->id }}</td>

                        <td class="px-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-8 p-1 border" style="background-color: #f7fafc; width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="ri-book-read-fill text-secondary fs-4"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $course->title }}</span>
                                    <span class="text-muted small">Updated {{ $course->updated_at ? $course->updated_at->diffForHumans() : 'N/A' }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-4">
                            <span class="badge bg-primary-subtle text-primary px-3 py-1 fs-12 fw-bold rounded-pill">
                                <i class="ri-group-line me-1"></i> {{ $course->users_count }} Students
                            </span>
                        </td>

                        {{-- Action Icons --}}
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end align-items-center gap-3">
                                {{-- Edit --}}
                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                   class="btn btn-sm btn-outline-primary p-0 d-inline-flex align-items-center justify-content-center"
                                   style="width: 32px; height: 32px; border-radius: 8px; border: 1.5px solid #EAEAEA; background: transparent;"
                                   title="Edit Course">
                                    <i class="ri-edit-2-line fs-16 text-primary"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px; border-radius: 8px; border: 1.5px solid #EAEAEA; background: transparent;"
                                            title="Delete Course"
                                            onclick="return confirm('Delete this course?')">
                                        <i class="ri-delete-bin-line fs-16 text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="ri-inbox-line fs-1 d-block mb-2 text-secondary"></i>
                            <span>No courses found in catalog</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($allCourses, 'links'))
        <div class="d-flex justify-content-end p-4 border-top">
            {{ $allCourses->links() }}
        </div>
        @endif

    </div>

</div>
@endsection
