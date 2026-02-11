<!doctype html>
<html lang="en">
<head>
    <!--prettier-ignore-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    {{-- ================= TITLE ================= --}}
    <title>
        {{ setting('meta_title')
            ?? setting('site_name','FrancoWay') }}
    </title>

    {{-- ================= META DESCRIPTION ================= --}}
    <meta name="description"
          content="{{ setting('meta_description','') }}">

    {{-- ================= FAVICON ================= --}}
    <link rel="icon" type="image/png"
          href="{{ setting('favicon')
                ? asset('storage/' . setting('favicon')) . '?v=' . time()
                : asset('frontend/imgs/template/favicon.svg') }}">

    {{-- ================= CSS FILES ================= --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors/carouselTicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors/odometer.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/bootstrap-icons/bootstrap-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/boxicons/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/remixicon/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/fontawesome/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/fontawesome/solid.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/fonts/fontawesome/regular.min.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300..900&family=Space+Grotesk:wght@300..700&display=swap" />

    {{-- ================= MAIN CSS ================= --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/elearning.css') }}" />
</head>


<body class="elearning">
    <!--prettier-ignore-->
    <!--Preloader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon">
                   <img
                        src="{{ setting('favicon')
                                ? asset('storage/' . setting('favicon')) . '?v=' . time()
                                : asset('frontend/imgs/template/favicon.svg') }}"
                        alt="Site Icon"
                        width="40"
                        height="40"
                        class="rotateme site-favicon"
                    />

                </div>
            </div>
        </div>
    </div>
    <!--Preloader-end -->
    @include('layouts.header')

    <!--custom-cursor-->
    <div class="follower"></div>
    <div class="custom-cursor-cover">
        <span class="dot"></span>
    </div>
    <!--custom-cursor-end -->
    <!-- Navbar landing page -->
   

   
    <!--prettier-ignore-->
 @yield('content')
    <!-- Scroll top -->


    @include('layouts.footer')
    <div class="btn-scroll-top">
        <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
            <path d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
        </svg>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('frontend/js/vendors/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/headhesive.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/smart-stick-nav.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/jquery.carouselTicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/jquery.appear.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/jquery.magnific-popup.min.js') }}"></script>  
    <script src="{{ asset('frontend/js/vendors/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/aat.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/Splitetext.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/bouncing-blob.js') }}"></script>
    <!-- Theme JS -->
    <script src="{{ asset('frontend/js/gsap-custom.js') }}"></script>  
    <script src="{{ asset('frontend/js/imageRevealHover.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script> 
    

</body>

</html>