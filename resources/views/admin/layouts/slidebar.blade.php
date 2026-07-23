   {{-- Start Sidebar Area --}}
        <div class="sidebar-area" id="sidebar-area">
           <div class="logo position-relative d-flex align-items-center justify-content-between">
    <a href="{{ route('index') }}" class="d-block text-decoration-none position-relative d-flex align-items-center">

        {{-- LOGO --}}
        <img
            src="{{ isset($settings['logo'])
                    ? asset('storage/'.$settings['logo'])
                    : asset('admin/images/logo .jpeg') }}"
            alt="logo-icon"
            class="logo-icon me-2 img-fluid"
            style="height: 55px; width: auto; max-width: 160px; object-fit: contain;"
        >

        {{-- SITE NAME --}}
    </a>

</div>


            <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
                <ul class="menu-inner">
                   
                            <li class="menu-item">
                                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/dashboard.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="dashboard">
                                    Dashboard
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.users.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/group.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="users">
                                    User Management
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.courses.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/book.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="courses">
                                    Course Management
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.course-assign.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/checked-user-male.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="assign">
                                    Course Assign 
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.teacher.assign.index') }}" class="menu-link ">
                                    <img src="https://img.icons8.com/color/48/classroom.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="teacher-assign">
                                    Teacher User Assign
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.plans.index')}}" class="menu-link ">
                                    <img src="https://img.icons8.com/color/48/price-tag.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="plans">
                                    plans
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.resources.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/downloads.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="resources">
                                    Resources Management
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.assignments.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/bill.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="transactions">
                                   Transaction History
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.profile.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/user-male-circle.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="profile">
                                <span class="title">My Profile</span>
                            </a>
                            </li>                
                
                            <li class="menu-item">
                                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                                    <img src="https://img.icons8.com/color/48/settings.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="settings">
                                    Account Settings
                                </a>
                            </li>
                            
                      
                            <li class="menu-item">
    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit" class="menu-link border-0 bg-transparent w-100 text-start">
            <img src="https://img.icons8.com/color/48/shutdown.png" class="menu-icon" style="width: 22px; height: 22px; object-fit: contain; margin-right: 10px;" alt="logout">
            <span class="title">Logout</span>
        </button>
    </form>
</li>
                    

    

                </ul>
            </aside>
        </div>
        <!-- End Sidebar Area -->