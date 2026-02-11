<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Links Of CSS File -->
  <link rel="stylesheet" href="{{ asset('admin/css/sidebar-menu.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/prism.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/jsvectormap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('admin/images/favicon.png') }}">

  <!-- Title -->
  <title>Fila - Bootstrap 5 Admin Dashboard Template</title>
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
              <h3 class="fs-26 fw-medium" style="margin-bottom: 6px;">Sign Up</h3>
              <p class="fs-16 text-secondary lh-1-8">Don’t have an account yet? <a href="{{ route('auth.login') }}"
                  class="text-primary text-decoration-none">Sign In</a></p>
            </div>

            <form action="{{ route('auth.register') }}" method="POST">
              @csrf

              <div class="form-group mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              {{-- Phone Number --}}
              <div class="form-group mb-3">
                <label>Phone (optional)</label>

                <div class="phone-wrapper">
                  <select name="country_code" class="form-select country-code">
                    <option value="+91" selected>🇮🇳 +91</option>
                    <option value="+1">🇺🇸 +1</option>
                    <option value="+44">🇬🇧 +44</option>
                    <option value="+61">🇦🇺 +61</option>
                  </select>

                  <input type="tel" name="phone" class="form-control phone-input" placeholder="Phone number"
                    pattern="[0-9]{7,15}">
                </div>
              </div>


              <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <div class="form-group mb-4">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>

              {{-- Account Type --}}
              <div class="account-type-wrapper mb-4">
                <label class="account-card">
                  <input type="radio" name="account_type" value="user" checked>
                  <div class="card-inner">
                    <i class="fi fi-rr-user"></i>
                    <h6>Student</h6>
                    <p>Looking for job opportunities</p>
                  </div>
                </label>

                <label class="account-card">
                  <input type="radio" name="account_type" value="cyber">
                  <div class="card-inner">
                    <i class="fi fi-rr-shop"></i>
                    <h6>Teacher</h6>
                    <p>Online services, forms, printing & digital support</p>
                  </div>
                </label>
              </div>



              {{-- Terms --}}
              <div class="form-group mb-3">
                <label class="terms-checkbox">
                  <input type="checkbox" name="terms" required>
                  <span></span>
                  Agree our <a href="#" target="_blank">terms</a> and
                  <a href="#" target="_blank">policy</a>
                </label>
              </div>

              {{-- Register Button --}}
              <button type="submit" class="btn btn-primary w-100 mb-3">
                Register <i class="fi fi-rr-arrow-small-right ms-1"></i>
              </button>

              {{-- Login link --}}
              <p class="text-center font-sm mb-2">
                Already have an account?
                <a href="{{ route('auth.login') }}" class="text-brand-1 fw-semibold">Sign In</a>
              </p>



            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <button class="switch-toggle dark-btn p-0 bg-transparent lh-0 border-0" id="switch-toggle"></button>

  <!-- Start Theme Setting Area -->
  <button class="btn btn-primary theme-settings-btn p-0 position-fixed z-2 text-center rounded-circle"
    style="bottom: 24px; right: 24px; width: 56px; height: 56px; line-height: 54px;" type="button"
    data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
    <i class="text-white ri-settings-3-fill fs-28" data-bs-toggle="tooltip" data-bs-placement="left"
      data-bs-title="Click On Theme Settings"></i>
  </button>

  <!-- Start Theme Setting Area -->
  <div class="offcanvas offcanvas-end bg-white border-0" data-bs-scroll="true" data-bs-backdrop="true"
    tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel"
    style="box-shadow: 0 4px 20px #2f8fe812 !important; max-width: 300px;">
    <div class="offcanvas-header bg-light p-20">
      <h5 class="offcanvas-title fs-18 fw-medium" id="offcanvasScrollingLabel">Configuration Panel</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 overflow-hidden">
      <div class="last-child-none" style="max-height: 858px;" data-simplebar>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">RTL Mode</h4>
          <div class="rtl-btn">
            <label id="switch">
              <input type="checkbox" onchange="toggleTheme()" class="toggle-switch rtl-switch" id="slider">
            </label>
          </div>
        </div>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">Only Sidebar Dark</h4>
          <div class="sidebar-light-dark" id="sidebar-light-dark">
            <input type="checkbox" class="toggle-switch sidebar-dark-switch">
          </div>
        </div>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">Only Header Dark</h4>
          <div class="header-light-dark" id="header-light-dark">
            <input type="checkbox" class="toggle-switch header-dark-switch">
          </div>
        </div>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">Right Sidebar</h4>
          <div class="right-sidebar" id="right-sidebar">
            <input type="checkbox" class="toggle-switch right-sidebar-switch">
          </div>
        </div>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">Hide Sidebar</h4>
          <div class="icon-sidebar" id="icon-sidebar">
            <input type="checkbox" class="toggle-switch icon-sidebar-switch">
          </div>
        </div>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">Bordered Card</h4>
          <div class="card-border" id="card-border">
            <input type="checkbox" class="toggle-switch border-switch">
          </div>
        </div>
        <div class="p-20 border-bottom child">
          <h4 class="fs-15 fw-medium mb-12">Card Border Radius</h4>
          <div class="card-radius-square" id="card-radius-square">
            <input type="checkbox" class="toggle-switch border-radius-switch">
          </div>
        </div>

        <div class="p-20 border-bottom child">
          <a href="#" class="btn btn-primary text-white">
            Buy Fila
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Theme Setting Area -->

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
