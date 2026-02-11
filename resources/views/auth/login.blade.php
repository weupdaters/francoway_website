<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Links Of CSS File -->
  <link rel="stylesheet" href="{{ asset('admin/css/idebar-menu.css') }}   ">
  <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}   ">
  <link rel="stylesheet" href="{{ asset('admin/css/prism.css') }}   ">
  <link rel="stylesheet" href="{{ asset('admin/css/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/jsvectormap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('admin/images/favicon.png') }}  ">

  <!-- Title -->
  <title>Login - {{ config('app.name') }}</title>
</head>

<body class="bg-body-bg">

  <!-- Start Preloader Area -->
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
  <!-- End Preloader Area -->

  <div class="container-fluid">
    <div class="main-content d-flex flex-column p-0">
      <div class="m-lg-auto my-auto w-930 py-4">
        <div class="card bg-white border rounded-10 border-white py-100 px-130">
          <div class="p-md-5 p-4 p-lg-0">
            <div class="text-center mb-4">
              <h3 class="fs-26 fw-medium" style="margin-bottom: 6px;">Sign In</h3>
              <p class="fs-16 text-secondary lh-1-8">Don’t have an account yet? <a href="{{ route('auth.register') }}"
                  class="text-primary text-decoration-none">Sign Up</a></p>
            </div>

            <form class="login-register text-start mt-20" action="{{ route('login.submit') }}" method="POST">
              @csrf
              {{-- Email --}}
              <div class="form-group">
                <label class="form-label">Email address *</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                  placeholder="email@example.com" required>

                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              {{-- Password --}}
              <div class="form-group">
                <label class="form-label">Password *</label>
                <input class="form-control" type="password" name="password" placeholder="Enter password *" required>

                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-20">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label fs-16" for="flexCheckDefault">
                      Remember me
                    </label>
                  </div>
                  <a href="forgot-password.html" class="fs-16 text-primary fw-normal text-decoration-none">Forgot
                    Password?</a>
                </div>
              </div>

              <div class="mb-4">
                <button type="submit" class="btn btn-primary fw-normal text-white w-100"
                  style="padding-top: 18px; padding-bottom: 18px;">Sign In</button>
              </div>



            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Link Of JS File -->
  <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/js/sidebar-menu.js') }}"></script>
  <script src="{{ asset('admin/js/quill.min.js') }}"></script>
  <script src="{{ asset('admin/js/data-table.js') }}"></script>
  <script src="{{ asset('admin/js/prism.js') }}"></script>
  <script src="{{ asset('admin/js/clipboard.min.js') }}"></script>
  <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/js/echarts.min.js') }}"></script>
  <script src="{{ asset('admin/js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('admin/js/fullcalendar.main.js') }}"></script>
  <script src="{{ asset('admin/js/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('admin/js/world-merc.js') }}"></script>
  <script src="{{ asset('admin/js/custom/apexcharts.js') }}"></script>
  <script src="{{ asset('admin/js/custom/echarts.js') }}"></script>
  <script src="{{ asset('admin/js/custom/maps.js') }}"></script>
  <script src="{{ asset('admin/js/custom/custom.js') }}"></script>
</body>

</html>
