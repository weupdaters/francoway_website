@extends('users.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Create Course</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item"><span>LMS</span></li>
                <li class="breadcrumb-item"><span>Courses</span></li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Create Course</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- MAIN FORM --}}
    <form action="{{ route('admin.courses.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Add a Course</h3>

                    {{-- Course Title --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Title</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   id="floatingInput1"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Course Title">
                            <label for="floatingInput1">Course Title</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-20">
                        <label class="label fs-16">Course Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  style="height:163px;">{{ old('description') }}</textarea>
                    </div>

                    {{-- Price --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Course Price</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   id="floatingInput3"
                                   name="price"
                                   value="{{ old('price') }}"
                                   placeholder="Enter rate">
                            <label for="floatingInput3">Enter rate</label>
                        </div>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="form-group mb-4 only-file-upload" id="file-upload">
                        <label class="label fs-16 text-secondary">Course Avatar</label>
                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                            <div class="product-upload">
                                <label class="file-upload mb-0">
                                    <i class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                    <span class="d-block text-body fs-14">
                                        Drag and drop an image or
                                        <span class="text-primary text-decoration-underline">Browse</span>
                                    </span>
                                </label>
                                <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                                    <input class="form__file bottom-0"
                                           type="file"
                                           name="thumbnail"
                                           accept="image/jpeg, image/png, image/gif">
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Cover Image --}}
                        <div class="form-group mb-4 only-file-upload">
                            <label class="label fs-16 text-secondary">Course Cover Image</label>
                            <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                <div class="product-upload">
                                    <label class="file-upload mb-0">
                                        <i class="ri-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                        <span class="d-block text-body fs-14">
                                            Drag and drop cover image or
                                            <span class="text-primary text-decoration-underline">Browse</span>
                                        </span>
                                    </label>
                                    <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                                        <input class="form__file bottom-0"
                                            type="file"
                                            name="cover_image"
                                            accept="image/jpeg, image/png, image/gif">
                                    </label>
                                </div>
                            </div>
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
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    {{-- Trial Video --}}
                        <div class="mb-20">
                            <label class="label fs-16 mb-2">Trial Video (Preview)</label>
                            <div class="form-control h-100 text-center position-relative p-4">
                                <div class="product-upload">
                                    <label class="file-upload mb-0">
                                        <i class="ri-video-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                        <span class="d-block text-body fs-14">
                                            Upload trial video
                                            <span class="text-primary text-decoration-underline">Browse</span>
                                        </span>
                                    </label>
                                    <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                                        <input class="form__file bottom-0"
                                            type="file"
                                            name="trial_video"
                                            accept="video/*">
                                    </label>
                                </div>
                            </div>
                        </div>


                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit"
                                class="btn btn-primary fw-normal text-white">
                            Save Course
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
