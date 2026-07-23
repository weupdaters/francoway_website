@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Create Resource</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item"><span>Resources</span></li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Create Resource</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- MAIN FORM --}}
    <form action="{{ route('admin.resources.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Add New Resource</h3>

                    {{-- Title --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Resource Title</label>
                        <div class="form-floating">
                            <input type="text"
                                   class="form-control"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Resource Title">
                            <label>Resource Title</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-20">
                        <label class="label fs-16">Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  style="height:163px;">{{ old('description') }}</textarea>
                    </div>

                    {{-- Cover Image --}}
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label fs-16 text-secondary">Cover Image</label>
                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                            <div class="product-upload">
                                <label class="file-upload mb-0">
                                    <i class="ri-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                    <span class="d-block text-body fs-14">
                                        Drag and drop image or
                                        <span class="text-primary text-decoration-underline">Browse</span>
                                    </span>
                                </label>
                                <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                                    <input class="form__file bottom-0"
                                           type="file"
                                           name="image"
                                           accept="image/jpeg, image/png, image/gif">
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- PDF Upload --}}
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label fs-16 text-secondary">Upload PDF File</label>
                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                            <div class="product-upload">
                                <label class="file-upload mb-0">
                                    <i class="ri-file-pdf-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                    <span class="d-block text-body fs-14">
                                        Upload PDF
                                        <span class="text-primary text-decoration-underline">Browse</span>
                                    </span>
                                </label>
                                <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor">
                                    <input class="form__file bottom-0"
                                           type="file"
                                           name="pdf"
                                           accept="application/pdf">
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">
                <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                    <h3 class="mb-20">Resource Settings</h3>

                    {{-- Status --}}
                    <div class="mb-20">
                        <label class="label fs-16 mb-2">Status</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit"
                                class="btn btn-primary fw-normal text-white">
                            Save Resource
                        </button>

                        <a href="{{ route('admin.resources.index') }}"
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
