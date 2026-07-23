@extends('admin.layouts.app')

@section('title', 'Course Assignments')

@section('content')

  <div class="main-content-container overflow-hidden text-end">
    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
      <h3 class="mb-0">Course Assign</h3>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14 hover">Dashboard</span>
            </a>
          </li>


          <li class="breadcrumb-item active">
            <span class="text-secondary fs-14">Course Assignments</span>
          </li>
        </ol>
      </nav>
    </div>

    <div class=" flex-wrap gap-2 mb-4 mt-1 bg-white p-20 rounded-10 border border-white">




      <a href="{{ route('admin.course-assign.create') }}" class="btn btn-primary text-end">
        + Assign Course
      </a>

    </div>


    <div class="card bg-white rounded-10 border border-white mb-4">

      <div class="default-table-area mx-minus-1 style-two">

        <div class="table-responsive">

          <table class="table align-middle">

            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Course</th>
                <th>Plan</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @forelse($assignments as $a)
                <tr>

                  <td>#{{ $a->id }}</td>

                  <td>{{ $a->user_name }}</td>

                  <td>{{ $a->course_title }}</td>


                  <td>

                    @if ($a->payment_status == 'free')
                      <span class="badge bg-success">
                        Free
                      </span>
                    @else
                      <span class="badge bg-warning">
                        {{ $a->plan_name ?? 'Paid Plan' }}
                      </span>
                    @endif

                  </td>


                  <td>

                    @if ($a->payment_status == 'free')
                      Free
                    @else
                      ₹ {{ $a->total_amount ?? $a->price ?? '0' }}
                    @endif

                  </td>


                  <td>

                    @if ($a->payment_status == 'free')
                      Unlimited
                    @else
                      {{ $a->duration_value ?? '0' }} {{ $a->duration_type }}
                    @endif

                  </td>


                  <td>

                    @if ($a->subscription_status == 'active')
                      <span class="badge bg-primary">
                        Active
                      </span>
                    @else
                      <span class="badge bg-danger">
                        Inactive
                      </span>
                    @endif

                  </td>


                  <td>

                    <div class="d-flex gap-2">

                      <a href="{{ route('admin.course-assign.edit', $a->id) }}" class="bg-transparent border-0">
                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                      </a>


                      <form action="{{ route('admin.course-assign.destroy', $a->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="bg-transparent border-0" onclick="return confirm('Delete assignment?')">
                          <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                        </button>

                      </form>


                    </div>

                  </td>

                </tr>

              @empty

                <tr>

                  <td colspan="8" class="text-center py-4">
                    No Course Assigned
                  </td>

                </tr>
              @endforelse

            </tbody>

          </table>

        </div>


        <div class="d-flex justify-content-between align-items-center p-20">

          <span class="fs-15">

            Showing {{ $assignments->firstItem() ?? 0 }}
            to {{ $assignments->lastItem() ?? 0 }}
            of {{ $assignments->total() }}

          </span>

          {{ $assignments->links() }}

        </div>

      </div>

    </div>

  </div>

@endsection
