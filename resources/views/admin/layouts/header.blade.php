 <!-- Start Main Content Area -->
        <div class="container-fluid">
            <div class="main-content d-flex flex-column">
                <!-- Start Header Area -->
                <header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="left-header-content">
                                <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                                    <li class="d-xl-none">
                                        <button class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3" id="header-burger-menu">
                                            <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                            <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
                                            <span class="border-1 d-block for-dark-burger" style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                        </button>
                                    </li>
                                   
                                   
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                    </div>
                </header>
                <!-- End Header Area -->