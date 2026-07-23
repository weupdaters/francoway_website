@extends('users.layouts.app')

@section('title', 'My Profile | ' . ($settings['site_name'] ?? 'Francoway'))

@push('styles')
<style>
    /* Premium Profile card layouts */
    .profile-card {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        border: 1px solid #EAEAEA;
        height: 100%;
    }
    .profile-card-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 18px;
        color: #071530;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 15px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .profile-card-title i {
        color: #E53935;
    }

    /* Form control premium styles */
    .form-label {
        font-size: 13px;
        font-weight: 700;
        color: #5A6A85;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-control-premium {
        height: 48px;
        border-radius: 10px;
        border: 1px solid #DCE3EC;
        padding: 10px 16px;
        font-size: 14px;
        color: #071530;
        font-weight: 500;
        background-color: #ffffff;
        transition: all 0.2s ease-in-out;
    }
    .form-control-premium:focus {
        border-color: #E53935;
        box-shadow: 0 0 0 4px rgba(229, 57, 53, 0.08);
        outline: none;
    }
    .form-control-premium::placeholder {
        color: #A5B4CB;
    }

    /* Custom Avatar Upload Circle */
    .avatar-upload-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
    }
    .avatar-preview-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        position: relative;
        border: 4px solid #ffffff;
        box-shadow: 0 8px 24px rgba(7, 21, 48, 0.08);
        overflow: hidden;
        margin-bottom: 15px;
        background-color: #F8FAFC;
    }
    .avatar-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .avatar-upload-trigger {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(7, 21, 48, 0.65);
        color: #ffffff;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .avatar-upload-trigger:hover {
        background-color: rgba(229, 57, 53, 0.85);
    }
    
    /* Submit Buttons */
    .btn-profile-save {
        height: 48px;
        background-color: #0B1F4D;
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        border-radius: 10px;
        border: none;
        transition: all 0.2s;
    }
    .btn-profile-save:hover {
        background-color: #E53935;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(229, 57, 53, 0.15);
    }
    .btn-profile-password {
        height: 48px;
        background-color: transparent;
        border: 1.5px solid #0B1F4D;
        color: #0B1F4D;
        font-weight: 700;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .btn-profile-password:hover {
        background-color: #0B1F4D;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* Page structure styling */
    .page-title-text {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 24px;
        color: #071530;
    }
    .breadcrumb-item a {
        color: #5A6A85;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb-item a:hover {
        color: #E53935;
    }
    .breadcrumb-item.active {
        color: #E53935;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-2">

    {{-- ================= HEADER & BREADCRUMBS ================= --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="page-title-text mb-0">Profile Settings</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('users.dashboard') }}" class="d-flex align-items-center">
                        <i class="bi bi-house-door-fill me-1.5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>

    {{-- ================= FLASH MESSAGES ================= --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-12 p-3 mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-12 p-3 mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div class="fw-semibold">{{ session('error') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-12 p-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-exclamation-octagon-fill fs-5"></i>
                <div class="fw-bold">Please correct the following errors:</div>
            </div>
            <ul class="mb-0 ps-4 small">
                @foreach ($errors->all() as $error)
                    <li class="fw-semibold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= FORMS GRID ================= --}}
    <div class="row g-4">
        
        <!-- Left Side: Profile Details form -->
        <div class="col-lg-7">
            <div class="profile-card">
                <h4 class="profile-card-title">
                    <i class="bi bi-person-bounding-box"></i> Personal Details
                </h4>

                <form method="POST" action="{{ route('users.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Avatar Upload -->
                    <div class="avatar-upload-box">
                        <div class="avatar-preview-wrapper">
                             @php
                                 $avatarPlaceholder = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" fill="%23eff3f9"/><circle cx="50" cy="40" r="20" fill="%2364748b"/><path d="M15,82 C15,65 30,55 50,55 C70,55 85,65 85,82" fill="%2364748b"/></svg>';
                                 $userAvatar = $user->image ? asset('storage/' . $user->image) : $avatarPlaceholder;
                             @endphp
                             <img src="{{ $userAvatar }}" class="avatar-preview-img" id="profile-avatar-preview" alt="Avatar" onerror="this.src='{{ $avatarPlaceholder }}'">
                            <label for="image-upload-input" class="avatar-upload-trigger">
                                <i class="bi bi-camera-fill me-1"></i> Edit
                            </label>
                        </div>
                        <input type="file" name="image" id="image-upload-input" class="d-none" accept="image/png, image/jpeg, image/jpg">
                        <div class="text-muted small">JPG, JPEG or PNG. Max size 2MB.</div>
                    </div>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-premium w-100" value="{{ old('name', $user->name) }}" required placeholder="Enter your full name">
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control form-control-premium w-100" value="{{ old('email', $user->email) }}" required placeholder="Enter your email address">
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-premium w-100" value="{{ old('phone', $user->phone) }}" placeholder="e.g. +91 98765 43210">
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-profile-save">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Right Side: Change Password form -->
        <div class="col-lg-5">
            <div class="profile-card">
                <h4 class="profile-card-title">
                    <i class="bi bi-shield-lock-fill"></i> Security & Password
                </h4>

                <form method="POST" action="{{ route('users.profile.password') }}">
                    @csrf

                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control form-control-premium w-100" required placeholder="••••••••">
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-premium w-100" required placeholder="Minimum 8 characters">
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-premium w-100" required placeholder="Re-enter new password">
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-profile-password">Update Password</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Image upload preview handler
        $('#image-upload-input').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    $('#profile-avatar-preview').attr('src', evt.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
