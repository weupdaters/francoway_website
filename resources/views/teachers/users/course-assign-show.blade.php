@extends('teachers.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Assigned Courses</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Users
                </li>
                <li class="breadcrumb-item active">
                    {{ $user->name }}
                </li>
            </ol>
        </nav>
    </div>

    {{-- User Info --}}
    <div class="card bg-white p-20 rounded-10 border border-white mb-4">
        <h4 class="mb-2">{{ $user->name }}</h4>
        <p class="text-secondary mb-0">{{ $user->email }}</p>
    </div>

    {{-- Courses Table --}}
    <div class="card bg-white rounded-10 border border-white mb-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($user->courses as $course)
                    <tr>
                        <td>#{{ $course->id }}</td>

                        <td>
                            {{ $course->title }}
                        </td>

                        <td>
                            {{ $course->price > 0 ? '₹'.$course->price : 'Free' }}
                        </td>

                        <td>
                            @if($course->pivot->status == 1)
                                <span class="text-success bg-success bg-opacity-10 default-badge">
                                    Active
                                </span>
                            @else
                                <span class="text-danger bg-danger bg-opacity-10 default-badge">
                                    Inactive
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No courses assigned
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
