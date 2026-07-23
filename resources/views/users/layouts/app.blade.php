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

    <!-- Google Fonts & Bootstrap Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- Extra Page CSS --}}
    @stack('styles')
    <script>
        const savedTheme = localStorage.getItem("theme") || "light";
        document.documentElement.setAttribute("data-bs-theme", savedTheme);
    </script>
    <style>
        /* Global Reset to replicate Mockup */
        body {
            font-family: 'Poppins', 'Outfit', sans-serif;
            background-color: #F3F6F9 !important;
            margin: 0 !important;
            padding: 0 !important;
            color: #071530;
        }

        /* 1. TOP BLACK INFO BAR */
        .top-info-bar {
            background-color: #071530;
            color: #ffffff;
            font-size: 12px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            font-weight: 500;
        }
        .top-info-bar a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.2s;
        }
        .top-info-bar a:hover {
            color: #E53935;
        }
        .top-info-bar .social-links a {
            margin-left: 15px;
            font-size: 14px;
        }

        /* 2. MAIN NAVIGATION NAVBAR (WHITE) */
        .main-navbar {
            background-color: #ffffff;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            border-bottom: 1px solid #EAEAEA;
        }
        .nav-logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .nav-logo-img {
            height: 48px;
            width: auto;
        }
        .nav-brand-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 20px;
            color: #071530;
            line-height: 1;
            letter-spacing: -0.5px;
        }
        .nav-brand-subtext {
            font-size: 9px;
            color: #E53935;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            margin-top: 2px;
        }
        .nav-profile-area {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        .notification-bell-box {
            position: relative;
            font-size: 22px;
            color: #5A6A85;
            cursor: pointer;
        }
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -3px;
            background-color: #E53935;
            color: #ffffff;
            font-size: 8px;
            font-weight: 800;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-profile-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-name-text {
            font-weight: 600;
            font-size: 14px;
            color: #071530;
        }

        /* 3. LAYOUT MAIN BODY GRID */
        .dashboard-layout-container {
            display: flex;
            min-height: calc(100vh - 115px);
        }

        /* Left Sidebar */
        .left-sidebar-wrapper {
            width: 260px;
            background-color: #ffffff;
            padding: 30px 20px;
            flex-shrink: 0;
            border-right: 1px solid #EAEAEA;
        }
        .sidebar-menu-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .sidebar-menu-item {
            margin-bottom: 12px;
        }
        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: #5A6A85;
            font-size: 14.5px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.25s ease;
        }
        .sidebar-menu-link:hover {
            background-color: rgba(227, 27, 35, 0.02);
            color: #E31B23;
        }
        .sidebar-menu-item.active .sidebar-menu-link {
            background-color: rgba(227, 27, 35, 0.08);
            color: #E31B23;
            border-left: 4px solid #E31B23;
            border-radius: 0 12px 12px 0;
        }
        .sidebar-menu-link i {
            font-size: 18px;
        }
        .badge-count-red {
            background-color: #E53935;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 10px;
            margin-left: auto;
        }

        /* Right Main Content Panel */
        .main-content-panel {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
            width: 100%;
        }

        /* Mobile Responsive Overrides */
        @media (max-width: 1200px) {
            .left-sidebar-wrapper {
                display: none;
                position: absolute;
                z-index: 1040;
                top: 115px;
                left: 0;
                bottom: 0;
                box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            }
            .left-sidebar-wrapper.show-mobile-sidebar {
                display: block !important;
            }
            .top-info-bar {
                padding: 0 20px;
            }
            .main-navbar {
                padding: 0 20px;
            }
            .main-content-panel {
                padding: 20px;
            }
        }
        @media (max-width: 768px) {
            .top-info-bar {
                display: none !important;
            }
            .left-sidebar-wrapper {
                top: 75px;
            }
        }
    </style>
</head>

