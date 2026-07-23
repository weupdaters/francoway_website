@extends('users.layouts.app')

@section('title', $course->title)

@section('content')

@php
    $totalLessons = count($course->lessons) > 0 ? count($course->lessons) : 0;
    $completedCount = auth()->user()->lessons()->where('course_id', $course->id)->count();
    $completionPercentage = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;

    // Course Initials Badge (e.g. FR for Intermediate French)
    $words = explode(' ', $course->title);
    $initials = '';
    if (count($words) >= 2) {
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
    } else {
        $initials = strtoupper(substr($course->title, 0, 2));
    }
@endphp

<div class="container-fluid px-0 py-2">

    {{-- TOP NAVIGATION BREADCRUMB & BACK LINK --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
        <div>
            <a href="{{ route('users.courses.index') }}" class="text-decoration-none fw-semibold text-secondary d-inline-flex align-items-center gap-2 hover-red">
                <i class="bi bi-arrow-left"></i> Back to My Courses
            </a>
        </div>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 align-items-center" style="font-size: 13px;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.courses.index') }}" class="text-decoration-none text-secondary">My Courses</a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">{{ $course->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- HERO COURSE CARD BANNER --}}
    <div class="course-hero-card mb-4">
        <div class="row align-items-center g-4">
            
            {{-- LEFT: COURSE DETAILS & BADGES --}}
            <div class="col-lg-7 col-md-12">
                <div class="d-flex align-items-start gap-3">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="course-icon-badge object-fit-cover">
                    @else
                        <div class="course-icon-badge">
                            {{ $initials }}
                        </div>
                    @endif
                    
                    <div class="flex-grow-1">
                        <h3 class="course-title-text mb-2">{{ $course->title }}</h3>
                        <p class="course-desc-text mb-3">
                            {{ $course->description ?? 'Strengthen your skills with comprehensive grammar, vocabulary, and interactive practice.' }}
                        </p>
                        
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="meta-pill">
                                <i class="bi bi-journal-text text-danger"></i> {{ $totalLessons }} Lessons
                            </span>
                            <span class="meta-pill">
                                <i class="bi bi-clock text-secondary"></i> 18h 30m
                            </span>
                            <span class="meta-pill meta-pill-success">
                                <i class="bi bi-check-circle-fill me-1"></i> In Progress
                            </span>

                            @if($course->has_custom_prompt && $course->custom_prompt)
                                <a href="{{ route('ai.practice') }}?course_id={{ $course->id }}&quick_start=1" 
                                   class="btn btn-sm btn-primary text-white fw-bold rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1 ms-lg-2" 
                                   style="background-color: #0d6efd !important; border-color: #0d6efd !important;">
                                    <i class="bi bi-lightning-charge-fill text-warning"></i> AI Practice
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- CENTER DECORATIVE ILLUSTRATION --}}
            <div class="col-lg-2 d-none d-lg-flex align-items-center justify-content-center">
                <div class="text-center opacity-75">
                    <svg width="110" height="90" viewBox="0 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 70L60 20L100 70H20Z" fill="#E2E8F0" stroke="#CBD5E1" stroke-width="2"/>
                        <path d="M45 45H75" stroke="#94A3B8" stroke-width="3" stroke-linecap="round"/>
                        <circle cx="60" cy="35" r="5" fill="#E53935"/>
                        <path d="M15 80C30 75 90 75 105 80" stroke="#64748B" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            {{-- RIGHT: PROGRESS CARD --}}
            <div class="col-lg-3 col-md-12 d-flex justify-content-lg-end justify-content-start">
                <div class="progress-card-box">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-secondary fw-semibold" style="font-size: 13px;">
                            <i class="bi bi-pie-chart-fill text-danger me-1"></i> Your Progress
                        </span>
                    </div>
                    <div class="fw-bold mb-2 text-dark-slate" style="font-size: 18px;">
                        {{ $completionPercentage }}% <span class="fw-medium text-muted" style="font-size: 14px;">Completed</span>
                    </div>
                    <div class="progress mb-2" style="height: 8px; background-color: #E2E8F0; border-radius: 10px;">
                        <div class="progress-bar progress-bar-gradient" role="progressbar" 
                             style="width: {{ $completionPercentage }}%;" 
                             aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text-muted text-center fw-medium mt-1" style="font-size: 12px;">
                        Keep going! You're doing great.
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MAIN BODY: LEFT CONTENT NAV & RIGHT PLAYER --}}
    <div class="row g-4">
        
        {{-- ================= LEFT : COURSE CONTENT NAVIGATION ================= --}}
        <div class="col-lg-3 col-xl-3">
            <div class="card border-0 shadow-sm bg-white rounded-20 h-100 p-3" style="border: 1px solid #EAEAEA !important;">
                
                <h5 class="fw-bold text-dark-slate mb-3 px-2 pt-2" style="font-size: 18px;">
                    Course Content
                </h5>

                {{-- TABS LIST --}}
                <div class="nav flex-column nav-pills custom-course-tabs mb-3" id="course-tab-list" role="tablist">
                    
                    {{-- 1. LESSONS TAB --}}
                    <button class="nav-link active d-flex align-items-center justify-content-between text-start mb-2 px-3 py-3 rounded-12" 
                            id="tab-lessons-btn" data-bs-toggle="pill" data-bs-target="#tab-lessons" type="button" role="tab">
                        <span class="d-flex align-items-center gap-2">
                            <span>Lessons</span>
                            <span class="badge rounded-pill bg-danger-subtle text-danger px-2 py-1" style="font-size: 11px;">
                                {{ $totalLessons }}
                            </span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </button>

                    {{-- 2. QUIZZES TAB --}}
                    <button class="nav-link d-flex align-items-center justify-content-between text-start mb-2 px-3 py-3 rounded-12" 
                            id="tab-quizzes-btn" data-bs-toggle="pill" data-bs-target="#tab-quizzes" type="button" role="tab">
                        <span class="d-flex align-items-center gap-2">
                            <span>Quizzes</span>
                            <span class="badge rounded-pill bg-danger-subtle text-danger px-2 py-1" style="font-size: 11px;">
                                0
                            </span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </button>

                    {{-- 3. RESOURCES TAB --}}
                    <button class="nav-link d-flex align-items-center justify-content-between text-start mb-2 px-3 py-3 rounded-12" 
                            id="tab-resources-btn" data-bs-toggle="pill" data-bs-target="#tab-resources" type="button" role="tab">
                        <span class="d-flex align-items-center gap-2">
                            <span>Resources</span>
                            @php
                                $pdfCount = $course->lessons->whereNotNull('pdf_file')->count();
                            @endphp
                            <span class="badge rounded-pill bg-danger-subtle text-danger px-2 py-1" style="font-size: 11px;">
                                {{ $pdfCount }}
                            </span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </button>

                    {{-- 4. CERTIFICATE TAB --}}
                    <button class="nav-link d-flex align-items-center justify-content-between text-start px-3 py-3 rounded-12" 
                            id="tab-certificate-btn" data-bs-toggle="pill" data-bs-target="#tab-certificate" type="button" role="tab">
                        <span class="d-flex align-items-center gap-2">
                            <span>Certificate</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </button>

                </div>

                <hr class="my-2 text-muted opacity-25">

                {{-- TAB PANES CONTENT --}}
                <div class="tab-content" id="course-tab-content">
                    
                    {{-- TAB 1: LESSONS LIST --}}
                    <div class="tab-pane fade show active" id="tab-lessons" role="tabpanel">
                        <div class="lessons-scroll-wrapper" style="max-height: 480px; overflow-y: auto; padding-right: 4px;">
                            @foreach ($sections as $section)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2 px-1">
                                        <h6 class="fw-bold mb-0 text-dark-slate" style="font-size: 13.5px;">
                                            {{ $section->title }}
                                        </h6>
                                        <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 10px; border-radius: 8px;">
                                            {{ count($section->lessons) }}
                                        </span>
                                    </div>

                                    @foreach ($section->lessons as $lesson)
                                        @php
                                            $isCompleted = auth()->user()->lessons->contains($lesson->id);
                                            $isActive = $currentLesson && $currentLesson->id === $lesson->id;
                                        @endphp

                                        <a href="{{ route('users.lessons.show', [$course->id, $lesson->id]) }}"
                                           class="lesson-item-link {{ $isActive ? 'active-lesson' : '' }}">

                                            <div class="d-flex align-items-center justify-content-center" style="min-width: 18px;">
                                                @if ($isCompleted)
                                                    <i class="bi bi-check-circle-fill text-success" style="{{ $isActive ? 'color: #ffffff !important;' : '' }}"></i>
                                                @else
                                                    <div class="rounded-circle border" style="width: 14px; height: 14px; border-color: #94A3B8 !important;"></div>
                                                @endif
                                            </div>

                                            <span class="small text-truncate flex-grow-1 font-fw">
                                                {{ $lesson->title }}
                                            </span>

                                            @if ($lesson->video_file || $lesson->video_url)
                                                <i class="bi bi-play-circle text-muted ms-1 small"></i>
                                            @elseif($lesson->audio_file)
                                                <i class="bi bi-headphones text-muted ms-1 small"></i>
                                            @elseif($lesson->pdf_file)
                                                <i class="bi bi-file-earmark-pdf text-muted ms-1 small"></i>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- TAB 2: QUIZZES --}}
                    <div class="tab-pane fade" id="tab-quizzes" role="tabpanel">
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-question-square fs-3 text-secondary mb-2 d-block"></i>
                            <p class="small mb-0">No quizzes available for this course yet.</p>
                        </div>
                    </div>

                    {{-- TAB 3: RESOURCES --}}
                    <div class="tab-pane fade" id="tab-resources" role="tabpanel">
                        <div class="p-2">
                            @php
                                $resourcesCount = 0;
                            @endphp
                            @foreach($course->lessons as $l)
                                @if($l->pdf_file)
                                    @php $resourcesCount++; @endphp
                                    <a href="{{ asset('storage/' . $l->pdf_file) }}" target="_blank" class="d-flex align-items-center justify-content-between p-2 mb-2 rounded border text-decoration-none text-dark bg-light hover-bg-light">
                                        <div class="d-flex align-items-center gap-2 text-truncate">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger fs-5"></i>
                                            <span class="small font-fw text-truncate">{{ $l->title }} PDF</span>
                                        </div>
                                        <i class="bi bi-download text-muted small"></i>
                                    </a>
                                @endif
                            @endforeach

                            @if($resourcesCount === 0)
                                <div class="text-center py-4 text-muted">
                                    <i class="bi bi-folder2-open fs-3 text-secondary mb-2 d-block"></i>
                                    <p class="small mb-0">No resource files attached.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- TAB 4: CERTIFICATE --}}
                    <div class="tab-pane fade" id="tab-certificate" role="tabpanel">
                        <div class="text-center py-4">
                            <i class="bi bi-award fs-1 text-warning mb-2 d-block"></i>
                            <h6 class="fw-bold text-dark-slate mb-1">Course Certificate</h6>
                            @if($completionPercentage >= 100)
                                <p class="small text-success mb-3">Congratulations! You completed 100% of this course.</p>
                                <button class="btn btn-sm btn-success rounded-pill px-3">
                                    <i class="bi bi-download me-1"></i> Download Certificate
                                </button>
                            @else
                                <p class="small text-muted mb-0">Complete all {{ $totalLessons }} lessons to earn your certificate of completion.</p>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- ================= RIGHT : LESSON DISPLAY / PLAYER ================= --}}
        <div class="col-lg-9 col-xl-9">
            <div class="card border-0 shadow-sm bg-white rounded-20 h-100 p-4" style="border: 1px solid #EAEAEA !important;">
                
                {{-- HEADER AREA --}}
                <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark-slate" style="font-size: 20px;">
                        {{ $currentLesson?->title ?? 'Select a lesson' }}
                    </h5>

                    @if ($currentLesson)
                        <button id="completeBtn" class="btn btn-success btn-sm px-4 rounded-pill shadow-sm d-flex align-items-center gap-1">
                            <i class="bi bi-check-lg"></i> Mark as Completed
                        </button>
                    @endif
                </div>

                {{-- CARD BODY AREA --}}
                <div>
                    @if ($currentLesson)
                        
                        {{-- LESSON VIDEO FILE --}}
                        @if ($currentLesson->video_file)
                            <div class="ratio ratio-16x9 rounded-16 overflow-hidden mb-4 shadow-sm">
                                <video id="lessonVideo" controls class="w-100">
                                    <source src="{{ url('storage/' . $currentLesson->video_file) }}">
                                </video>
                            </div>

                        {{-- LESSON IMAGE FILE --}}
                        @elseif($currentLesson->image_file)
                            <div class="ratio ratio-16x9 rounded-16 overflow-hidden mb-4 shadow-sm">
                                <img src="{{ url('storage/' . $currentLesson->image_file) }}"
                                     alt="{{ $currentLesson->title }}" class="w-100 object-fit-cover">
                            </div>

                        {{-- YOUTUBE / VIDEO URL --}}
                        @elseif($currentLesson->video_url)
                            @php
                                $videoUrl = str_replace('watch?v=', 'embed/', $currentLesson->video_url);
                            @endphp
                            <div class="ratio ratio-16x9 rounded-16 overflow-hidden mb-4 shadow-sm">
                                <iframe src="{{ $videoUrl }}" allowfullscreen></iframe>
                            </div>

                        {{-- AUDIO FILE --}}
                        @elseif($currentLesson->audio_file)
                            <div class="card bg-light border-0 mb-4 rounded-16">
                                <div class="card-body p-4">
                                    <audio controls class="w-100">
                                        <source src="{{ url('storage/' . $currentLesson->audio_file) }}">
                                    </audio>
                                </div>
                            </div>

                        {{-- PDF FILE --}}
                        @elseif($currentLesson->pdf_file)
                            <div class="lesson-pdf-wrapper mb-4 text-center p-4 bg-light rounded-16">
                                <i class="bi bi-file-earmark-pdf text-danger fs-1 mb-2 d-block"></i>
                                <h6 class="fw-bold text-dark-slate mb-3">Lesson Document (PDF)</h6>
                                <a href="{{ asset('storage/' . $currentLesson->pdf_file) }}" target="_blank"
                                   class="btn btn-outline-danger px-4 rounded-pill">
                                    <i class="bi bi-eye me-1"></i> View / Download PDF
                                </a>
                            </div>
                        @endif

                        {{-- LESSON DESCRIPTION --}}
                        @if($currentLesson->description)
                            <div class="mb-4 text-secondary leading-relaxed font-fw" style="font-size: 14.5px;">
                                {!! nl2br(e($currentLesson->description)) !!}
                            </div>
                        @endif

                        {{-- COMMENTS & DISCUSSION SECTION --}}
                        <div class="border-top pt-4 mt-4">
                            <h6 class="fw-bold text-dark-slate mb-3">
                                <i class="bi bi-chat-left-text me-1 text-danger"></i> Lesson Discussion
                            </h6>

                            <form method="POST" action="{{ route('users.comment.store') }}" class="mb-4">
                                @csrf
                                <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                                <textarea name="comment" class="form-control mb-2 rounded-12 p-3 font-fw" rows="3" placeholder="Ask a question or share your feedback..." required style="border-color: #E2E8F0;"></textarea>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm" style="background-color: #E53935 !important; border-color: #E53935 !important;">
                                        <i class="bi bi-send me-1"></i> Post Comment
                                    </button>
                                </div>
                            </form>

                            <div class="comments-section">
                                @forelse($currentLesson->comments->where('parent_id', null) as $comment)
                                    <div class="card border-light mb-3 rounded-12 shadow-2xs" style="background: #F8FAFC; border: 1px solid #EAEAEA !important;">
                                        <div class="card-body p-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                                                         style="width: 38px; height: 38px; font-size: 14px; background: #071530;">
                                                        {{ substr($comment->user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                                        <h6 class="fw-bold text-dark-slate mb-0" style="font-size: 14px;">{{ $comment->user->name }}</h6>
                                                        <small class="text-muted" style="font-size: 11px;">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="mb-2 text-secondary font-fw" style="font-size: 13.5px;">{{ $comment->comment }}</p>

                                                    <button class="btn btn-sm text-danger p-0 border-0 bg-transparent reply-btn d-inline-flex align-items-center gap-1 font-fw"
                                                            data-id="{{ $comment->id }}" style="font-size: 12px; font-weight: 600;">
                                                        <i class="bi bi-reply-fill"></i> Reply
                                                    </button>

                                                    {{-- REPLIES LIST --}}
                                                    @foreach($currentLesson->comments->where('parent_id', $comment->id) as $reply)
                                                        <div class="mt-3 ps-3 border-start border-2 border-danger-subtle">
                                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                                <span class="fw-bold text-dark-slate" style="font-size: 13px;">{{ $reply->user->name }}</span>
                                                                <small class="text-muted" style="font-size: 10px;">{{ $reply->created_at->diffForHumans() }}</small>
                                                            </div>
                                                            <p class="mb-0 text-secondary font-fw" style="font-size: 13px;">{{ $reply->comment }}</p>
                                                        </div>
                                                    @endforeach

                                                    {{-- REPLY FORM --}}
                                                    <form method="POST" action="{{ route('users.comment.store') }}" class="reply-form d-none mt-3">
                                                        @csrf
                                                        <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                                                        <input type="hidden" name="parent_id" class="parent_id" value="{{ $comment->id }}">
                                                        <textarea name="comment" class="form-control mb-2 rounded-10" rows="2" placeholder="Write a reply..."></textarea>
                                                        <button class="btn btn-danger btn-sm rounded-pill px-3" style="background-color: #E53935; border-color: #E53935;">Reply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="bi bi-chat-left-dots text-muted fs-2 mb-2 d-block"></i>
                                        <p class="text-muted mb-0 small">No comments yet. Start the conversation!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    @else
                        
                        {{-- NO LESSON SELECTED STATE (MATCHING USER MOCKUP EXACTLY) --}}
                        <div class="text-center py-5 my-4">
                            <div class="empty-state-circle">
                                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 19.5C4 18.837 4.26339 18.2011 4.73223 17.7322C5.20107 17.2634 5.83696 17 6.5 17H20" stroke="#E53935" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.5 2H20V22H6.5C5.83696 22 5.20107 21.7366 4.73223 21.2678C4.26339 20.7989 4 20.163 4 19.5V4.5C4 3.83696 4.26339 3.20107 4.73223 2.73223C5.20107 2.26339 5.83696 2 6.5 2Z" stroke="#E53935" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 7H15" stroke="#E53935" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M9 11H15" stroke="#E53935" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold text-dark-slate mb-2" style="font-size: 20px;">No lesson selected</h5>
                            <p class="text-secondary mb-0" style="font-size: 14px;">Choose a lesson from the sidebar to begin learning.</p>
                        </div>

                    @endif
                </div>

            </div>
        </div>

    </div>

</div>

{{-- STYLES FOR UNIFORM FONT & DESIGN --}}
<style>
    /* Uniform Font & Color Variables */
    :root {
        --font-main: 'Poppins', 'Outfit', system-ui, -apple-system, sans-serif;
        --text-dark: #071530;
        --text-sub: #5A6A85;
        --red-primary: #E53935;
    }

    body, button, input, textarea, select {
        font-family: var(--font-main) !important;
    }

    .text-dark-slate {
        color: var(--text-dark) !important;
    }
    .text-secondary {
        color: var(--text-sub) !important;
    }
    .font-fw {
        font-family: var(--font-main) !important;
    }

    .hover-red:hover {
        color: var(--red-primary) !important;
    }

    .rounded-12 { border-radius: 12px !important; }
    .rounded-16 { border-radius: 16px !important; }
    .rounded-20 { border-radius: 20px !important; }

    /* Course Hero Card */
    .course-hero-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #EAEAEA;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 26px 30px;
    }
    .course-icon-badge {
        width: 76px;
        height: 76px;
        min-width: 76px;
        border-radius: 18px;
        background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: 1px;
    }
    .course-title-text {
        color: var(--text-dark) !important;
        font-weight: 700;
        font-size: 22px;
        line-height: 1.3;
    }
    .course-desc-text {
        color: var(--text-sub) !important;
        font-size: 14px;
        line-height: 1.5;
    }
    .meta-pill {
        background-color: #F8FAFC;
        border: 1px solid #E2E8F0;
        color: var(--text-sub) !important;
        font-weight: 600;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .meta-pill-success {
        background-color: #E6F4EA;
        border: 1px solid #C3E6CB;
        color: #1E7E34 !important;
    }

    /* Progress Box */
    .progress-card-box {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #EAEAEA;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        padding: 18px 22px;
        width: 260px;
    }
    .progress-bar-gradient {
        background: linear-gradient(90deg, #E53935 0%, #FF6B6B 100%) !important;
    }

    /* Left Navigation List */
    .custom-course-tabs .nav-link {
        background: #F8FAFC;
        color: var(--text-sub) !important;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    .custom-course-tabs .nav-link:hover {
        background: #FFF5F5;
        color: var(--red-primary) !important;
    }
    .custom-course-tabs .nav-link.active {
        background: #FDF2F2 !important;
        color: var(--red-primary) !important;
        border-color: #F87171 !important;
    }

    /* Lesson Items */
    .lesson-item-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        text-decoration: none;
        color: var(--text-dark) !important;
        background: #ffffff;
        border: 1px solid #F1F5F9;
        transition: all 0.2s ease;
        margin-bottom: 8px;
        font-size: 13.5px;
        font-weight: 500;
    }
    .lesson-item-link:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
        color: var(--red-primary) !important;
    }
    .lesson-item-link.active-lesson {
        background: var(--red-primary) !important;
        color: #ffffff !important;
        border-color: var(--red-primary) !important;
    }
    .lesson-item-link.active-lesson i,
    .lesson-item-link.active-lesson span {
        color: #ffffff !important;
    }

    /* Empty State Illustration */
    .empty-state-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #FDF2F2;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
    }
</style>

{{-- SCRIPTS FOR INTERACTIVITY --}}
@if ($currentLesson)
<script>
    function markLessonCompleted() {
        fetch("{{ route('users.lesson.complete', [$course->id, $currentLesson->id]) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            const completeBtn = document.getElementById('completeBtn');
            if (completeBtn) {
                completeBtn.classList.remove('btn-success');
                completeBtn.classList.add('btn-secondary');
                completeBtn.innerHTML = '<i class="bi bi-check-all"></i> Completed';
            }
        });
    }

    document.getElementById('completeBtn')?.addEventListener('click', function() {
        markLessonCompleted();
    });

    document.getElementById('lessonVideo')?.addEventListener('ended', function() {
        markLessonCompleted();
    });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function(){
    // Reply toggle logic
    document.querySelectorAll('.reply-btn').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            let parent = this.closest('.flex-grow-1');
            let form = parent.querySelector('.reply-form');

            document.querySelectorAll('.reply-form').forEach(f => {
                if (f !== form) f.classList.add('d-none');
            });

            form.classList.toggle('d-none');
        });
    });
});
</script>

@endsection
