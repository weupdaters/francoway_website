@extends('layouts.master')

@section('title', $course->title)

<main>

    <!-- HERO -->
    <section class="elearning-about-section-1 position-relative pt-250-keep pb-120 pb-lg-150 bg-primary rounded-bottom-4 overflow-hidden">
        <div class="container position-relative pt-8 text-center">
            <span class="content-top btn-text fw-bold text-white">
                <i class="ri-git-repository-line text-green-3"></i>
                &nbsp; #01 learning platform
            </span>
            <h1 class="text-white fs-80 lh-sm mb-0 text-anime-style-2">
                {{ $course->title }}
            </h1>
        </div>
    </section>

    <!-- COURSE DETAILS -->
    <section class="elearning-single-courses-section-2 position-relative pt-120 pb-120 rounded-bottom-4 overflow-hidden z-20">
        <div class="container">
            <div class="row">

                <!-- LEFT -->
                <div class="col-lg-8 pe-lg-5">

                    <div class="d-flex flex-wrap gap-5 mb-6">
                        <div>
                            <p class="fs-7 mb-0 text-capitalize">Level</p>
                            <p class="btn-text text-primary mb-0 mt-2">
                                {{ ucfirst($course->level) }}
                            </p>
                        </div>

                        <div>
                            <p class="fs-7 mb-0 text-capitalize">Status</p>
                            <p class="btn-text text-primary mb-0 mt-2">
                                {{ ucfirst($course->status) }}
                            </p>
                        </div>

                        <div>
                            <p class="fs-7 mb-0 text-capitalize">Price</p>
                            <p class="btn-text text-primary mb-0 mt-2">
                                ₹{{ $course->price }}
                            </p>
                        </div>
                    </div>

                    <!-- COVER IMAGE -->
                    <img class="rounded-4 mb-7 w-100"
                         src="{{ $course->cover_image
                                ? asset('storage/'.$course->cover_image)
                                : asset('assets/imgs/pages/learning/page-signle-courses/img-1.png') }}"
                         alt="{{ $course->title }}" />

                    <h4 class="mb-4">Course Description</h4>
                    <p>{!! nl2br(e($course->description)) !!}</p>

                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-lg-4 ps-lg-5 mt-lg-0 mt-8">

                    <div class="rounded-4 bg-secondary-2">

                        <img class="rounded-4 w-100"
                             src="{{ $course->thumbnail
                                    ? asset('storage/'.$course->thumbnail)
                                    : asset('assets/imgs/pages/learning/page-signle-courses/img-2.png') }}"
                             alt="{{ $course->title }}" />

                        <div class="p-5">

                            <h6 class="mb-3">Course Info</h6>

                            <div class="d-flex justify-content-between mb-3 border-bottom">
                                <p class="fw-medium text-primary mb-0 fs-7">Level</p>
                                <p class="fs-7">{{ ucfirst($course->level) }}</p>
                            </div>

                            <div class="d-flex justify-content-between mb-3 border-bottom">
                                <p class="fw-medium text-primary mb-0 fs-7">Status</p>
                                <p class="fs-7">{{ ucfirst($course->status) }}</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="btn btn-primary">
                                    Price: ₹{{ $course->price }}
                                </span>

                                <a href="#" class="btn btn-white bg-green-3 text-primary hover-up">
                                    enroll now
                                </a>
                            </div>

                            @if($course->trial_video)
                                <a href="{{ Str::startsWith($course->trial_video, ['http://', 'https://'])
                                            ? $course->trial_video
                                            : asset('storage/'.$course->trial_video) }}"
                                target="_blank"
                                class="btn btn-outline-primary w-100 mt-4">
                                    Watch Trial Video
                                </a>
                            @endif

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

</main>
