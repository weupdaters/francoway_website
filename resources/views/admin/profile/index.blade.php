@extends('admin.layouts.app')

{{-- Page Title --}}
@section('title', $user->name . ' | Profile')

{{-- SEO Meta --}}
@section('meta_description', $user->bio ?? 'User profile page')
@section('meta_keywords', 'profile, user, admin, dashboard')
@section('meta_author', $user->name)

{{-- Open Graph --}}
@section('og_title', $user->name . ' Profile')
@section('og_description', $user->bio ?? 'User profile details')
@section('og_image', $user->image ? asset('storage/'.$user->image) : asset('admin/images/logo.png'))

@section('content')
@php
    $fields = [$user->name, $user->email, $user->phone, $user->bio, $user->image];
    $filled = collect($fields)->filter()->count();
    $percent = round(($filled / count($fields)) * 100);
@endphp

<div class="container">
    <div class="row">

        <!-- LEFT PROFILE CARD -->
        <div class="col-md-4">
            <div class="card text-center mb-3">
                <div class="card-body">

                    <img id="previewImage"
                         src="{{ $user->image ? asset('storage/'.$user->image) : asset('admin/images/user.png') }}"
                         class="rounded-circle mb-3"
                         width="120"
                         height="120">

                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    <span class="badge bg-primary">
                        {{ ucfirst($user->role ?? 'user') }}
                    </span>

                    <div class="mt-3">
                        <small>Profile Completion: {{ $percent }}%</small>
                        <div class="progress mt-1">
                            <div class="progress-bar bg-success" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT SECTION -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profileTab">
                                Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#passwordTab">
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body tab-content">

                    {{-- SUCCESS / ERROR --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- PROFILE TAB -->
                    <div class="tab-pane fade show active" id="profileTab">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" rows="4" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <button class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>

                    <!-- PASSWORD TAB -->
                    <div class="tab-pane fade" id="passwordTab">
                        <form action="{{ route('admin.profile.password') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <button class="btn btn-warning">Update Password</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelector('input[name="image"]').addEventListener('change', function(e){
        const reader = new FileReader();
        reader.onload = () => document.getElementById('previewImage').src = reader.result;
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endpush
