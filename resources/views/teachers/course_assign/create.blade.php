@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Assign Course</h3>
    </div>

    <form action="{{ route('admin.course-assign.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">

                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Select Course</label>
                        <select name="course_id" class="form-select" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Select User</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Status</label>
                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border border-white">
                    <button class="btn btn-primary w-100 text-white">
                        Assign Course
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>

@endsection
