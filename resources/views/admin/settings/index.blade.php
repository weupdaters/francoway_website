@extends('admin.layouts.app')

@section('title', 'Website Settings | Admin Panel')

@push('styles')
<style>
    :root {
        --primary-navy: #071530;
        --accent-red: #E53935;
        --border-color: #EAEAEA;
        --soft-bg: #fafafa;
    }

    .settings-container {
        font-family: 'Outfit', sans-serif;
        padding-top: 10px;
    }

    /* Page Header */
    .settings-page-header {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px 30px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .settings-page-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .settings-page-title i {
        color: var(--accent-red);
        font-size: 24px;
    }

    /* Card Styling */
    .settings-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        margin-bottom: 25px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .settings-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(7, 21, 48, 0.04);
    }

    .settings-card-header {
        background-color: var(--soft-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 18px 24px;
    }

    .settings-card-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--primary-navy);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .settings-card-title i {
        color: var(--accent-red);
        font-size: 18px;
    }

    .settings-card-body {
        padding: 24px;
    }

    /* Form Elements Styling */
    .premium-form-label {
        font-size: 13px;
        font-weight: 800;
        color: var(--primary-navy);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }

    .premium-input {
        height: 48px;
        border-radius: 12px;
        border: 1.5px solid var(--border-color);
        padding: 0 18px;
        font-size: 15px;
        font-weight: 500;
        color: var(--primary-navy);
        background-color: var(--soft-bg);
        transition: all 0.2s ease;
    }

    .premium-input:focus {
        background-color: #ffffff;
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 4px rgba(7, 21, 48, 0.04);
        outline: none;
    }

    .premium-textarea {
        border-radius: 12px;
        border: 1.5px solid var(--border-color);
        padding: 14px 18px;
        font-size: 15px;
        font-weight: 500;
        color: var(--primary-navy);
        background-color: var(--soft-bg);
        transition: all 0.2s ease;
        resize: none;
    }

    .premium-textarea:focus {
        background-color: #ffffff;
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 4px rgba(7, 21, 48, 0.04);
        outline: none;
    }

    /* Custom File Input Container */
    .media-upload-wrapper {
        border: 2px dashed var(--border-color);
        border-radius: 16px;
        padding: 20px;
        background-color: var(--soft-bg);
        text-align: center;
        position: relative;
        transition: all 0.2s ease;
    }

    .media-upload-wrapper:hover {
        background-color: #f7fafc;
        border-color: var(--primary-navy);
    }

    .preview-box {
        background: #ffffff;
        border-radius: 12px;
        padding: 12px;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(7, 21, 48, 0.05);
        border: 1px solid var(--border-color);
    }

    .custom-file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .upload-btn-premium {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: var(--primary-navy);
        color: #ffffff;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 8px;
        margin-top: 10px;
        border: none;
        cursor: pointer;
    }

    /* Button Action */
    .btn-save-settings {
        height: 50px;
        border-radius: 12px;
        background-color: var(--primary-navy);
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        width: 100%;
        border: none;
        box-shadow: 0 4px 14px rgba(7, 21, 48, 0.15);
        transition: all 0.2s ease;
    }

    .btn-save-settings:hover {
        background-color: var(--accent-red);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(229, 57, 53, 0.25);
    }

    .social-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .social-icon-box {
        position: absolute;
        left: 15px;
        font-size: 18px;
        color: #718096;
    }

    .social-input {
        padding-left: 45px !important;
    }
</style>
@endpush

