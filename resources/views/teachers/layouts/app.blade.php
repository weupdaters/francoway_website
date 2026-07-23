<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ===== Dynamic SEO ===== --}}
    <title>
        @yield(
            'title',
            $settings['meta_title']
                ?? $settings['site_name']
                ?? config('app.name')
        )
    </title>

    <meta name="description"
          content="@yield(
              'meta_description',
              $settings['meta_description'] ?? $settings['site_tagline'] ?? ''
          )">

    <meta name="author"
          content="{{ $settings['site_name'] ?? config('app.name') }}">

    {{-- ===== Open Graph ===== --}}
    <meta property="og:title"
          content="@yield(
              'og_title',
              $settings['site_name'] ?? config('app.name')
          )">

    <meta property="og:description"
          content="@yield(
              'og_description',
              $settings['meta_description'] ?? ''
          )">

    <meta property="og:type" content="website">

    <meta property="og:image"
          content="@yield(
              'og_image',
              isset($settings['logo'])
                  ? asset('storage/'.$settings['logo'])
                  : asset('admin/images/logo.png')
          )">

    <meta property="og:site_name"
          content="{{ $settings['site_name'] ?? config('app.name') }}">

    {{-- ===== CSS Files ===== --}}
    <link rel="stylesheet" href="{{ asset('admin/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    {{-- ===== Favicon ===== --}}
    <link rel="icon" type="image/png"
          href="{{ setting('favicon')
                ? asset('storage/' . setting('favicon')) . '?v=' . time()
                : asset('frontend/imgs/template/favicon.svg') }}">

    {{-- Page CSS --}}
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
        body.dark-mode .text-secondary,
        [data-bs-theme="dark"] .text-muted,
        body.dark-mode .text-muted,
        [data-bs-theme="dark"] .text-body,
        body.dark-mode .text-body {
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

        /* ========================================================
           GLOBAL PREMIUM DESIGN SYSTEM OVERRIDES (ADMIN & TEACHER)
           ======================================================== */
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap');

        html {
            scroll-behavior: smooth !important;
        }

        body, .main-content-container, .card, .table, input, select, textarea, button, label {
            font-family: 'Outfit', sans-serif !important;
        }

        /* 2026 Micro-Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card, .main-content-card, .settings-page-header, .welcome-card {
            animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        /* Premium Card Overrides */
        .card, .main-content-card {
            background: #ffffff !important;
            border-radius: 20px !important;
            border: 1px solid #EAEAEA !important;
            box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02) !important;
            padding: 24px !important;
            margin-bottom: 25px !important;
            overflow: hidden !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }
        
        .card-header {
            background-color: #fafafa !important;
            border-bottom: 1px solid #EAEAEA !important;
            padding: 16px 24px !important;
            font-weight: 800 !important;
            color: #071530 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        /* Premium Table / List Overrides */
        .table, .default-table-area table {
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            width: 100% !important;
        }

        .table tr {
            background-color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(7, 21, 48, 0.01) !important;
            transition: all 0.2s ease !important;
        }

        .table th {
            font-size: 12.5px !important;
            font-weight: 800 !important;
            color: #071530 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            background-color: #f7fafc !important;
            border: none !important;
            padding: 14px 18px !important;
        }

        .table td {
            font-size: 14.5px !important;
            font-weight: 500 !important;
            color: #4a5568 !important;
            border: none !important;
            padding: 16px 18px !important;
            vertical-align: middle !important;
        }

        .table tbody tr {
            border-radius: 10px !important;
        }

        .table tbody tr:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 24px rgba(7, 21, 48, 0.04) !important;
            background-color: #fcfcfc !important;
        }

        /* Premium Form Fields & Inputs */
        .form-group, .mb-3, .mb-4 {
            margin-bottom: 20px !important;
        }

        .form-control, .form-select, select, input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="url"], textarea {
            height: 48px !important;
            border-radius: 12px !important;
            border: 1.5px solid #EAEAEA !important;
            padding: 0 18px !important;
            font-size: 15px !important;
            font-weight: 500 !important;
            color: #071530 !important;
            background-color: #fafafa !important;
            transition: all 0.2s ease !important;
            width: 100% !important;
        }

        textarea, textarea.form-control {
            height: auto !important;
            padding: 14px 18px !important;
        }

        .form-control:hover, .form-select:hover, select:hover, input:hover, textarea:hover {
            border-color: rgba(7, 21, 48, 0.25) !important;
        }

        .form-control:focus, .form-select:focus, select:focus, input:focus, textarea:focus {
            background-color: #ffffff !important;
            border-color: #071530 !important;
            box-shadow: 0 0 0 4px rgba(7, 21, 48, 0.04) !important;
            outline: none !important;
        }

        /* Labels */
        label, .form-label {
            font-size: 13px !important;
            font-weight: 800 !important;
            color: #071530 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            margin-bottom: 8px !important;
            display: inline-block !important;
        }

        /* Premium Buttons */
        .btn, .btn-primary, .btn-success, .btn-submit, .btn[type="submit"] {
            height: 46px !important;
            border-radius: 12px !important;
            background-color: #071530 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            padding: 0 28px !important;
            border: none !important;
            box-shadow: 0 4px 14px rgba(7, 21, 48, 0.12) !important;
            transition: all 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
        }

        .btn:hover, .btn-primary:hover, .btn-success:hover, .btn-submit:hover, .btn[type="submit"]:hover {
            background-color: #E53935 !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 20px rgba(229, 57, 53, 0.22) !important;
        }

        /* Danger/Delete/Cancel Buttons */
        .btn-danger, .btn-warning {
            background-color: #E53935 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(229, 57, 53, 0.12) !important;
        }

        .btn-danger:hover, .btn-warning:hover {
            background-color: #071530 !important;
            color: #ffffff !important;
            box-shadow: 0 6px 20px rgba(7, 21, 48, 0.22) !important;
        }

        /* Modern Badge Overrides */
        .badge {
            border-radius: 30px !important;
            padding: 6px 14px !important;
            font-weight: 700 !important;
            letter-spacing: 0.4px !important;
            font-size: 11px !important;
            text-transform: uppercase !important;
            border: none !important;
        }
        .bg-success-subtle {
            background-color: rgba(40, 167, 69, 0.08) !important;
            color: #28a745 !important;
        }
        .bg-danger-subtle {
            background-color: rgba(220, 53, 69, 0.08) !important;
            color: #dc3545 !important;
        }
        .bg-warning-subtle {
            background-color: rgba(255, 193, 7, 0.08) !important;
            color: #b58100 !important;
        }
        .bg-info-subtle {
            background-color: rgba(23, 162, 184, 0.08) !important;
            color: #17a2b8 !important;
        }

        /* Dark theme tweaks to play nice with global overrides */
        [data-bs-theme="dark"] .card, 
        [data-bs-theme="dark"] .main-content-card,
        [data-bs-theme="dark"] tr {
            background-color: #0d0d0d !important;
            border-color: #222222 !important;
        }
        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select,
        [data-bs-theme="dark"] input,
        [data-bs-theme="dark"] textarea {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
            border-color: #222222 !important;
        }
        [data-bs-theme="dark"] label,
        [data-bs-theme="dark"] .form-label,
        [data-bs-theme="dark"] .settings-card-title,
        [data-bs-theme="dark"] h1, [data-bs-theme="dark"] h2, [data-bs-theme="dark"] h3, [data-bs-theme="dark"] h4, [data-bs-theme="dark"] h5, [data-bs-theme="dark"] h6 {
            color: #ffffff !important;
        }
    </style>