<body>

    <!-- 1. TOP BLACK INFO BAR -->
    <div class="top-info-bar">
        <div>
            <i class="bi bi-envelope-fill me-1"></i> <a href="mailto:support@francoway.com">support@francoway.com</a>
            <span class="mx-3 text-white-50">|</span>
            <i class="bi bi-telephone-fill me-1"></i> +91 98765 43210
        </div>
        <div class="social-links d-none d-md-block">
            <span>Follow Us:</span>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-whatsapp"></i></a>
        </div>
    </div>

    <!-- 2. MAIN NAVIGATION NAVBAR (WHITE) -->
    <div class="main-navbar">
        <div class="nav-logo-area">
            <a href="{{ route('index') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ setting('logo') ? asset('storage/' . setting('logo')) : asset('admin/images/logo.png') }}" alt="logo" class="nav-logo-img rounded-circle me-2">

            </a>
            <button class="btn p-0 border-0 ms-4 d-xl-none" id="hamburger-sidebar-toggle">
                <i class="bi bi-list fs-3 text-dark"></i>
            </button>
        </div>
        <div class="nav-profile-area">
            <div class="dropdown">
                <div class="notification-bell-box" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                    <i class="bi bi-bell-fill"></i>
                    <span class="notification-badge">3</span>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 p-3" style="width: 320px; border-radius: 16px;">
                    <li class="dropdown-header d-flex justify-content-between align-items-center px-0 pb-2 mb-2 border-bottom">
                        <span class="fw-bold text-dark" style="font-size: 15px;">Notifications</span>
                        <span class="badge bg-danger-subtle text-danger rounded-pill">3 New</span>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item p-2 rounded d-flex gap-3 align-items-start" href="{{ route('users.courses.index') }}" style="white-space: normal; background: transparent;">
                            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; min-width: 36px;">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="fw-bold text-dark" style="font-size: 13px;">Welcome to FrancoWay!</div>
                                <div class="text-muted" style="font-size: 11px; line-height: 1.3;">Explore your learning dashboard and start completing lessons.</div>
                                <div class="text-muted mt-1" style="font-size: 10px;">Just now</div>
                            </div>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item p-2 rounded d-flex gap-3 align-items-start" href="{{ route('ai.practice') }}" style="white-space: normal; background: transparent;">
                            <div class="bg-danger-subtle text-danger rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; min-width: 36px;">
                                <i class="bi bi-robot"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="fw-bold text-dark" style="font-size: 13px;">AI Practice Available</div>
                                <div class="text-muted" style="font-size: 11px; line-height: 1.3;">Test your speaking and writing skills with our interactive AI.</div>
                                <div class="text-muted mt-1" style="font-size: 10px;">2 hours ago</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 rounded d-flex gap-3 align-items-start" href="{{ route('users.courses.index') }}" style="white-space: normal; background: transparent;">
                            <div class="bg-success-subtle text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; min-width: 36px;">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="fw-bold text-dark" style="font-size: 13px;">Course Achievements</div>
                                <div class="text-muted" style="font-size: 11px; line-height: 1.3;">Complete quizzes to earn certificates of completion.</div>
                                <div class="text-muted mt-1" style="font-size: 10px;">1 day ago</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="user-profile-dropdown dropdown">
                <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <img class="user-avatar" src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('admin/images/user1.jpg') }}" alt="avatar">
                    <span class="user-name-text d-none d-md-inline-block">{{ auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down text-muted small"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                    <li><a class="dropdown-item py-2 text-muted" href="{{ route('users.profile.index') }}"><i class="bi bi-person-circle me-2 text-primary"></i> My Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger border-0 bg-transparent w-100 text-start">
                                <i class="bi bi-power me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 3. LAYOUT CONTAINER -->
    <div class="dashboard-layout-container">
        
        <!-- Left Sidebar -->
        <div class="left-sidebar-wrapper">
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item {{ request()->routeIs('users.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('users.dashboard') }}" class="sidebar-menu-link">
                            <i class="bi bi-grid-1x2-fill me-2" style="color:#E53935;"></i>
                            <span>Dashboard</span>
                        </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('users.courses.*') || request()->routeIs('users.lessons.*') ? 'active' : '' }}">
                        <a href="{{ route('users.courses.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-journal-richtext me-2" style="color:#E53935;"></i>
                            <span>My Courses</span>
                        </a>
                </li>

                <li class="sidebar-menu-item {{ request()->routeIs('users.profile.*') ? 'active' : '' }}">
                        <a href="{{ route('users.profile.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-person-fill me-2" style="color:#E53935;"></i>
                            <span>Profile</span>
                        </a>
                </li>

                <li class="sidebar-menu-item border-top mt-4 pt-3">
                    <form method="POST" action="{{ route('auth.logout') }}" id="sidebar-logout-form-layout">
                        @csrf
                        <a href="#" onclick="document.getElementById('sidebar-logout-form-layout').submit(); event.preventDefault();" class="sidebar-menu-link text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                <span>Logout</span>
                            </a>
                    </form>
                </li>

            </ul>
        </div>

        <!-- Main Content Panel -->
        <div class="main-content-panel">
            @yield('content')
        </div>

    </div>

    <!-- Link Of JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom/custom.js') }}"></script>
    @stack('scripts')
    <script>
        $(document).ready(function() {
            // Hamburger mobile toggle sidebar
            $('#hamburger-sidebar-toggle').on('click', function(e) {
                $('.left-sidebar-wrapper').toggleClass('show-mobile-sidebar');
                e.stopPropagation();
            });
            
            $(document).on('click', function(e) {
                if ($(window).width() <= 1200) {
                    if (!$(e.target).closest('.left-sidebar-wrapper').length && !$(e.target).closest('#hamburger-sidebar-toggle').length) {
                        $('.left-sidebar-wrapper').removeClass('show-mobile-sidebar');
                    }
                }
            });
        });
    </script>
</body>
</html>
