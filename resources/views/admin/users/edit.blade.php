@extends('admin.layouts.app')

@section('content')

        {{-- Breadcrumb --}}
        <div class="main-content-container overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
                        <h3 class="mb-0">Create User</h3>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb align-items-center mb-0 lh-1">
                               
                                
                                <li class="breadcrumb-item active" aria-current="page">
                                   <a href="{{ route('admin.users.index') }}"
                                       class="d-flex align-items-center text-decoration-none">
                                        <span class="text-body fs-14 hover">Users</span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="d-flex align-items-center text-decoration-none">
                                        <span class="text-secondary fs-14 hover">Edit User</span>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>

<div class="card bg-white p-20 rounded-10 border border-white mb-4">

    <form action="{{ route('admin.users.update', $user->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- Full Name --}}
            <div class="col-lg-4">
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Full Name</label>
                    <div class="form-floating">
                        <input type="text" name="name"
                               class="form-control"
                               placeholder="Enter Full Name"
                               value="{{ old('name', $user->name) }}">
                        <label>Enter Full Name</label>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-lg-4">
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Email Address</label>
                    <div class="form-floating">
                        <input type="email" name="email"
                               class="form-control"
                               placeholder="Enter Email Address"
                               value="{{ old('email', $user->email) }}">
                        <label>Enter Email Address</label>
                    </div>
                </div>
            </div>

            {{-- Password (optional) --}}
            <div class="col-lg-4">
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Password</label>
                    <div class="form-floating">
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Leave blank to keep old password">
                        <label>New Password (optional)</label>
                    </div>
                </div>
            </div>

            {{-- Role --}}
            <div class="col-lg-4">
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Role</label>
                    <div class="form-floating">
                        <select name="role" class="form-select form-control">
                            <option value="">Select Role</option>
                            <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>

                        <label>Select Role</label>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="col-lg-4">
                <div class="mb-20">
                    <label class="label fs-16 mb-2">Status</label>
                    <div class="form-floating">
                        <select name="status" class="form-select form-control">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Published</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Draft</option>
                        </select>

                        <label>Select Status</label>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="col-lg-6">
                <div class="form-group mb-20">
                    <label class="label fs-16">Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="6"
                              placeholder="Enter Description">{{ old('description', $user->description) }}</textarea>   
                </div>
            </div>

            {{-- Image --}}
            <div class="col-lg-6">
                <div class="form-group mb-4">
                    <label class="label fs-16 text-secondary">Image</label>
                    <input type="file" name="image" class="form-control">

                    @if($user->image)
                       <img src="{{ $user->image
                        ? asset('storage/'.$user->image)
                        : asset('admin/assets/images/user1.jpg') }}"
                        class="mt-2 rounded"
                        width="80">


                    @endif
                </div>
            </div>

            {{-- Buttons --}}
            <div class="col-lg-12">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary fw-normal text-white">
                        Update User
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-danger fw-normal text-white">
                        Cancel
                    </a>
                </div>
            </div>

        </div>
    </form>

</div>

@endsection
