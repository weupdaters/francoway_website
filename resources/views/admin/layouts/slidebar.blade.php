{{-- Start Sidebar Area --}}
<style>
    /* Bulletproof Sidebar Menu Layout Overrides */
    #sidebar-area {
        background-color: #ffffff !important;
        border-right: 1px solid #eff3f9 !important;
    }
    
    #layout-menu {
        padding: 15px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        height: calc(100% - 90px) !important;
        overflow-y: auto !important;
    }

    #layout-menu .menu-inner {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        padding: 0 !important;
        margin: 0 !important;
        list-style: none !important;
        opacity: 1 !important;
        visibility: visible !important;
        height: auto !important;
    }

    #layout-menu .menu-item {
        display: block !important;
        width: 100% !important;
        opacity: 1 !important;
        visibility: visible !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    #layout-menu .menu-link {
        display: flex !important;
        align-items: center !important;
        padding: 12px 16px !important;
        color: #4a5568 !important; /* Elegant gray-dark */
        font-family: 'Outfit', sans-serif !important;
        font-size: 14.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        border-radius: 10px !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
        border: none !important;
        width: 100% !important;
    }

    #layout-menu .menu-link:hover {
        background-color: rgba(7, 21, 48, 0.04) !important;
        color: #E53935 !important; /* Brand Red */
    }

    #layout-menu .menu-item.active > .menu-link {
        background-color: #071530 !important; /* Premium Navy */
        color: #ffffff !important;
    }

    #layout-menu .menu-icon-ri {
        font-size: 20px !important;
        margin-right: 12px !important;
        display-inline: block !important;
        flex-shrink: 0 !important;
    }

    #layout-menu .menu-link:hover .menu-icon-ri {
        color: #E53935 !important;
    }

    #layout-menu .menu-item.active > .menu-link .menu-icon-ri {
        color: #ffffff !important;
    }
</style>

<div class="sidebar-area" id="sidebar-area">
    
    {{-- Header Logo area --}}
    <div class="logo position-relative d-flex align-items-center justify-content-between">
        <a href="{{ auth()->check() ? route('dashboard') : route('index') }}" class="d-block text-decoration-none position-relative d-flex align-items-center">
            {{-- LOGO --}}
            <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/'.$settings['logo']) : asset('assets/images/logo.png') }}"
                 alt="logo-icon"
                 class="logo-icon me-2 img-fluid"
                 style="height: 60px; width: auto; max-width: 200px; object-fit: contain;">
        </a>
    </div>

    {{-- Menu aside container --}}
    <aside id="layout-menu" class="layout-menu menu-vertical menu active">
        <ul class="menu-inner">
           
            {{-- Dashboard --}}
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="ri-dashboard-fill menu-icon-ri"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- User Management --}}
            <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <i class="ri-group-fill menu-icon-ri"></i>
                    <span>User Management</span>
                </a>
            </li>

            {{-- Course Management --}}
            <li class="menu-item {{ request()->routeIs('admin.courses.*') || request()->routeIs('admin.lessons.*') ? 'active' : '' }}">
                <a href="{{ route('admin.courses.index') }}" class="menu-link">
                    <i class="ri-book-open-fill menu-icon-ri"></i>
                    <span>Course Management</span>
                </a>
            </li>

            {{-- Course Assign --}}
            <li class="menu-item {{ request()->routeIs('admin.course-assign.*') ? 'active' : '' }}">
                <a href="{{ route('admin.course-assign.index') }}" class="menu-link">
                    <i class="ri-user-shared-fill menu-icon-ri"></i>
                    <span>Course Assign</span>
                </a>
            </li>

            {{-- Teacher User Assign --}}
            <li class="menu-item {{ request()->routeIs('admin.teacher.assign.*') ? 'active' : '' }}">
                <a href="{{ route('admin.teacher.assign.index') }}" class="menu-link">
                    <i class="ri-team-fill menu-icon-ri"></i>
                    <span>Teacher User Assign</span>
                </a>
            </li>

            {{-- Plans --}}
            <li class="menu-item {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                <a href="{{ route('admin.plans.index') }}" class="menu-link">
                    <i class="ri-price-tag-3-fill menu-icon-ri"></i>
                    <span>Plans</span>
                </a>
            </li>

            {{-- Resources --}}
            <li class="menu-item {{ request()->routeIs('admin.resources.*') ? 'active' : '' }}">
                <a href="{{ route('admin.resources.index') }}" class="menu-link">
                    <i class="ri-folder-download-fill menu-icon-ri"></i>
                    <span>Resources Management</span>
                </a>
            </li>

            {{-- Transactions --}}
            <li class="menu-item {{ request()->routeIs('admin.assignments.*') ? 'active' : '' }}">
                <a href="{{ route('admin.assignments.index') }}" class="menu-link">
                    <i class="ri-file-list-3-fill menu-icon-ri"></i>
                    <span>Transaction History</span>
                </a>
            </li>

            {{-- Profile --}}
            <li class="menu-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <a href="{{ route('admin.profile.index') }}" class="menu-link">
                    <i class="ri-user-settings-fill menu-icon-ri"></i>
                    <span>My Profile</span>
                </a>
            </li>                

            {{-- Account Settings --}}
            <li class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                    <i class="ri-settings-4-fill menu-icon-ri"></i>
                    <span>Account Settings</span>
                </a>
            </li>
            
            {{-- Logout --}}
            <li class="menu-item">
                <form action="{{ route('auth.logout') }}" method="POST" id="sidebar-logout-form-admin">
                    @csrf
                    <a href="javascript:void(0)" onclick="document.getElementById('sidebar-logout-form-admin').submit()" class="menu-link text-danger">
                        <i class="ri-logout-box-r-fill menu-icon-ri text-danger"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>

        </ul>
    </aside>
</div>
<!-- End Sidebar Area -->