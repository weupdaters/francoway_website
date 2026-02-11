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
