<!DOCTYPE html>

<html lang="zxx">

<head>

  <!-- Meta -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->

  <link rel="stylesheet" href="{{ asset('admin/css/idebar-menu.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/prism.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/jsvectormap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

  <!-- Favicon -->

  <link rel="icon" type="image/png" href="{{ asset('storage/'.setting('favicon')) }}">

  <!-- Title -->

  <title>Forgot Password - {{ setting('site_name') }}</title>

</head>

<body class="bg-body-bg">

  <!-- Preloader -->

  <div class="preloader" id="preloader">
    <div class="preloader">
      <div class="waviy position-relative">
        <span class="d-inline-block">F</span>
        <span class="d-inline-block">I</span>
        <span class="d-inline-block">L</span>
        <span class="d-inline-block">A</span>
      </div>
    </div>
  </div>

  <!-- Main Container -->

  <div class="container-fluid">
    <div class="main-content d-flex flex-column p-0">

```
  <div class="m-lg-auto my-auto w-930 py-4">

    <div class="card bg-white border rounded-10 border-white py-100 px-130">

      <div class="p-md-5 p-4 p-lg-0">

        <!-- Heading -->
        <div class="text-center mb-4">
          <h3 class="fs-26 fw-medium" style="margin-bottom: 6px;">
            Forgot Password
          </h3>

          <p class="fs-16 text-secondary lh-1-8">
            Enter your email address and we will send you a password reset link.
          </p>
        </div>

        <!-- Success Message -->
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <!-- Form -->
        <form class="login-register text-start mt-20"
              action="{{ route('password.email') }}"
              method="POST">

          @csrf

          <!-- Email -->
          <div class="form-group mb-3">
            <label class="form-label">Email address *</label>

            <input class="form-control"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="email@example.com"
                   required>

            @error('email')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Button -->
          <div class="mb-4 mt-3">
            <button type="submit"
                    class="btn btn-primary fw-normal text-white w-100"
                    style="padding-top: 18px; padding-bottom: 18px;">
              Send Password Reset Link
            </button>
          </div>

          <!-- Back to Login -->
          <div class="text-center">
            <a href="{{ route('login') }}"
               class="fs-16 text-primary fw-normal text-decoration-none">
               Back to Login
            </a>
          </div>

        </form>

      </div>

    </div>

  </div>

</div>
```

  </div>

  <!-- JS -->

  <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('admin/js/sidebar-menu.js') }}"></script>

  <script src="{{ asset('admin/js/quill.min.js') }}"></script>

  <script src="{{ asset('admin/js/prism.js') }}"></script>

  <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>

  <script src="{{ asset('admin/js/swiper-bundle.min.js') }}"></script>

  <script src="{{ asset('admin/js/custom/custom.js') }}"></script>

</body>

</html>
