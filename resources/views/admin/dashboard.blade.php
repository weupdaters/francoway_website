
@extends('admin.layouts.app')


@section('content')
        

<div class="main-content-container overflow-hidden">
    <div class="row">
        <div class="col-xxl-6 col-xxxl-12">
            <div class="rounded-10 p-20 pb-0 gradient-bg position-relative welcome-card mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <span class="fs-16 text-white d-block" style="margin-top: -11px;">{{ date('F d, Y') }}</span>
                        <h3 class="fs-26 fw-medium text-white" style="margin-top: 7px; margin-bottom: 10px;">{{ auth()->user()->name }}</h3>
                        <p class="fs-15 text-white">Learning Management System Dashboard.</p>
                        <p class="fs-16 fw-medium text-white mb-0">Daily Performance</p>
                        <div class="chart">
                            <div id="welcome_chart"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center text-md-end">
                            <img src="{{ asset('admin/images/welcome.png') }}" alt="welcome">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
   
 <div class="card bg-white rounded-10 border border-white mb-4">

    {{-- Card Header --}}
    <div class="d-flex justify-content-between align-items-center p-20">
        <h3 class="mb-0">All Courses</h3>
    </div>

    {{-- Table --}}
   <div class="default-table-area mx-minus-1 table-courses">
    <div class="table-responsive col-md-12">
        <table class="table table-hover table-sm align-middle bg-white">
            
            <thead>
                <tr>
                    <th class="py-1 px-2">ID</th>
                    <th class="py-1 px-2">Course Name</th>
                    <th class="text-end py-1 px-2">Action</th>
                </tr>
            </thead>

                <tbody>
                @forelse ($allCourses as $course)
                    <tr>
                        <td>#{{ $course->id }}</td>

                        <td class="fw-medium">
                            {{ $course->title }}
                        </td>

                        {{-- Actions Icons --}}
                        <td>
                            <div class="d-flex justify-content-end gap-3">

                                {{-- Edit --}}
                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                   data-bs-toggle="tooltip"
                                   data-bs-title="Edit">
                                    <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-transparent border-0 p-0"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Delete"
                                            onclick="return confirm('Delete this course?')">
                                        <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                                    </button>
                                </form>


                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center p-20 text-muted">
                            No courses found
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($allCourses, 'links'))
        <div class="d-flex justify-content-end p-20 bg-white">
            {{ $allCourses->links() }}
        </div>
        @endif

    </div>
</div>


   
</div>

            

@endsection
