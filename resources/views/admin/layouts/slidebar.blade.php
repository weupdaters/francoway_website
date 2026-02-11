   {{-- Start Sidebar Area --}}
        <div class="sidebar-area" id="sidebar-area">
           <div class="logo position-relative d-flex align-items-center justify-content-between">
    <a href="{{ route('index') }}" class="d-block text-decoration-none position-relative d-flex align-items-center">

        {{-- LOGO --}}
        <img
            src="{{ isset($settings['logo'])
                    ? asset('storage/'.$settings['logo'])
                    : asset('admin/images/logo.jpeg') }}"
            alt="logo-icon"
            class="logo-icon me-2 img-fluid"
            style="width: 40px; height: 40px;"
        >

        {{-- SITE NAME --}}
        <span class="logo-text text-secondary fw-semibold">
            {{ $settings['site_name'] ?? 'FrancoWay' }}
        </span>
    </a>

    {{-- CLOSE BUTTON --}}
    <button
        class="sidebar-burger-menu-close bg-transparent py-3 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
        id="sidebar-burger-menu-close">
        <span class="border-1 d-block for-dark-burger"
              style="border-bottom:1px solid #475569;width:25px;transform:rotate(45deg);"></span>
        <span class="border-1 d-block for-dark-burger"
              style="border-bottom:1px solid #475569;width:25px;transform:rotate(-45deg);"></span>
    </button>

    {{-- OPEN BUTTON --}}
    <button class="sidebar-burger-menu bg-transparent p-0 border-0" id="sidebar-burger-menu">
        <span class="border-1 d-block for-dark-burger"
              style="border-bottom:1px solid #475569;width:25px;"></span>
        <span class="border-1 d-block for-dark-burger"
              style="border-bottom:1px solid #475569;width:25px;margin:6px 0;"></span>
        <span class="border-1 d-block for-dark-burger"
              style="border-bottom:1px solid #475569;width:25px;"></span>
    </button>
</div>


            <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
                <ul class="menu-inner">
                   
                    <li class="menu-item open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle active">
                            <span class="material-symbols-outlined menu-icon">dashboard</span>
                            <span class="title">Dashboard</span>
                            
                        </a>
                
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('admin.users.index') }}" class="menu-link">
                                    User Management
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.courses.index') }}" class="menu-link">
                                    Course Management
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.course-assign.create') }}" class="menu-link">
                                    Course Assign 
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.teacher.assign.index') }}" class="menu-link active">
                                    Teacher Assign
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    

                    <li class="menu-title small text-uppercase">
                        <span class="menu-title-text">OTHERS</span>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.profile.index') }}" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">account_circle</span>
                            <span class="title">My Profile</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle active">
                            <span class="material-symbols-outlined menu-icon">settings</span>
                            <span class="title">Settings</span>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                                    Account Settings
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="notification-settings.html" class="menu-link">
                                    Notification Settings
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="privacy-settings.html" class="menu-link">
                                    Privacy Settings
                                </a>
                            </li>
                        </ul>   

                    

                    <li class="menu-item">
                        <a href="logout.html" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">logout</span>
                            <span class="title">Logout</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
        <!-- End Sidebar Area -->