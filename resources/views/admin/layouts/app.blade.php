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
    <link rel="icon" type="image/png" href="{{ asset('admin/images/favicon.png') }}">

    <!-- Extra Page CSS -->
    @stack('styles')
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

