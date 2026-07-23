<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- ===== Dynamic SEO Meta ===== -->
  <title>@yield('title', 'Admin Dashboard')</title>

  <meta name="description" content="@yield('meta_description', 'Admin panel dashboard')">
  <meta name="keywords" content="@yield('meta_keywords', 'admin, dashboard, panel')">
  <meta name="author" content="@yield('meta_author', config('app.name'))">

  <!-- Open Graph / Social Share -->
  <meta property="og:title" content="@yield('og_title', config('app.name'))">
  <meta property="og:description" content="@yield('og_description', 'Admin dashboard')">
  <meta property="og:image" content="@yield('og_image', asset('admin/images/logo.png'))">
  <meta property="og:type" content="website">

  <!-- ===== CSS Files ===== -->
  <link rel="stylesheet" href="{{ asset('admin/css/sidebar-menu.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/prism.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/jsvectormap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <!-- Favicon / Logo -->
    <link rel="icon" type="image/png"
          href="{{ setting('favicon')
                ? asset('storage/' . setting('favicon')) . '?v=' . time()
                : asset('frontend/imgs/template/favicon.svg') }}">
  <!-- Extra Page CSS -->
  @stack('styles')
  <script>
      // Apply theme immediately to prevent flashing
      const savedTheme = localStorage.getItem("theme") || "light";
      document.documentElement.setAttribute("data-bs-theme", savedTheme);
  </script>
  <style>
      /* Smooth transition when toggling */
      body, .sidebar-area, .header-area, .card, .main-content-card {
          transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
      }
      /* Pitch black theme overrides */
      [data-bs-theme="dark"] body, 
      [data-bs-theme="dark"] .bg-body-bg {
          background-color: #000000 !important;
          color: #f8fafc !important;
      }
      [data-bs-theme="dark"] .sidebar-area,
      [data-bs-theme="dark"] .header-area,
      [data-bs-theme="dark"] .main-content-card,
      [data-bs-theme="dark"] .card {
          background-color: #0d0d0d !important;
          border-color: #222222 !important;
          color: #f8fafc !important;
      }
      [data-bs-theme="dark"] .text-secondary,
      [data-bs-theme="dark"] .text-muted,
      [data-bs-theme="dark"] .text-body {
          color: #cbd5e1 !important;
      }
      [data-bs-theme="dark"] .menu-link {
          color: #cbd5e1 !important;
      }
      [data-bs-theme="dark"] .menu-link:hover,
      [data-bs-theme="dark"] .menu-item.active > .menu-link {
          color: #ffffff !important;
          background: #222222 !important;
      }
      /* Fix tables in dark mode */
      [data-bs-theme="dark"] table,
      body.dark-mode table,
      [data-bs-theme="dark"] th,
      body.dark-mode th,
      [data-bs-theme="dark"] td,
      body.dark-mode td {
          color: #cbd5e1 !important;
          border-color: #222222 !important;
      }
      [data-bs-theme="dark"] thead th,
      body.dark-mode thead th,
      [data-bs-theme="dark"] .default-table-area thead th,
      body.dark-mode .default-table-area thead th,
      [data-bs-theme="dark"] .default-table-area thead,
      body.dark-mode .default-table-area thead,
      [data-bs-theme="dark"] .table thead th,
      body.dark-mode .table thead th,
      [data-bs-theme="dark"] .style-two .table thead th,
      body.dark-mode .style-two .table thead th {
          background-color: #1a1a1a !important;
          color: #ffffff !important;
          border-color: #222222 !important;
      }
      /* Dark mode contextual table rows */
      [data-bs-theme="dark"] .table-danger,
      [data-bs-theme="dark"] tr.table-danger td,
      body.dark-mode .table-danger,
      body.dark-mode tr.table-danger td {
          background-color: #3f1a1d !important;
          color: #fca5a5 !important;
      }
      [data-bs-theme="dark"] .table-success,
      [data-bs-theme="dark"] tr.table-success td,
      body.dark-mode .table-success,
      body.dark-mode tr.table-success td {
          background-color: #14321a !important;
          color: #86efac !important;
      }
      [data-bs-theme="dark"] .table-warning,
      [data-bs-theme="dark"] tr.table-warning td,
      body.dark-mode .table-warning,
      body.dark-mode tr.table-warning td {
          background-color: #3d2d0d !important;
          color: #fde047 !important;
      }
      [data-bs-theme="dark"] .table-info,
      [data-bs-theme="dark"] tr.table-info td,
      body.dark-mode .table-info,
      body.dark-mode tr.table-info td {
          background-color: #132d3e !important;
          color: #93c5fd !important;
      }
      /* Utility classes overrides */
      [data-bs-theme="dark"] .bg-white,
      body.dark-mode .bg-white,
      .dark-mode .bg-white {
          background-color: #0d0d0d !important;
      }
      [data-bs-theme="dark"] .bg-light,
      body.dark-mode .bg-light,
      .dark-mode .bg-light {
          background-color: #1a1a1a !important;
      }
      [data-bs-theme="dark"] .border-white,
      body.dark-mode .border-white,
      .dark-mode .border-white,
      [data-bs-theme="dark"] .border,
      body.dark-mode .border,
      .dark-mode .border,
      [data-bs-theme="dark"] .border-bottom,
      body.dark-mode .border-bottom,
      .dark-mode .border-bottom,
      [data-bs-theme="dark"] .border-top,
      body.dark-mode .border-top,
      .dark-mode .border-top {
          border-color: #222222 !important;
      }
      /* Form fields overrides for dark theme */
      [data-bs-theme="dark"] .form-control,
      body.dark-mode .form-control,
      [data-bs-theme="dark"] .form-select,
      body.dark-mode .form-select,
      [data-bs-theme="dark"] .form-control:focus,
      body.dark-mode .form-control:focus,
      [data-bs-theme="dark"] input,
      body.dark-mode input,
      [data-bs-theme="dark"] textarea,
      body.dark-mode textarea,
      [data-bs-theme="dark"] select,
      body.dark-mode select {
          background-color: #1a1a1a !important;
          color: #ffffff !important;
          border-color: #222222 !important;
      }
      /* Fix floating labels and text colors inside forms */
      [data-bs-theme="dark"] .form-floating > label,
      body.dark-mode .form-floating > label {
          color: #cbd5e1 !important;
      }
      [data-bs-theme="dark"] .form-floating > .form-control:focus ~ label,
      body.dark-mode .form-floating > .form-control:focus ~ label,
      [data-bs-theme="dark"] .form-floating > .form-control:not(:placeholder-shown) ~ label,
      body.dark-mode .form-floating > .form-control:not(:placeholder-shown) ~ label {
          color: #3b82f6 !important;
          background-color: transparent !important;
      }
      [data-bs-theme="dark"] .form-control::placeholder,
      body.dark-mode .form-control::placeholder {
          color: #64748b !important;
      }
      /* Title and generic headings inside cards */
      [data-bs-theme="dark"] h1, body.dark-mode h1,
      [data-bs-theme="dark"] h2, body.dark-mode h2,
      [data-bs-theme="dark"] h3, body.dark-mode h3,
      [data-bs-theme="dark"] h4, body.dark-mode h4,
      [data-bs-theme="dark"] h5, body.dark-mode h5,
      [data-bs-theme="dark"] h6, body.dark-mode h6,
      [data-bs-theme="dark"] label, body.dark-mode label,
      [data-bs-theme="dark"] .text-secondary, body.dark-mode .text-secondary,
      [data-bs-theme="dark"] .text-muted, body.dark-mode .text-muted,
      [data-bs-theme="dark"] .text-body, body.dark-mode .text-body,
      [data-bs-theme="dark"] .text-dark, body.dark-mode .text-dark {
          color: #ffffff !important;
      }
      #themeToggle {
          background: transparent !important;
          border: none !important;
          padding: 8px !important;
          font-size: 22px !important;
          color: #475569 !important; /* light mode */
          cursor: pointer;
          display: inline-flex;
          align-items: center;
          justify-content: center;
      }
      [data-bs-theme="dark"] #themeToggle,
      body.dark-mode #themeToggle {
          color: #ffffff !important; /* dark mode */
      }
  </style>
</head>


<body class="bg-body-bg">

  <!-- Page-specific CSS -->
  @stack('styles')

  <!-- Custom CSS -->


  <!-- Start Preloader Area -->
  <div class="preloader" id="preloader">
    <div class="preloader">
      <div class="waviy position-relative">
        <span class="d-inline-block">F</span>
        <span class="d-inline-block">r</span>
        <span class="d-inline-block">a</span>
        <span class="d-inline-block">n</span>
        <span class="d-inline-block">c</span>
        <span class="d-inline-block">o</span>
        <span class="d-inline-block">W</span>
        <span class="d-inline-block">a</span>
        <span class="d-inline-block">y</span>


      </div>
    </div>
  </div>
  End Preloader Area -->

  @include('admin.layouts.slidebar')


  @include('admin.layouts.notification')

  @include('admin.layouts.header')

  @yield('content')

  @include('admin.layouts.footer')


  @stack('scripts')
