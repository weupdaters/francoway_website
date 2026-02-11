@extends('layouts.master')

@section('title', $settings['meta_title'] ?? 'Contact Us')
@section('meta_description', $settings['meta_description'] ?? '')

@section('content')
<main>

    <!-- ================= HERO SECTION ================= -->
    <section class="elearning-blog-details-section-1 position-relative pt-250-keep pb-120 pb-lg-150 bg-primary rounded-bottom-4 overflow-hidden">

        <!-- decorative lines -->
        <div class="banner-line">
            <div class="vertical-effect border-opacity-10 border-end border-white raindrop"></div>
            <div class="vertical-effect border-opacity-10 border-end border-white"></div>
            <div class="vertical-effect border-opacity-10 border-end border-white raindrop-reverse"></div>
            <div class="vertical-effect border-opacity-10 border-end border-white"></div>
        </div>

        <div class="container position-relative pt-8 text-center">
            <span class="content-top btn-text fw-bold text-white">
                <i class="ri-git-repository-line text-green-3"></i>
                &nbsp; {{ $settings['site_tagline'] ?? '#01 learning platform' }}
            </span>

            <h1 class="text-white fs-80 lh-sm mb-0 text-anime-style-2">
                Contact
                <span class="position-relative">
                    us now
                    <span class="position-absolute top-0 start-0 pt-5 z-0 d-none d-md-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="268" height="22" viewBox="0 0 268 22" fill="none">
                            <path d="M2 20C70.6975 12.6711 219.674 -1.06621 266 2.61526"
                                  stroke="#D5D52B" stroke-width="3" stroke-linecap="round" />
                        </svg>
                    </span>
                </span>
            </h1>
        </div>
    </section>

    <!-- ================= CONTACT SECTION ================= -->
    <section class="elearning-contact-section-2 position-relative overflow-hidden py-120">
        <div class="container">
            <div class="row g-5">

                <!-- ===== CONTACT FORM ===== -->
                <div class="col-lg-6 pe-lg-8 col-12">

                    <span class="content-top btn-text fw-bold text-primary fs-7">
                        <i class="ri-git-repository-line text-primary opacity-50"></i>
                        &nbsp; let’s talk
                    </span>

                    <h2 class="mb-6 mt-3 text-anime-style-2">Get a free quote</h2>

                    {{-- success message --}}
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- validation errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST"
                          class="input-group mt-4 position-relative">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <label class="fs-7 fw-bold mb-3 text-primary">Full name</label>
                                <input type="text" name="name"
                                       class="form-control py-3"
                                       placeholder="Enter here"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="fs-7 fw-bold mb-3 text-primary">Email address</label>
                                <input type="email" name="email"
                                       class="form-control py-3"
                                       placeholder="Enter here"
                                       required>
                            </div>

                            <div class="col-12 mt-5">
                                <label class="fs-7 fw-bold mb-3 text-primary">Message</label>
                                <textarea name="message" rows="8"
                                          class="form-control py-3"
                                          placeholder="Enter here"
                                          required></textarea>
                            </div>

                            <div class="col-12 mt-5">
                                <button class="btn btn-primary hover-up" type="submit">
                                    <span>Submit</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 16 16" fill="none">
                                        <path d="M15.8167 7.55759L12.5504 4.307
                                                 C12.3057 4.06353 11.91 4.06444
                                                 11.6665 4.30912
                                                 C11.423 4.55378 11.4239 4.9495
                                                 11.6686 5.193L13.8612 7.375H0.625
                                                 C0.279813 7.375 0 7.65481 0 8
                                                 C0 8.34519 0.279813 8.625 0.625 8.625
                                                 H13.8612L11.6686 10.807
                                                 C11.4239 11.0505 11.423 11.4462
                                                 11.6665 11.6909
                                                 C11.91 11.9356 12.3058 11.9364
                                                 12.5504 11.693L15.8162 8.443
                                                 C16.0615 8.19809 16.0607 7.80109
                                                 15.8167 7.55759Z"
                                              fill="white"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- ===== CONTACT INFO ===== -->
                <div class="col-lg-6 ms-lg-auto">

                    <span class="content-top btn-text fw-bold text-primary fs-7">
                        <i class="ri-git-repository-line text-primary opacity-50"></i>
                        &nbsp; contact info
                    </span>

                    <h2 class="mb-6 mt-3 text-anime-style-2">
                        Choose our excellent company services
                    </h2>

                    <p>{{ $settings['site_tagline'] ?? '' }}</p>

                     <div class="d-flex flex-md-row flex-column gap-5">
                            <div data-aos="fade-up" data-aos-delay="0">
                    <div class="icon">
                                    <svg class="stroke-primary" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                        <g clip-path="url(#clip0_349_948)">
                                            <path d="M41.25 25C48.845 25 55 30.0375 55 36.25C55 39.7425 53.055 42.8625 50 44.925V50L45.09 47.055C43.8317 47.3522 42.543 47.5015 41.25 47.5C33.655 47.5 27.5 42.4625 27.5 36.25C27.5 30.0375 33.655 25 41.25 25Z" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M27.9925 39.245C26.2675 39.735 24.4175 40 22.5 40C20.2785 40.0048 18.0717 39.6398 15.97 38.92L10 42.5V35.4975C6.9075 32.7925 5 29.0875 5 25C5 16.715 12.835 10 22.5 10C31.955 10 39.6575 16.425 40 24.4625V25.045" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M25 20H25.025" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M17.5 20H17.525" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M37.5 35H37.525" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M45 35H45.025" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </div>

                    <div class="d-flex flex-md-row flex-column gap-5 mt-6">

                    
                    

                        <div>
                            <h6 class="fs-20">
                                {{ $settings['site_email'] ?? 'info@example.com' }}
                            </h6>
                            <p class="mb-0">Email support available</p>
                        </div>
                            <div data-aos="fade-up" data-aos-delay="200">
                        <div class="icon">
                                    <svg class="stroke-primary" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                        <g clip-path="url(#clip0_349_2617)">
                                            <path d="M29.8325 12.5H12.5V52.5H45V32.5" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M35 42.5H22.5" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M22.5 32.5H35V22.5H22.5V32.5Z" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M37.5 12.5V7.5" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M45 15L50 10" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M47.5 22.5H52.5" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </div>

                        <div>
                            <h6 class="fs-20">
                                {{ $settings['site_phone'] ?? '+91 00000 00000' }}
                            </h6>
                            <p class="mb-0">Call us anytime</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection
