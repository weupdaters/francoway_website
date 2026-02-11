@extends('admin.layouts.app')

@section('title', 'Website Settings')

@section('content')

<div class="page-header mb-20">
  <h3 class="page-title">Website Settings</h3>
</div>

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">

  {{-- LEFT --}}
  <div class="col-lg-8">

    {{-- GENERAL --}}
    <div class="card mb-20">
      <div class="card-header">
        <h5 class="mb-0">General</h5>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label>Site Name</label>
          <input type="text" name="site_name" class="form-control"
            value="{{ old('site_name', $settings['site_name'] ?? '') }}">
        </div>

        <div class="form-group">
          <label>Tagline</label>
          <input type="text" name="site_tagline" class="form-control"
            value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="site_email" class="form-control"
                value="{{ old('site_email', $settings['site_email'] ?? '') }}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="site_phone" class="form-control"
                value="{{ old('site_phone', $settings['site_phone'] ?? '') }}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Address</label>
          <textarea name="address" class="form-control" rows="3">{{ old('address', $settings['address'] ?? '') }}</textarea>
        </div>

        <div class="form-group">
          <label>Footer Text</label>
          <textarea name="footer_text" class="form-control" rows="2">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>
        </div>

      </div>
    </div>

    {{-- SEO --}}
    <div class="card mb-20">
      <div class="card-header">
        <h5 class="mb-0">SEO & Meta</h5>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label>Meta Title</label>
          <input type="text" name="meta_title" class="form-control"
            value="{{ old('meta_title', $settings['meta_title'] ?? '') }}">
        </div>

        <div class="form-group">
          <label>Meta Description</label>
          <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
        </div>

      </div>
    </div>

    {{-- OTHER --}}
    <div class="card mb-20">
      <div class="card-header">
        <h5 class="mb-0">Other</h5>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <label>Items Per Page</label>
            <input type="number" name="items_per_page" class="form-control"
              value="{{ old('items_per_page', $settings['items_per_page'] ?? 10) }}">
          </div>

          <div class="col-md-6">
            <label>Timezone</label>
            <input type="text" name="timezone" class="form-control"
              value="{{ old('timezone', $settings['timezone'] ?? config('app.timezone')) }}">
          </div>
        </div>

        <div class="form-check mt-3">
          <input type="checkbox" class="form-check-input" id="maintenance_mode"
            name="maintenance_mode" value="1"
            {{ ($settings['maintenance_mode'] ?? 0) == 1 ? 'checked' : '' }}>
          <label class="form-check-label" for="maintenance_mode">
            Maintenance Mode
          </label>
        </div>

      </div>
    </div>

  </div>

  {{-- RIGHT --}}
  <div class="col-lg-4">

    <div class="card mb-20 text-center">
      <div class="card-header">Logo</div>
      <div class="card-body">
        <img id="logoPreview"
          src="{{ isset($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('frontend/imgs/template/logo.svg') }}"
          class="img-fluid mb-2" style="max-height:120px">
        <input type="file" name="logo" onchange="previewImage(event,'logoPreview')">
      </div>
    </div>

    <div class="card mb-20 text-center">
      <div class="card-header">Favicon</div>
      <div class="card-body">
        <img id="faviconPreview"
          src="{{ isset($settings['favicon']) ? asset('storage/'.$settings['favicon']) : asset('frontend/imgs/template/favicon.ico') }}"
          style="max-height:60px" class="mb-2">
        <input type="file" name="favicon" onchange="previewImage(event,'faviconPreview')">
      </div>
    </div>

    <div class="card mb-20">
      <div class="card-header">Social Links</div>
      <div class="card-body">
        <input type="url" name="facebook" class="form-control mb-2" placeholder="Facebook"
          value="{{ $settings['facebook'] ?? '' }}">
        <input type="url" name="twitter" class="form-control mb-2" placeholder="Twitter"
          value="{{ $settings['twitter'] ?? '' }}">
        <input type="url" name="instagram" class="form-control mb-2" placeholder="Instagram"
          value="{{ $settings['instagram'] ?? '' }}">
        <input type="url" name="linkedin" class="form-control"
          placeholder="LinkedIn"
          value="{{ $settings['linkedin'] ?? '' }}">
      </div>
    </div>

    <button class="btn btn-primary w-100">Save Settings</button>

  </div>

</div>
</form>

@endsection

@push('scripts')
<script>
function previewImage(e, id) {
  const reader = new FileReader();
  reader.onload = () => document.getElementById(id).src = reader.result;
  reader.readAsDataURL(e.target.files[0]);
}
</script>
@endpush
