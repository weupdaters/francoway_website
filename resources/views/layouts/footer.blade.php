<footer>
    <div class="section-footer-11 position-relative overflow-hidden">
        <div class="container-fluid">
            <div class="container position-relative z-2">

                {{-- ================= TOP FOOTER ================= --}}
                <div class="row pt-120 pb-120 g-lg-0 g-5">

                    {{-- COMPANY --}}
                    <div class="col-lg-3">
                        <div class="text-center position-relative">
                            <h6 class="pb-3 text-white">Company</h6>

                            <div class="d-flex flex-column">
                                <a href="{{route('home') }}">   
                                    <p class="hover-effect-1 opacity-75 text-white">Home</p>
                                </a>
                               
                               
                                
                                <a href="{{ route('contactUs') }}">
                                    <p class="hover-effect-1 opacity-75 text-white">Contact Us</p>
                                </a>
                            </div>
                        </div>
                        
                    </div>

                    {{-- BRAND / ADDRESS --}}
                    <div class="col-lg-6 d-flex flex-column align-items-center gap-4    text-center position-relative ">
                        <div class="position-relative text-center">
                              <a class="navbar-brand py-5 d-flex align-items-center gap-2" href="{{ route('index') }}">
                                <img class="d-inline-flex align-items-center gap-2"
                                    src="{{ setting('logo')
                                        ? asset('storage/'.setting('logo'))
                                        : asset('frontend/imgs/template/favicon.svg') }}"
                                    width="40" height="40" alt="logo">

                                <h5 class="mb-0 text-white">
                                    {{ setting('site_name','FrancoWay') }}
                                </h5>
                            </a>
                        <P class="text-secondary-2 opacity-75">
                            {{ setting('site_address','123 Main Street, City, Country') }}
                        </P>                            

                     <a href="mailto:{{ setting('site_email','info@example.com') }}"
                   class="fs-7 d-flex align-items-center border-start border-end border-opacity-10 border-white px-3">
                    <i class="ri-mail-open-line text-white"></i>
                    <span class="text-secondary-2">
                        &nbsp; {{ setting('site_email','info@example.com') }}
                    </span>
                </a>
                        </div>
                    </div>

                    {{-- SUBJECTS --}}
                    <div class="col-lg-3">
                        <div class="text-center position-relative">
                            <h6 class="pb-3 text-white">Popular Courses</h6>

                            <div class="d-flex flex-column">
                                <a href="#">
                                    <p class="hover-effect-1 opacity-75 text-white">Web Development</p>
                                </a>
                                <a href="#">
                                    <p class="hover-effect-1 opacity-75 text-white">UI / UX Design</p>
                                </a>
                                <a href="#">
                                    <p class="hover-effect-1 opacity-75 text-white">Data Science</p>
                                </a>
                                <a href="#">
                                    <p class="hover-effect-1 opacity-75 text-white">Digital Marketing</p>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= CTA ================= --}}
                <div class="bg-green-3 rounded-3 p-md-5 p-4 text-center
                            d-flex align-items-center justify-content-lg-between
                            justify-content-center flex-wrap">

                    <h5 class="mb-lg-0 mb-4">
                        Start learning today and upgrade your skills for tomorrow.
                    </h5>

                    <a href="{{ url('auth.register') }}" class="btn btn-primary hover-up">
                        Connect with us
                    </a>
                </div>

                {{-- ================= COPYRIGHT ================= --}}
                <div class="text-center py-4 d-flex align-items-center justify-content-center flex-wrap">
                    <p class="text-white opacity-50 mb-0">
                        © 2025 
                        <a href="https://weupdaters.com" target="_blank"
                           class="text-white fw-medium text-decoration-none">
                            weupdaters
                        </a>
                        All Rights Reserved
                    </p>
                </div>

            </div>

            <div class="bg-primary position-absolute top-0 start-0 w-100 h-100"></div>
        </div>
    </div>
</footer>
