
<!-- ================= HEADER START ================= -->
<header>
<div class="position-absolute top-0 start-0 w-100 header-11">

    {{-- ================= TOP BAR ================= --}}
    <div class="top-bar bg-primary position-relative z-2">
        <div class="container d-flex flex-wrap gap-2 justify-content-md-between justify-content-center align-items-center">

            <div class="d-flex justify-content-center gap-3 align-self-stretch">
                <a href="mailto:{{ setting('site_email','info@example.com') }}"
                   class="fs-7 d-flex align-items-center border-start border-end border-opacity-10 border-white px-3">
                    <i class="ri-mail-open-line text-white"></i>
                    <span class="text-secondary-2">
                        &nbsp; {{ setting('site_email','info@example.com') }}
                    </span>
                </a>

                <a href="tel:{{ setting('site_phone','') }}"
                   class="fs-7 d-flex align-items-center border-end border-opacity-10 border-white pe-3">
                    <i class="ri-phone-line text-white"></i>
                    <span class="text-secondary-2">
                        {{ setting('site_phone','+000 000 0000') }}
                    </span>
                </a>
            </div>

            <div class="social-icons d-none d-md-flex">
                @foreach(['facebook','twitter','linkedin','instagram'] as $social)
                    @if(setting($social))
                        <a href="{{ setting($social) }}" target="_blank"
                           class="border border-opacity-10 border-white icon-shape icon-md text-white">
                            <i class="bi bi-{{ $social == 'twitter' ? 'twitter-x' : $social }}"></i>
                        </a>
                    @endif
                @endforeach
            </div>

        </div>
    </div>

    {{-- ================= NAVBAR ================= --}}
    <nav class="navbar navbar-expand-lg navbar-transparent border-bottom border-top border-white border-opacity-10 z-3 p-0 shadow-none">
        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand py-5 d-flex align-items-center gap-2" href="{{ route('index') }}">
                <img
                    src="{{ setting('logo')
                        ? asset('storage/'.setting('logo'))
                        : asset('frontend/imgs/template/favicon.svg') }}"
                    width="40" height="40" alt="logo">

                <h5 class="mb-0 text-white">
                    {{ setting('site_name','FrancoWay') }}
                </h5>
            </a>

            {{-- MENU --}}
            <div class="d-none d-lg-flex me-auto ms-5">
                <ul class="navbar-nav gap-4 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{ route('index') }}">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{ route('contactUs') }}">Contact</a>
                    </li>
                </ul>
            </div>

            {{-- AUTH --}}
            <div class="d-flex align-items-center gap-3">
                @auth
                    <a href="{{ route('logout') }}" class="btn btn-white btn-sm rounded-pill">
                        Logout
                    </a>
                @else
                    <a href="{{ route('auth.login') }}" class="btn btn-white btn-sm rounded-pill">
                        Login
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    {{-- ================= OFFCANVAS ================= --}}
    <div class="offCanvas__info">
        <div class="offCanvas__close-icon menu-close">
            <button class="btn-close"></button>
        </div>

        <div class="offCanvas__logo mb-30">
            <a class="d-flex align-items-center gap-2" href="{{ route('index') }}">
                <img
                    src="{{ setting('logo')
                        ? asset('storage/'.setting('logo'))
                        : asset('frontend/imgs/template/favicon.svg') }}"
                    width="35">
                <h5 class="mb-0 text-dark">
                    {{ setting('site_name','FrancoWay') }}
                </h5>
            </a>
        </div>

        <div class="offCanvas__side-info mb-30">
            <div class="contact-list mb-30">
                <h4>Address</h4>
                <p>{{ setting('address','Address not set') }}</p>
            </div>

            <div class="contact-list mb-30">
                <h4>Phone</h4>
                <p>{{ setting('site_phone','+000 000 0000') }}</p>
            </div>

            <div class="contact-list mb-30">
                <h4>Email</h4>
                <p>{{ setting('site_email','info@example.com') }}</p>
            </div>
        </div>

        <div class="offCanvas__social-icon mt-30">
            @foreach(['facebook','twitter','linkedin','instagram'] as $social)
                @if(setting($social))
                    <a href="{{ setting($social) }}">
                        <i class="bi bi-{{ $social == 'twitter' ? 'twitter-x' : $social }}"></i>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

</div>
</header>
<!-- ================= HEADER END ================= -->

