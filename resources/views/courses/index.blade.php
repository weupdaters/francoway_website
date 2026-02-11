@extends('layouts.master')
@section('content')

<main>

    <!--learning about section 1-->
    <section class="elearning-about-section-1 position-relative pt-250-keep pb-120 pb-lg-150 bg-primary rounded-bottom-4 overflow-hidden">
        <div class="container position-relative pt-8 text-center">
            <span class="content-top btn-text fw-bold text-white">
                <i class="ri-git-repository-line text-green-3"></i>
                &nbsp; #01 learning platform
            </span>
            <h1 class="text-white fs-80 lh-sm mb-0 text-anime-style-2">
                Popular <span class="position-relative">courses</span>
            </h1>
        </div>
    </section>

    <!--learning courses section 2-->
    <section class="elearning-courses-section-2 position-relative pt-120 pb-120 rounded-bottom-4 overflow-hidden bg-secondary-2 z-20">
        <div class="container mt-6">
            <div class="masonary-active justify-content-between row">
                <div class="grid-sizer"></div>

                @forelse($courses as $course)

                <div class="filter-item col-12 col-lg-4 col-md-6 {{ $course->category }}">
                    <div class="card-news position-relative hover-up wow img-custom-anim-top">

                        <a href="{{ route('courses.show', $course->id) }}"
                           class="card-news-img position-relative d-block">

                            <img class="w-100 rounded-top-3"
                                 src="{{ asset('storage/courses/'.$course->image) }}"
                                 alt="{{ $course->title }}" />

                            <span class="text-uppercase text-dark bg-green-3 rounded-2 px-2 py-1
                                  position-absolute top-100 end-0 translate-middle-y me-5 fs-8 fw-bold">
                                price: ₹{{ $course->price }}
                            </span>
                        </a>

                        <div class="card-news-body p-5 pb-4 bg-white rounded-bottom-3">

                            <div class="card-news-title mt-3">
                                <h6 class="fs-6">
                                    <a href="{{ route('courses.show', $course->id) }}">
                                        {{ $course->title }}
                                    </a>
                                </h6>
                            </div>

                            <div class="d-flex card-news-information mt-4 gap-4 border-bottom pb-3">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="ri-book-marked-fill text-primary"></i>
                                    <p class="fs-7 text-uppercase mb-0">
                                        {{ $course->lessons ?? 0 }} Lessons
                                    </p>
                                </div>

                                <div class="d-flex align-items-center gap-1">
                                    <i class="ri-group-fill text-primary"></i>
                                    <p class="fs-7 text-uppercase mb-0">
                                        {{ $course->students ?? 0 }}+ students
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-4">
                                <div class="d-flex align-items-center gap-2">
                                    <p class="fs-7 mb-0 text-uppercase fw-medium text-primary">
                                        Admin
                                    </p>
                                </div>

                                <div class="d-flex align-items-center gap-1 ms-auto">
                                    <p class="fs-7 mb-0 text-uppercase fw-bold">
                                        <span class="text-primary">
                                            {{ $course->category }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @empty
                    <div class="col-12 text-center">
                        <h4>No courses found</h4>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

</main>


@endsection
