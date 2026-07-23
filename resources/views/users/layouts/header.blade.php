    <div class="container-fluid">
        <div class="main-content d-flex flex-column p-0 mx-auto" style="max-width: 1608px;">
            <!-- Start Header Area -->
            <header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">

                <!-- Start Navbar Area -->
                <nav class="header-navbar navbar-expand-xl navbar bg-transparent z-1" id="navbar">
                    <div
                        class="container-fluid position-relative d-block d-md-flex justify-content-center justify-content-md-between p-0">
                        <div class="left-header-content">
                            <ul
                                class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                                <li class="d-xl-none">
                                    <button
                                        class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3"
                                        id="header-burger-menu">
                                        <span class="border-1 d-block for-dark-burger"
                                            style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                        <span class="border-1 d-block for-dark-burger"
                                            style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
                                        <span class="border-1 d-block for-dark-burger"
                                            style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                    </button>
                                </li>
                                <li>
                                    <a href="{{ route('index') }}" class="d-flex text-decoration-none align-items-center"
                                        style="gap: 8px;">
                                        <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('Admin/images/logo .jpeg') }}" alt="logo-icon"
                                            class="logo-icon" style="height: 55px; width: auto; max-width: 160px; object-fit: contain;">
                                    </a>
                                </li>
                            </ul>
                        </div>



                        <div class="right-header-content mt-3 mt-md-0">
                            <ul
                                class="d-flex align-items-center justify-content-center justify-content-md-end ps-0 mb-0 list-unstyled">




                                 <li class="header-right-item me-3"><button id="themeToggle" class="btn btn-sm bg-transparent border-0 text-secondary"><i class="ri-moon-line"></i></button></li><li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0 position-relative">
                                                <img class="rounded-circle admin-img-width-for-mobile"
                                                    style="width: 40px; height: 40px;"
                                                    src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('admin/assets/images/user1.jpg') }}"
                                                    alt="{{ auth()->user()->name }}">

                                                <span
                                                    class="d-block bg-success-60 border border-2 border-white rounded-circle position-absolute end-0 bottom-0"
                                                    style="width: 11px; height: 11px;">
                                                </span>
                                            </div>
                                        </div>


                                        <div class="dropdown-menu border-0 bg-white dropdown-menu-end">

                                            <ul class="admin-link mb-0 list-unstyled">

                                                <li>

                                                    <form method="POST" action="{{ route('auth.logout') }}">

                                                        @csrf

                                                        <button type="submit"
                                                            class="dropdown-item admin-item-link d-flex align-items-center text-body border-0 bg-transparent w-100">

                                                            <img src="https://img.icons8.com/color/48/shutdown.png" style="width: 20px; height: 20px; object-fit: contain; margin-right: 8px;" alt="logout">
                                                            <span class="ms-2">Logout</span>

                                                        </button>

                                                    </form>

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

 @push('scripts')
<script>
    const toggleBtn = document.getElementById('themeToggle');
    const icon = toggleBtn.querySelector('i');
    const currentSavedTheme = localStorage.getItem('theme') || 'light';
    document.body.setAttribute('data-bs-theme', currentSavedTheme);
    if (currentSavedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        icon.className = 'ri-moon-line';
    } else {
        document.body.classList.remove('dark-mode');
        icon.className = 'ri-sun-line';
    }
    toggleBtn.addEventListener('click', () => {
        let activeTheme = document.documentElement.getAttribute('data-bs-theme');
        let newTheme = activeTheme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', newTheme);
        document.documentElement.setAttribute('data-bs-theme', newTheme);
        document.body.setAttribute('data-bs-theme', newTheme);
        if (newTheme === 'dark') {
            document.body.classList.add('dark-mode');
            icon.className = 'ri-moon-line';
        } else {
            document.body.classList.remove('dark-mode');
            icon.className = 'ri-sun-line';
        }
    });
</script>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
