@extends('teachers.layouts.app')

@section('content')

  {{-- Page Wrapper --}}
  <div class="bg-white p-4 rounded-3">

    <h3 class="mb-4 fw-bold">My Assigned Users</h3>

    @if ($users->count())
      <div class="row g-4">
        @foreach ($users as $user)
          <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card bg-white border-0 shadow-sm h-100">

              {{-- Card Body --}}
              <div class="card-body">

                <div class="d-flex align-items-center mb-3">
                  {{-- User Image --}}
                  <div class="flex-shrink-0">
                    <img
                      src="{{ $user->image ? asset('storage/' . $user->image) : asset('admin/assets/images/user1.jpg') }}"
                      class="rounded-circle bg-white" width="55" height="55" alt="User">
                  </div>

                  {{-- User Info --}}
                  <div class="ms-3">
                    <h6 class="mb-0 fw-semibold text-dark">
                      {{ $user->name }}
                    </h6>
                    <small class="text-muted">User</small>
                  </div>

                  {{-- More icon --}}
                  <div class="ms-auto">
                    <i class="bi bi-three-dots-vertical text-muted"></i>
                  </div>
                </div>
                  
                {{-- Assigned Courses --}}
                <p class="mb-2 fw-semibold text-dark">
                  Assigned Courses:
                </p>

                @if ($user->courses->count())
                  <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach ($user->courses as $course)
                      <span class="badge bg-primary text-white">
                        {{ strtoupper($course->title) }}
                      </span>
                    @endforeach
                  </div>
                @else
                  <span class="text-muted small">
                    No courses assigned
                  </span>
                @endif

                
                {{-- Action Button --}}
                <a href="{{ route('teacher.course_lessons_user.index', $user->id) }}"
                  class="btn btn-outline-primary btn-sm w-100">
                  View Details
                </a>

              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-info">
        No users assigned to you yet.
      </div>
    @endif

  </div>

@endsection
