 <!-- Start Main Content Area -->
 <div class="container-fluid">
     <div class="main-content d-flex flex-column">
         <!-- Start Header Area -->
         <header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">
             <div class="row align-items-center">
                 <div class="col-md-6">
                     <div class="left-header-content">
                         <ul
                             class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                             <li class="d-xl-none">
                                 <button class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3"
                                     id="header-burger-menu">
                                     <span class="border-1 d-block for-dark-burger"
                                         style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                     <span class="border-1 d-block for-dark-burger"
                                         style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
                                     <span class="border-1 d-block for-dark-burger"
                                         style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
                                 </button>
                             </li>
                             <li class="ms-2">
                                 <a href="{{ auth()->check() ? route('dashboard') : route('index') }}" class="d-flex text-decoration-none align-items-center" style="gap: 8px;">
                                     <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('assets/images/logo.png') }}" alt="logo-icon" class="logo-icon" style="height: 65px; width: auto; max-width: 240px; object-fit: contain;">
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="right-header-content mt-3 mt-md-0">
                         <ul
                             class="d-flex align-items-center justify-content-center justify-content-md-end ps-0 mb-0 list-unstyled">
                            <li class="header-right-item">
                                 <button id="themeToggle" class="btn btn-sm">
                                     <i class="ri-moon-line"></i>
                                 </button>
                             </li>

                             <li class="header-right-item">
                                 <div class="dropdown admin-profile">
                                     <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle"
                                         data-bs-toggle="dropdown">
                                         <div class="flex-shrink-0 position-relative">
                                              @php
                                                  $avatarPlaceholder = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" fill="%23eff3f9"/><circle cx="50" cy="40" r="20" fill="%2364748b"/><path d="M15,82 C15,65 30,55 50,55 C70,55 85,65 85,82" fill="%2364748b"/></svg>';
                                                  $userAvatar = auth()->user()->image ? asset('storage/' . auth()->user()->image) : $avatarPlaceholder;
                                              @endphp
                                              <img class="rounded-circle admin-img-width-for-mobile"
                                                  style="width: 40px; height: 40px; object-fit: cover;"
                                                  src="{{ $userAvatar }}"
                                                  alt="{{ auth()->user()->name }}"
                                                  onerror="this.src='{{ $avatarPlaceholder }}'">

                                             <span
                                                 class="d-block bg-success-60 border border-2 border-white rounded-circle position-absolute end-0 bottom-0"
                                                 style="width: 11px; height: 11px;">
                                             </span>
                                         </div>
                                     </div>


                                     <div class="dropdown-menu border-0 bg-white dropdown-menu-end">


                                         <ul class="admin-link mb-0 list-unstyled">

                                             <li>

                                                 <a class="dropdown-item admin-item-link d-flex align-items-center text-body"
                                                     href="#"
                                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                                     <img src="https://img.icons8.com/color/48/shutdown.png" style="width: 20px; height: 20px; object-fit: contain; margin-right: 8px;" alt="logout">
                                                     <span class="ms-2">Logout</span>


                                                 </a>

                                                 <form id="logout-form" action="{{ route('auth.logout') }}"
                                                     method="POST" style="display:none;">

                                                     @csrf

                                                 </form>

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
@push('scripts')
<script>
    const toggleBtn = document.getElementById("themeToggle");
    const icon = toggleBtn.querySelector("i");

    // Apply correct icon and body class on page load
    const currentSavedTheme = localStorage.getItem("theme") || "light";
    document.body.setAttribute("data-bs-theme", currentSavedTheme);
    if (currentSavedTheme === "dark") {
        document.body.classList.add("dark-mode");
        icon.className = "ri-moon-line";
    } else {
        document.body.classList.remove("dark-mode");
        icon.className = "ri-sun-line";
    }

    toggleBtn.addEventListener("click", () => {
        let activeTheme = document.documentElement.getAttribute("data-bs-theme");
        let newTheme = activeTheme === "dark" ? "light" : "dark";
        
        localStorage.setItem("theme", newTheme);
        document.documentElement.setAttribute("data-bs-theme", newTheme);
        document.body.setAttribute("data-bs-theme", newTheme);
        
        if (newTheme === "dark") {
            document.body.classList.add("dark-mode");
            icon.className = "ri-moon-line";
        } else {
            document.body.classList.remove("dark-mode");
            icon.className = "ri-sun-line";
        }
    });
</script>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
         <!-- End Header Area -->
