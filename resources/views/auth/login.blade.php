

<!DOCTYPE html>
<html lang="zxx">
    <head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Links Of CSS File -->
		<link rel="stylesheet" href="{{asset('admin/css/idebar-menu.css')}}   ">
		<link rel="stylesheet" href="{{asset('admin/css/simplebar.css')}}   ">
		<link rel="stylesheet" href="{{asset('admin/css/prism.css')}}   ">
        <link rel="stylesheet" href="{{asset('admin/css/quill.snow.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/remixicon.css')}}"> 
        <link rel="stylesheet" href="{{asset('admin/css/swiper-bundle.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/jsvectormap.min.css')}}">
		<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{asset('admin/images/favicon.png')}}  ">       
        
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
                                <h3 class="fs-26 fw-medium" style="margin-bottom: 6px;">Sign In</h3>
                                <p class="fs-16 text-secondary lh-1-8">Don’t have an account yet? <a href="{{ route('auth.register') }}" class="text-primary text-decoration-none">Sign Up</a></p>
                            </div>

                            <form class="login-register text-start mt-20" 
                          action="{{ route('login.submit') }}" 
                          method="POST">
                                @csrf
                                 {{-- Email --}}
                        <div class="form-group">
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
                                {{-- Password --}}
                        <div class="form-group">
                            <label class="form-label">Password *</label>
                            <input class="form-control"
                                   type="password"
                                   name="password"
                                   placeholder="Enter password *"
                                   required>

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
                                        <a href="forgot-password.html" class="fs-16 text-primary fw-normal text-decoration-none">Forgot Password?</a>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary fw-normal text-white w-100" style="padding-top: 18px; padding-bottom: 18px;">Sign In</button>
                                </div>

                                <div class="position-relative text-center z-1 mb-12">
                                    <span class="fs-16 bg-white px-4 text-secondary card d-inline-block border-0">or sign in with</span>
                                    <span class="d-block border-bottom border-2 position-absolute w-100 z-n1" style="top: 13px;"></span>
                                </div>

                                <ul class="p-0 mb-0 list-unstyled d-flex justify-content-center" style="gap: 10px;">
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" style="width: 30px; height: 30px; line-height: 30px; background-color: #3a559f;">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.twitter.com/" target="_blank" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" style="width: 30px; height: 30px; line-height: 30px; background-color: #0f1419;">
                                            <i class="ri-twitter-x-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.google.com/" target="_blank" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" style="width: 30px; height: 30px; line-height: 30px; background-color: #e02f2f;">
                                            <i class="ri-google-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" style="width: 30px; height: 30px; line-height: 30px; background-color: #007ab9;">
                                            <i class="ri-linkedin-fill"></i>
                                        </a>
                                    </li>
                                </ul>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="switch-toggle dark-btn p-0 bg-transparent lh-0 border-0" id="switch-toggle"></button>

        <!-- Start Theme Setting Area -->
        <button class="btn btn-primary theme-settings-btn p-0 position-fixed z-2 text-center rounded-circle" style="bottom: 24px; right: 24px; width: 56px; height: 56px; line-height: 54px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <i class="text-white ri-settings-3-fill fs-28" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Click On Theme Settings"></i>
        </button>

        <!-- Start Theme Setting Area -->
        <div class="offcanvas offcanvas-end bg-white border-0" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="box-shadow: 0 4px 20px #2f8fe812 !important; max-width: 300px;">
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
        <script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('admin/js/sidebar-menu.js')}}"></script>
        <script src="{{asset('admin/js/quill.min.js')}}"></script>
        <script src="{{asset('admin/js/data-table.js')}}"></script>
        <script src="{{asset('admin/js/prism.js')}}"></script>
        <script src="{{asset('admin/js/clipboard.min.js')}}"></script>
        <script src="{{asset('admin/js/simplebar.min.js')}}"></script>
        <script src="{{asset('admin/js/apexcharts.min.js')}}"></script>
        <script src="{{asset('admin/js/echarts.min.js')}}"></script>
        <script src="{{asset('admin/js/swiper-bundle.min.js')}}"></script>
        <script src="{{asset('admin/js/fullcalendar.main.js')}}"></script>
        <script src="{{asset('admin/js/jsvectormap.min.js')}}"></script>
        <script src="{{asset('admin/js/world-merc.js')}}"></script>
        <script src="{{asset('admin/js/custom/apexcharts.js')}}"></script>
        <script src="{{asset('admin/js/custom/echarts.js')}}"></script>
        <script src="{{asset('admin/js/custom/maps.js')}}"></script>
        <script src="{{asset('admin/js/custom/custom.js')}}"></script> 
    </body>
</html>