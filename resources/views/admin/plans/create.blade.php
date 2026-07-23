@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Create Subscription Plan</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.plans.index') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-file-list-3-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Plans</span>
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    <span class="text-secondary">Create Plan</span>
                </li>

            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.plans.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">

                <div class="card bg-white p-20 rounded-10 border border-white mb-4">

                    <h3 class="mb-20">Add Subscription Plan</h3>

                    {{-- Course --}}
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


                    {{-- Plan Name --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Plan Name</label>
                        <div class="form-floating">
                            <input type="text"
                                   name="plan_name"
                                   class="form-control"
                                   placeholder="Plan Name"
                                   required>
                            <label>Plan Name</label>
                        </div>
                    </div>


                    {{-- Duration Type --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Duration Type</label>

                        <select name="duration_type" class="form-select">
                            <option value="days">Days</option>
                            <option value="weeks">Weeks</option>
                            <option value="months">Months</option>
                            <option value="years">Years</option>
                        </select>
                    </div>


                    {{-- Duration Value --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Duration Value</label>

                        <div class="form-floating">
                            <input type="number"
                                   name="duration_value"
                                   class="form-control"
                                   placeholder="Duration"
                                   required>

                            <label>Duration</label>
                        </div>
                    </div>


                    {{-- Price --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Price</label>

                        <div class="form-floating">
                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   class="form-control"
                                   placeholder="Price"
                                   required>

                            <label>Price</label>
                        </div>
                    </div>

                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">

                <div class="card bg-white p-20 rounded-10 border border-white mb-4">

                    <h3 class="mb-20">Plan Overview</h3>

                    {{-- Status --}}
                    <div class="mb-20">

                        <label class="label fs-16 mb-2">Status</label>

                        <select name="status" class="form-select">

                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2">

                        <button type="submit" class="btn btn-primary fw-normal text-white">
                            Save Plan
                        </button>

                        <a href="{{ route('admin.plans.index') }}"
                           class="btn btn-outline-border-color text-secondary fw-normal">
                            Cancel
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection