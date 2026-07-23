@extends('users.layouts.app')

@section('title', $course->title)

@section('content')

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-2">{{ $course->title }}</h4>
                <div class="text-muted small">
                    <i class="fas fa-book me-1"></i> {{ count($course->lessons) ?? 0 }} lessons
                </div>
            </div>

            {{-- breadcrumb & actions --}}
            <div class="d-flex align-items-center gap-3">
                @if($course->has_custom_prompt && $course->custom_prompt)
                    <a href="{{ route('ai.practice') }}?course_id={{ $course->id }}&quick_start=1" 
                       class="btn btn-primary text-white fw-bold rounded-pill px-4 shadow-sm hover-up d-flex align-items-center gap-2" 
                       style="background-color: #0d6efd !important; border-color: #0d6efd !important; transition: all 0.2s ease;">
                        <i class="fas fa-bolt text-warning"></i> Quick Start
                    </a>
                @endif
                <div class="text-end">
                    <div class="breadcrumb mb-0">
                        <a href="{{ route('users.dashboard') }}" class="breadcrumb-item">user dashboard</a>
                        <span class="breadcrumb-item active">{{ $course->title }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- ================= LEFT : COURSE CONTENT ================= --}}
            <div class="col-lg-3 col-xl-3">
                <div class="card border-0 shadow-sm h-100 bg-white rounded-10 border border-white">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="fw-bold mb-0 py-2">Course Content</h5>
                    </div>
                    <div class="card-body p-3">
                        @foreach ($sections as $section)
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <h6 class="fw-semibold mb-0 text-primary">
                                        {{ $section->title }}
                                    </h6>
                                    <span class="badge bg-light text-dark ms-2">{{ count($section->lessons) }}</span>
                                </div>

                                @foreach ($section->lessons as $lesson)
                                    @php
                                        $completed = auth()->user()->lessons->contains($lesson->id);
                                    @endphp

                                    <a href="{{ route('users.lessons.show', [$course->id, $lesson->id]) }}"
                                        class="d-flex align-items-center gap-2 px-3 py-2 rounded mb-2 text-decoration-none 
                                          {{ $currentLesson && $currentLesson->id === $lesson->id
                                              ? 'bg-primary text-white'
                                              : 'text-dark bg-light hover-bg-light' }}">

                                        <div class="d-flex align-items-center justify-content-center"
                                            style="min-width: 20px;">
                                            @if ($completed)
                                                <i class="fas fa-check-circle text-success"></i>
                                            @else
                                                <div class="rounded-circle border border-secondary"
                                                    style="width: 14px; height: 14px;"></div>
                                            @endif
                                        </div>

                                        <span class="small text-truncate flex-grow-1">
                                            {{ $lesson->title }}
                                        </span>

                                        @if ($lesson->video_file || $lesson->video_url)
                                            <i class="fas fa-play-circle text-muted ms-1"></i>
                                        @elseif($lesson->audio_file)
                                            <i class="fas fa-headphones text-muted ms-1"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ================= RIGHT : PLAYER ================= --}}
            <div class="col-lg-9 col-xl-9">
                <div class="card border-0 shadow-sm h-100 bg-white rounded-10 border border-white">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0">
                                {{ $currentLesson?->title ?? 'Select a lesson' }}
                            </h5>
                            @if ($currentLesson)
                                <button id="completeBtn" class="btn btn-secondary btn-sm px-4">
                                    <i class="fas fa-check me-1"></i> Mark as Completed
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @if ($currentLesson)
                            {{-- VIDEO --}}
                            @if ($currentLesson->video_file)
                                <div class="ratio ratio-16x9 rounded-3 overflow-hidden mb-4">
                                    <video id="lessonVideo" controls class="w-100">
                                        <source src="{{ url('storage/' . $currentLesson->video_file) }}">
                                    </video>
                                </div>

                                {{-- image --}}
                            @elseif($currentLesson->image_file)
                                <div class="ratio ratio-16x9 rounded-3 overflow-hidden mb-4">
                                    <img src="{{ url('storage/' . $currentLesson->image_file) }}"
                                        alt="{{ $currentLesson->title }}" class="w-100">
                                </div>


                                {{-- YOUTUBE --}}
                            @elseif($currentLesson->video_url)
                                @php
                                    $videoUrl = str_replace('watch?v=', 'embed/', $currentLesson->video_url);
                                @endphp
                                <div class="ratio ratio-16x9 rounded-3 overflow-hidden mb-4">
                                    <iframe src="{{ $videoUrl }}" allowfullscreen></iframe>
                                </div>

                                {{-- AUDIO --}}
                            @elseif($currentLesson->audio_file)
                                <div class="card bg-light border-0 mb-4">
                                    <div class="card-body p-4">
                                        <audio controls class="w-100">
                                            <source src="{{ url('storage/' . $currentLesson->audio_file) }}">
                                        </audio>
                                    </div>
                                </div>
                            @elseif($currentLesson->pdf_file)
                                {{-- preview pdf file --}}
                                <div class="lesson-video-wrapper">
                                    <a href="{{ asset('storage/' . $currentLesson->pdf_file) }}" target="_blank"
                                        class="btn btn-outline-primary w-100 mb-2">
                                        View PDF
                                    </a>
                                </div>
                            @endif

                            {{-- COMPLETE BUTTON (Center aligned for mobile) --}}
                            <div class="d-flex justify-content-center justify-content-lg-start mb-4">
                                <button id="completeBtn" class="btn btn-success px-4 d-lg-none">
                                    <i class="fas fa-check me-1"></i> Mark as Completed
                                </button>
                            </div>

                            {{-- COMMENTS --}}
                            <div class="border-top pt-4">
                                @foreach ($currentLesson->comments->where('parent_id', null) as $comment)
                                    <div>
                                        <strong>{{ $comment->user->name }}</strong>
                                        <p>{{ $comment->comment }}</p>

                                        {{-- ✅ Correct place --}}
                                        <button
                                            class="btn btn-sm btn-outline-primary reply-btn d-inline-flex align-items-center gap-1"
                                            data-id="{{ $comment->id }}">
                                            <i class="fas fa-reply"></i> Reply
                                        </button>
                                @endforeach



                                <form method="POST" action="{{ route('users.comment.store') }}" class="mb-4">
                                    @csrf
                                    <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">

                                    <textarea name="comment" class="form-control mb-2 rounded-3" rows="3" placeholder="Write a comment..." required></textarea>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary btn-sm px-4">
                                            <i class="fas fa-paper-plane me-1"></i> Post Comment
                                        </button>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('users.comment.store') }}"
                                    class="reply-form d-none mt-2">
                                    @csrf
                                    <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                                    <input type="hidden" name="parent_id" class="parent_id">

                                    <textarea name="comment" class="form-control mb-2" rows="2" placeholder="Write reply..."></textarea>

                                    <button class="btn btn-primary btn-sm">Reply</button>
                                </form>

                                <div class="comments-section">
                                    @forelse($currentLesson->comments as $comment)
                                        <div class="card border-light mb-3">
                                            <div class="card-body p-3">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                                            style="width: 36px; height: 36px; font-size: 14px;">
                                                            {{ substr($comment->user->name, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <h6 class="fw-semibold mb-1">{{ $comment->user->name }}</h6>
                                                            <small
                                                                class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <p class="mb-0 small">{{ $comment->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-4">
                                            <i class="fas fa-comments fa-2x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">No comments yet.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @else
                            {{-- NO LESSON SELECTED --}}
                            <div class="text-center py-5">
                                <i class="fas fa-play-circle fa-3x text-muted mb-4"></i>
                                <h5 class="fw-semibold mb-3">No lesson selected</h5>
                                <p class="text-muted mb-0">Choose a lesson from the sidebar to begin learning</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        .hover-shadow:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            background-color: #f8f9fa !important;
        }
        .hover-up {
            transition: all 0.2s ease;
        }
        .hover-up:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3) !important;
        }
    </style>

    {{-- ================= SCRIPTS (EXACT SAME LOGIC) ================= --}}
    @if ($currentLesson)
        <script>
            function markLessonCompleted() {
                fetch("{{ route('users.lesson.complete', [$course->id, $currentLesson->id]) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    const activeLesson = document.querySelector('.bg-primary');
                    if (activeLesson) {
                        const checkbox = activeLesson.querySelector('input[type="checkbox"]');
                        if (checkbox) checkbox.checked = true;
                    }
                });
            }

            document.getElementById('completeBtn')?.addEventListener('click', function() {
                markLessonCompleted();
            });

            document.getElementById('lessonVideo')?.addEventListener('ended', function() {
                markLessonCompleted();

                const next = document.querySelector('.bg-primary')?.nextElementSibling;
                if (next && next.href) {
                    setTimeout(() => {
                        window.location.href = next.href;
                    }, 800);
                }
            });
        </script>

       <script>
document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('.reply-btn').forEach(btn => {

        btn.addEventListener('click', function(){

            let parent = this.closest('.card-body'); // important fix
            let form = parent.querySelector('.reply-form');

            // hide all other forms
            document.querySelectorAll('.reply-form').forEach(f => {
                f.classList.add('d-none');
            });

            // show current form
            form.classList.remove('d-none');

            // set parent_id
            form.querySelector('.parent_id').value = this.dataset.id;

        });

    });

});
</script>
    @endif


@endsection
