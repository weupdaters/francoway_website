@extends('users.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">My Courses</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('users.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">My Courses</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- ================= CARD ================= --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Top bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3 class="mb-0">Enrolled Courses</h3>

            {{-- filters (optional) --}}
            <ul class="nav nav-tabs border-0 gap-2 tabs-default-active">
                <li class="nav-item">
                    <a class="nav-link {{ request('type')==null ? 'active' : '' }}"
                       href="{{ route('users.courses.index') }}">
                        All
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type')=='paid' ? 'active' : '' }}"
                       href="{{ route('users.courses.index',['type'=>'paid']) }}">
                        Paid
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('type')=='free' ? 'active' : '' }}"
                       href="{{ route('users.courses.index',['type'=>'free']) }}">
                        Free
                    </a>
                </li>
            </ul>
        </div>

        {{-- ================= TABLE ================= --}}
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

                            {{-- COURSE NAME --}}
                            <td>
                                <a href="{{ route('users.lessons.index', $course->id) }}"
                                   class="text-decoration-none fs-16 fw-medium text-secondary hover-text">
                                    {{ $course->title }}
                                </a>
                            </td>

                            {{-- PRICE --}}
                            <td>
                                {{ $course->price > 0 ? '₹'.$course->price : 'Free' }}
                            </td>

                            {{-- STATUS --}}
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

                            {{-- ACTION --}}
                            <td class="text-end">
                                {{-- OPEN COURSE (LMS PLAYER) --}}
                                <a href="{{ route('users.lessons.index', $course->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Open Course
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No courses assigned
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

            {{-- ================= PAGINATION ================= --}}
            @if($courses instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-between align-items-center p-20">
                <span class="fs-15">
                    Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }}
                    of {{ $courses->total() }} entries
                </span>

                {{ $courses->links() }}
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