@section('content')
<div class="container settings-container">
    
    {{-- Page Header --}}
    <div class="settings-page-header">
        <h2 class="settings-page-title">
            <i class="ri-settings-4-fill"></i> Website Settings
        </h2>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-12 p-3 mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            {{-- LEFT SECTION --}}
            <div class="col-lg-8">

                {{-- GENERAL SETTINGS --}}
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h5 class="settings-card-title">
                            <i class="ri-information-fill"></i> General Configuration
                        </h5>
                    </div>
                    <div class="settings-card-body d-flex flex-column gap-3">
                        
                        <div class="d-flex flex-column">
                            <label class="premium-form-label">Site Name</label>
                            <input type="text" name="site_name" class="form-control premium-input"
                                value="{{ old('site_name', $settings['site_name'] ?? '') }}" placeholder="Enter Site Name" required>
                        </div>

                        <div class="d-flex flex-column">
                            <label class="premium-form-label">Tagline</label>
                            <input type="text" name="site_tagline" class="form-control premium-input"
                                value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" placeholder="Enter Tagline/Slogan">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Contact Email</label>
                                <input type="email" name="site_email" class="form-control premium-input"
                                    value="{{ old('site_email', $settings['site_email'] ?? '') }}" placeholder="e.g. contact@domain.com" required>
                            </div>

                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Phone Number</label>
                                <input type="text" name="site_phone" class="form-control premium-input"
                                    value="{{ old('site_phone', $settings['site_phone'] ?? '') }}" placeholder="e.g. +1 (437) 870-6742">
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <label class="premium-form-label">Office Address</label>
                            <textarea name="address" class="form-control premium-textarea" rows="3" placeholder="Enter physical office address">{{ old('address', $settings['address'] ?? '') }}</textarea>
                        </div>

                        <div class="d-flex flex-column">
                            <label class="premium-form-label">Footer Copyright Text</label>
                            <textarea name="footer_text" class="form-control premium-textarea" rows="2" placeholder="Copyright © All rights reserved.">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- CHECKOUT SETTINGS --}}
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h5 class="settings-card-title">
                            <i class="ri-secure-payment-line"></i> Checkout & Payment Gateways
                        </h5>
                    </div>
                    <div class="settings-card-body d-flex flex-column gap-3">
                        
                        <div class="row g-3">
                            <!-- Tax row configuration -->
                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Tax / GST Label</label>
                                <input type="text" name="checkout_tax_label" class="form-control premium-input"
                                    value="{{ old('checkout_tax_label', $settings['checkout_tax_label'] ?? 'Taxes / SGST') }}" placeholder="e.g. Taxes / SGST">
                            </div>

                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Tax Rate (%)</label>
                                <input type="number" name="checkout_tax_percent" class="form-control premium-input"
                                    value="{{ old('checkout_tax_percent', $settings['checkout_tax_percent'] ?? '0') }}" min="0" max="100" step="0.01">
                            </div>
                        </div>

                        <!-- Checkbox for Tax Enable -->
                        <div class="form-check form-switch mt-2 mb-3">
                            <input type="checkbox" class="form-check-input" id="checkout_tax_enabled"
                                name="checkout_tax_enabled" value="1" style="width: 45px; height: 22px; cursor: pointer;"
                                {{ ($settings['checkout_tax_enabled'] ?? 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label ms-2 fw-semibold text-dark" for="checkout_tax_enabled" style="cursor: pointer; margin-top: 2px;">
                                Enable Tax / SGST Calculation Row
                            </label>
                        </div>

                        <hr class="my-2" style="border-color: var(--border-color);">

                        <h6 class="fw-bold text-dark mb-2" style="font-size: 13.5px;">Active Payment Methods</h6>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="checkout_pay_upi_enabled"
                                        name="checkout_pay_upi_enabled" value="1" style="width: 40px; height: 20px; cursor: pointer;"
                                        {{ ($settings['checkout_pay_upi_enabled'] ?? 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 fw-semibold text-dark" for="checkout_pay_upi_enabled" style="cursor: pointer; font-size: 13px;">
                                        UPI / QR
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="checkout_pay_card_enabled"
                                        name="checkout_pay_card_enabled" value="1" style="width: 40px; height: 20px; cursor: pointer;"
                                        {{ ($settings['checkout_pay_card_enabled'] ?? 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 fw-semibold text-dark" for="checkout_pay_card_enabled" style="cursor: pointer; font-size: 13px;">
                                        Credit/Debit Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="checkout_pay_netbanking_enabled"
                                        name="checkout_pay_netbanking_enabled" value="1" style="width: 40px; height: 20px; cursor: pointer;"
                                        {{ ($settings['checkout_pay_netbanking_enabled'] ?? 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 fw-semibold text-dark" for="checkout_pay_netbanking_enabled" style="cursor: pointer; font-size: 13px;">
                                        Net Banking
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Merchant UPI Address</label>
                                <input type="text" name="checkout_upi_id" class="form-control premium-input"
                                    value="{{ old('checkout_upi_id', $settings['checkout_upi_id'] ?? 'francoway@ybl') }}" placeholder="e.g. merchant@ybl">
                            </div>
                            <div class="col-md-6 d-flex flex-column justify-content-end">
                                <div class="form-check form-switch mb-2">
                                    <input type="checkbox" class="form-check-input" id="checkout_upi_qr_enabled"
                                        name="checkout_upi_qr_enabled" value="1" style="width: 45px; height: 22px; cursor: pointer;"
                                        {{ ($settings['checkout_upi_qr_enabled'] ?? 1) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 fw-semibold text-dark" for="checkout_upi_qr_enabled" style="cursor: pointer; margin-top: 2px; font-size: 13px;">
                                        Show QR Code for Scan & Pay
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- SEO SETTINGS --}}
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h5 class="settings-card-title">
                            <i class="ri-search-eye-line"></i> SEO & Metadata
                        </h5>
                    </div>
                    <div class="settings-card-body d-flex flex-column gap-3">

                        <div class="d-flex flex-column">
                            <label class="premium-form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control premium-input"
                                value="{{ old('meta_title', $settings['meta_title'] ?? '') }}" placeholder="Primary SEO Title for Google">
                        </div>

                        <div class="d-flex flex-column">
                            <label class="premium-form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control premium-textarea" rows="3" placeholder="Short description of the website for search snippets (under 160 characters)">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- SYSTEM CONFIGURATION --}}
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h5 class="settings-card-title">
                            <i class="ri-cpu-line"></i> System Settings
                        </h5>
                    </div>
                    <div class="settings-card-body">
                        
                        <div class="row g-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Items Per Page</label>
                                <input type="number" name="items_per_page" class="form-control premium-input"
                                    value="{{ old('items_per_page', $settings['items_per_page'] ?? 10) }}" min="1">
                            </div>

                            <div class="col-md-6 d-flex flex-column">
                                <label class="premium-form-label">Timezone</label>
                                <input type="text" name="timezone" class="form-control premium-input"
                                    value="{{ old('timezone', $settings['timezone'] ?? config('app.timezone')) }}" placeholder="e.g. UTC, Asia/Kolkata">
                            </div>
                        </div>

                        <div class="form-check form-switch mt-4">
                            <input type="checkbox" class="form-check-input" id="maintenance_mode"
                                name="maintenance_mode" value="1" style="width: 45px; height: 22px; cursor: pointer;"
                                {{ ($settings['maintenance_mode'] ?? 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label ms-2 fw-semibold text-dark" for="maintenance_mode" style="cursor: pointer; margin-top: 2px;">
                                Enable Maintenance Mode (Blocks public access)
                            </label>
                        </div>

                    </div>
                </div>

            </div>

            {{-- RIGHT SECTION --}}
            <div class="col-lg-4 d-flex flex-column gap-4">

                {{-- LOGO UPLOAD --}}
                <div class="settings-card">
                    <div class="settings-card-header text-center">
                        <h5 class="settings-card-title justify-content-center">
                            <i class="ri-image-2-fill"></i> Website Logo
                        </h5>
                    </div>
                    <div class="settings-card-body text-center d-flex flex-column align-items-center gap-3">
                        <div class="preview-box">
                            <img id="logoPreview"
                                src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/'.$settings['logo']) : asset('admin/images/logo.png') }}"
                                class="img-fluid" style="max-height: 80px; object-fit: contain;">
                        </div>
                        <div class="media-upload-wrapper w-100">
                            <input type="file" name="logo" class="custom-file-input" onchange="previewImage(event,'logoPreview')">
                            <i class="ri-upload-cloud-2-line fs-2 d-block text-muted mb-1"></i>
                            <span class="d-block small text-muted">Drag or click to upload Logo</span>
                            <span class="upload-btn-premium"><i class="ri-image-add-line"></i> Choose Logo</span>
                        </div>
                    </div>
                </div>

                {{-- FAVICON UPLOAD --}}
                <div class="settings-card">
                    <div class="settings-card-header text-center">
                        <h5 class="settings-card-title justify-content-center">
                            <i class="ri-shield-user-fill"></i> Website Favicon
                        </h5>
                    </div>
                    <div class="settings-card-body text-center d-flex flex-column align-items-center gap-3">
                        <div class="preview-box">
                            <img id="faviconPreview"
                                src="{{ isset($settings['favicon']) && $settings['favicon'] ? asset('storage/'.$settings['favicon']) : asset('frontend/imgs/template/favicon.ico') }}"
                                style="max-height: 40px; width: 40px; object-fit: contain;">
                        </div>
                        <div class="media-upload-wrapper w-100">
                            <input type="file" name="favicon" class="custom-file-input" onchange="previewImage(event,'faviconPreview')">
                            <i class="ri-upload-cloud-2-line fs-2 d-block text-muted mb-1"></i>
                            <span class="d-block small text-muted">Drag or click to upload Favicon</span>
                            <span class="upload-btn-premium"><i class="ri-image-add-line"></i> Choose Favicon</span>
                        </div>
                    </div>
                </div>

                {{-- SOCIAL LINKS --}}
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h5 class="settings-card-title">
                            <i class="ri-share-fill"></i> Social Links
                        </h5>
                    </div>
                    <div class="settings-card-body d-flex flex-column gap-3">
                        
                        <div class="social-input-wrapper">
                            <span class="social-icon-box"><i class="ri-facebook-box-fill text-primary"></i></span>
                            <input type="url" name="facebook" class="form-control premium-input social-input w-100" placeholder="Facebook URL"
                                value="{{ $settings['facebook'] ?? '' }}">
                        </div>

                        <div class="social-input-wrapper">
                            <span class="social-icon-box"><i class="ri-twitter-x-fill text-dark"></i></span>
                            <input type="url" name="twitter" class="form-control premium-input social-input w-100" placeholder="Twitter URL"
                                value="{{ $settings['twitter'] ?? '' }}">
                        </div>

                        <div class="social-input-wrapper">
                            <span class="social-icon-box"><i class="ri-instagram-fill text-danger"></i></span>
                            <input type="url" name="instagram" class="form-control premium-input social-input w-100" placeholder="Instagram URL"
                                value="{{ $settings['instagram'] ?? '' }}">
                        </div>

                        <div class="social-input-wrapper">
                            <span class="social-icon-box"><i class="ri-linkedin-box-fill text-primary"></i></span>
                            <input type="url" name="linkedin" class="form-control premium-input social-input w-100" placeholder="LinkedIn URL"
                                value="{{ $settings['linkedin'] ?? '' }}">
                        </div>

                    </div>
                </div>

                {{-- SAVE ACTION --}}
                <button type="submit" class="btn-save-settings">
                    <i class="ri-save-fill me-1"></i> Save Configuration
                </button>

            </div>

        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
function previewImage(e, id) {
  if (e.target.files && e.target.files[0]) {
    const reader = new FileReader();
    reader.onload = () => {
        document.getElementById(id).src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
  }
}
</script>
@endpush
