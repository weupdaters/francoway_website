
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
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3>Courses</h3>

            
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all-courses-tab-pane" role="tabpanel" aria-labelledby="all-courses-tab" tabindex="0">
                <div class="default-table-area mx-minus-1 table-courses">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Course Name</th>
                                   
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allCourses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center justify-content-sm-between align-items-center flex-wrap gap-2">
                                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>   
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                  
                </div>
            </div>
         
        </div>
    </div>
   
</div>

            

@endsection