</head>

<body class="bg-body-bg">

    {{-- Preloader --}}
    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span>F</span><span>r</span><span>a</span><span>n</span>
                <span>c</span><span>o</span><span>W</span><span>a</span><span>y</span>
            </div>
        </div>
    </div>

    {{-- Notifications --}}
    @include('teachers.layouts.notification')

    <div class="container-fluid">
        <div class="main-content d-flex flex-column p-0 mx-auto">

            {{-- Header --}}
            @include('teachers.layouts.header')

            {{-- Main Content --}}
            <div class="main-content-container overflow-x-hidden">
                @yield('content')
            </div>

            {{-- Footer --}}
            @include('teachers.layouts.footer')

        </div>
    </div>

    {{-- ===============================
       JS FILES (ORDER MATTERS 🔥)
    =============================== --}}

    {{-- jQuery (MUST BE FIRST) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Bootstrap --}}
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Other Vendor JS --}}
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

    {{-- Custom --}}
    <script src="{{ asset('admin/js/custom/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/js/custom/echarts.js') }}"></script>
    <script src="{{ asset('admin/js/custom/maps.js') }}"></script>
    <script src="{{ asset('admin/js/custom/custom.js') }}"></script>

    {{-- Page Scripts --}}
    @stack('scripts')

</body>
</html>
