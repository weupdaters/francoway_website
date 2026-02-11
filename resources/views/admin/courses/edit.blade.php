@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Edit Course</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
        
                <li class="breadcrumb-item"><span>Courses</span></li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Edit Course</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- MAIN FORM --}}
    <form action="{{ route('admin.courses.update', $course->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Update Course</h3>

                    {{-- Title --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Title</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   name="title"
                                   value="{{ old('title', $course->title) }}"
                                   placeholder="Course Title">
                            <label>Course Title</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-20">
                        <label class="label fs-16">Course Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  style="height:163px;">{{ old('description', $course->description) }}</textarea>
                    </div>

                    {{-- Price --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Price</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   name="price"
                                   value="{{ old('price', $course->price) }}"
                                   placeholder="Enter rate">
                            <label>Enter rate</label>
                        </div>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label fs-16 text-secondary">Course Avatar</label>
                        <input type="file" class="form-control" name="thumbnail">
                        @if($course->thumbnail)
                            <small class="text-secondary d-block mt-1">
                                Current: {{ $course->thumbnail }}
                            </small>
                        @endif
                    </div>

                    {{-- Cover Image --}}
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label fs-16 text-secondary">Course Cover Image</label>
                        <input type="file" class="form-control" name="cover_image">
                        @if($course->cover_image)
                            <small class="text-secondary d-block mt-1">
                                Current: {{ $course->cover_image }}
                            </small>
                        @endif
                    </div>

                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Course Overview</h3>

                    {{-- Status --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Status</label>
                        <select class="form-select" name="status">
                            <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Published</option>
                            <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>

                    {{-- Trial Video --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Trial Video</label>
                        <input type="file" class="form-control" name="trial_video">
                        @if($course->trial_video)
                            <small class="text-secondary d-block mt-1">
                                Current: {{ $course->trial_video }}
                            </small>
                        @endif
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit"
                                class="btn btn-primary fw-normal text-white">
                            Update Course
                        </button>

                        <a href="{{ route('admin.courses.index') }}"
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
