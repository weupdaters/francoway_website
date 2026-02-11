   <div class="container-fluid">
            <div class="main-content d-flex flex-column p-0 mx-auto" style="max-width: 1608px;">
   <!-- Start Header Area -->
                <header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">
                        
                    <!-- Start Navbar Area --> 
                    <nav class="header-navbar navbar-expand-xl navbar bg-transparent z-1" id="navbar">
                        <div class="container-fluid position-relative d-block d-md-flex justify-content-center justify-content-md-between p-0">
                            <div class="left-header-content">
                                <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                                    <li class="d-xl-none">
                                        <button class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3" id="header-burger-menu">
                                            <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                            <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
                                            <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                        </button>
                                    </li>
                                    <li>
                                        <a href="index.html" class="d-flex text-decoration-none align-items-center" style="gap: 8px;">
                                            <img src="{{ asset('Admin/images/logo .jpeg') }}" alt="logo-icon" class="logo-icon" style="width:40px; height:40px; border-radius:50%;">
                                            <span class="logo-text text-secondary fw-semibold fs-25 position-relative top-1">FrancoWay</span>
                                        </a> 
                                    </li>
                                </ul>
                            </div>
                            
                            

                            <div class="right-header-content mt-3 mt-md-0">
                                <ul class="d-flex align-items-center justify-content-center justify-content-md-end ps-0 mb-0 list-unstyled">

                                   
                                    
                                     
                                    <li class="header-right-item">
                                        <div class="dropdown admin-profile">
                                            <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <div class="flex-shrink-0 position-relative">
                                                    <img
                                                        class="rounded-circle admin-img-width-for-mobile"
                                                        style="width: 40px; height: 40px;"
                                                        src="{{ auth()->user()->image
                                                            ? asset('storage/' . auth()->user()->image)
                                                            : asset('admin/assets/images/user1.jpg') }}"
                                                        alt="{{ auth()->user()->name }}"
                                                    >

                                                    <span
                                                        class="d-block bg-success-60 border border-2 border-white rounded-circle position-absolute end-0 bottom-0"
                                                        style="width: 11px; height: 11px;">
                                                    </span>
                                                </div>
                                            </div>

    
                                            <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                               
                                                <ul class="admin-link mb-0 list-unstyled">
                                                   
                                                    <li>
                                                        <a class="dropdown-item admin-item-link d-flex align-items-center text-body" href="{{ route('logout') }}">
                                                            <i class="material-symbols-outlined">logout</i>
                                                            <span class="ms-2">Logout</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- End Navbar Area -->
                </header>
                <!-- End Header Area -->