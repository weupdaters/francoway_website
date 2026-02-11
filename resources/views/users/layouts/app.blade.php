<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    {{-- ===== Open Graph (Social Share) ===== --}}
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

    {{-- ===== Favicon ===== --}}
 <link rel="icon" type="image/png"
          href="{{ setting('favicon')
                ? asset('storage/' . setting('favicon')) . '?v=' . time()
                : asset('frontend/imgs/template/favicon.svg') }}">


    {{-- Extra Page CSS --}}
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
        <!-- End Preloader Area -->




  @include('users.layouts.notification')

  @include('users.layouts.header')

    @yield('content')

@include('users.layouts.footer')    


  @stack('scripts')

