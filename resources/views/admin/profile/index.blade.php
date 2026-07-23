@extends('admin.layouts.app')

{{-- Page Title --}}
@section('title', $user->name . ' | Profile Settings')

{{-- SEO Meta --}}
@section('meta_description', $user->bio ?? 'User profile page')
@section('meta_keywords', 'profile, user, admin, dashboard, settings')
@section('meta_author', $user->name)

@push('styles')
<style>
    :root {
        --primary-navy: #071530;
        --accent-red: #E53935;
        --border-color: #EAEAEA;
    }

    .profile-container {
        font-family: 'Outfit', sans-serif;
        padding-top: 10px;
    }

    /* Left Card Styling */
    .premium-profile-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .premium-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(7, 21, 48, 0.05);
    }

    .card-banner-header {
        height: 100px;
        background: linear-gradient(135deg, var(--primary-navy) 0%, #1a365d 100%);
        position: relative;
    }

    .avatar-wrapper {
        position: relative;
        margin-top: -60px;
        display: inline-block;
    }

    .avatar-img-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #ffffff;
        object-fit: cover;
        box-shadow: 0 8px 24px rgba(7, 21, 48, 0.15);
        background-color: #f7fafc;
    }

    .role-badge-premium {
        background-color: var(--accent-red);
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(229, 57, 53, 0.2);
    }

    .completion-title {
        font-size: 13px;
        font-weight: 700;
        color: #718096;
    }

    .progress-track-premium {
        height: 8px;
        border-radius: 10px;
        background-color: #edf2f7;
        overflow: hidden;
    }

    .progress-fill-premium {
        height: 100%;
        border-radius: 10px;
        background: linear-gradient(90deg, #48bb78 0%, #38a169 100%);
        box-shadow: 0 2px 6px rgba(56, 161, 105, 0.2);
    }

    /* Right Section Card Styling */
    .premium-content-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        overflow: hidden;
    }

    .tab-nav-premium {
        border-bottom: 1px solid var(--border-color);
        background-color: #f7fafc;
        padding: 0 20px;
        display: flex;
        gap: 10px;
    }

    .tab-link-premium {
        padding: 18px 20px;
        font-weight: 700;
        font-size: 14.5px;
        color: #718096;
        text-decoration: none;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
    }

    .tab-link-premium:hover {
        color: var(--primary-navy);
    }

    .tab-link-premium.active {
        color: var(--primary-navy);
        border-bottom-color: var(--accent-red);
    }

    /* Form Inputs Styling */
    .premium-form-label {
        font-size: 13px;
        font-weight: 800;
        color: var(--primary-navy);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .premium-input-field {
        height: 48px;
        border-radius: 12px;
        border: 1.5px solid var(--border-color);
        padding: 0 18px;
        font-size: 15px;
        font-weight: 500;
        color: var(--primary-navy);
        background-color: #fafafa;
        transition: all 0.2s ease;
    }

    .premium-input-field:focus {
        background-color: #ffffff;
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 4px rgba(7, 21, 48, 0.04);
        outline: none;
    }

    .premium-textarea-field {
        border-radius: 12px;
        border: 1.5px solid var(--border-color);
        padding: 14px 18px;
        font-size: 15px;
        font-weight: 500;
        color: var(--primary-navy);
        background-color: #fafafa;
        transition: all 0.2s ease;
        resize: none;
    }

    .premium-textarea-field:focus {
        background-color: #ffffff;
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 4px rgba(7, 21, 48, 0.04);
        outline: none;
    }

    .premium-file-input-wrapper {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 16px;
        background-color: #fafafa;
        transition: all 0.2s ease;
        position: relative;
    }

    .premium-file-input-wrapper:hover {
        background-color: #f7fafc;
        border-color: var(--primary-navy);
    }

    /* Buttons Styling */
    .premium-btn-save {
        height: 46px;
        border-radius: 12px;
        background-color: var(--primary-navy);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        padding: 0 28px;
        border: none;
        box-shadow: 0 4px 14px rgba(7, 21, 48, 0.15);
        transition: all 0.2s ease;
    }

    .premium-btn-save:hover {
        background-color: var(--accent-red);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(229, 57, 53, 0.25);
    }

    .premium-btn-warning {
        height: 46px;
        border-radius: 12px;
        background-color: var(--accent-red);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        padding: 0 28px;
        border: none;
        box-shadow: 0 4px 14px rgba(229, 57, 53, 0.15);
        transition: all 0.2s ease;
    }

    .premium-btn-warning:hover {
        background-color: var(--primary-navy);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(7, 21, 48, 0.25);
    }
</style>
@endpush

@section('content')
@php
    $fields = [$user->name, $user->email, $user->phone, $user->bio, $user->image];
    $filled = collect($fields)->filter()->count();
    $percent = round(($filled / count($fields)) * 100);
@endphp

<div class="container profile-container">
    <div class="row g-4">

        <!-- LEFT PROFILE CARD -->
        <div class="col-lg-4">
            <div class="premium-profile-card">
                <div class="card-banner-header"></div>
                <div class="card-body text-center pt-0 pb-4 px-4">
                    
                    <div class="avatar-wrapper mb-3">
                        <img id="previewImage"
                             src="{{ $user->image ? asset('storage/'.$user->image) : asset('admin/images/user1.jpg') }}"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF&size=120';"
                             class="avatar-img-circle"
                             alt="Avatar">
                    </div>

                    <h4 class="fw-bold mb-1" style="color: var(--primary-navy);">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                    <div class="mb-4">
                        <span class="role-badge-premium">
                            {{ $user->role ?? 'admin' }}
                        </span>
                    </div>

                    <div class="border-top pt-3 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="completion-title">Profile Completion</span>
                            <span class="fw-bold text-success completion-title">{{ $percent }}%</span>
                        </div>
                        <div class="progress-track-premium">
                            <div class="progress-fill-premium" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT SECTION (EDIT FIELDS) -->
        <div class="col-lg-8">
            <div class="premium-content-card">
                
                {{-- Navigation Tabs --}}
                <div class="tab-nav-premium">
                    <a class="tab-link-premium active" id="profile-tab-btn" href="javascript:void(0)" onclick="switchTab('profile')">
                        <i class="bi bi-person-fill me-1"></i> Edit Profile
                    </a>
                    <a class="tab-link-premium" id="password-tab-btn" href="javascript:void(0)" onclick="switchTab('password')">
                        <i class="bi bi-shield-lock-fill me-1"></i> Change Password
                    </a>
                </div>

                <div class="card-body p-4">

                    {{-- Notifications --}}
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-12 p-3 mb-4 d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div class="fw-semibold">{{ session('success') }}</div>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-12 p-3 mb-4 d-flex align-items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                            <div class="fw-semibold">{{ session('error') }}</div>
                        </div>
                    @endif

                    <!-- EDIT PROFILE FORM -->
                    <div id="profileTabSection">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6 d-flex flex-column">
                                    <label class="premium-form-label">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-control premium-input-field" placeholder="Full name">
                                </div>

                                <div class="col-md-6 d-flex flex-column">
                                    <label class="premium-form-label">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control premium-input-field" placeholder="Email address">
                                </div>

                                <div class="col-md-12 d-flex flex-column">
                                    <label class="premium-form-label">Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control premium-input-field" placeholder="Phone number">
                                </div>

                                <div class="col-md-12 d-flex flex-column">
                                    <label class="premium-form-label">Bio</label>
                                    <textarea name="bio" rows="4" class="form-control premium-textarea-field" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                </div>

                                <div class="col-md-12 d-flex flex-column">
                                    <label class="premium-form-label">Profile Image</label>
                                    <div class="premium-file-input-wrapper">
                                        <input type="file" name="image" id="profile-image-input" class="form-control bg-transparent border-0 p-0" accept="image/png, image/jpeg, image/jpg">
                                        <div class="text-muted small mt-1">Recommended: Square format (JPG, PNG). Max 2MB.</div>
                                    </div>
                                </div>

                                <div class="col-md-12 pt-2">
                                    <button type="submit" class="premium-btn-save">
                                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- CHANGE PASSWORD FORM -->
                    <div id="passwordTabSection" style="display: none;">
                        <form action="{{ route('admin.profile.password') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-12 d-flex flex-column">
                                    <label class="premium-form-label">Current Password</label>
                                    <input type="password" name="current_password" required class="form-control premium-input-field" placeholder="Enter current password">
                                </div>

                                <div class="col-md-6 d-flex flex-column">
                                    <label class="premium-form-label">New Password</label>
                                    <input type="password" name="password" required class="form-control premium-input-field" placeholder="Min 8 characters">
                                </div>

                                <div class="col-md-6 d-flex flex-column">
                                    <label class="premium-form-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" required class="form-control premium-input-field" placeholder="Re-enter new password">
                                </div>

                                <div class="col-md-12 pt-2">
                                    <button type="submit" class="premium-btn-warning">
                                        <i class="bi bi-shield-lock-fill me-1"></i> Update Password
                                    </button>
                                </div>
                            </div>
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
    // Live image preview
    document.getElementById('profile-image-input').addEventListener('change', function(e){
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = () => {
                document.getElementById('previewImage').src = reader.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Custom tab switcher to prevent tab layout distortion
    function switchTab(tab) {
        const profileBtn = document.getElementById('profile-tab-btn');
        const passwordBtn = document.getElementById('password-tab-btn');
        const profileSection = document.getElementById('profileTabSection');
        const passwordSection = document.getElementById('passwordTabSection');

        if (tab === 'profile') {
            profileBtn.classList.add('active');
            passwordBtn.classList.remove('active');
            profileSection.style.display = 'block';
            passwordSection.style.display = 'none';
        } else {
            profileBtn.classList.remove('active');
            passwordBtn.classList.add('active');
            profileSection.style.display = 'none';
            passwordSection.style.display = 'block';
        }
    }
</script>
@endpush
