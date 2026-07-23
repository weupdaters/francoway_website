@extends('users.layouts.app')

@section('title', $lesson->title)

@section('content')

  <style>
    /* ===== Lesson Video Styling ===== */
    .lesson-video-wrapper {
      max-width: 800px;
      /* 👈 video size control */
      margin: 0 auto 20px;
      /* center + spacing */
    }

    .lesson-video-wrapper video,
    .lesson-video-wrapper iframe {
      width: 100%;
      height: auto;
      border-radius: 12px;
    }

    .lesson-content {
      max-width: 900px;
      margin: 0 auto;
    }
  </style>

  <div class="container-fluid py-4">

    {{-- Back Button --}}
    <div class="mb-3">
      <a href="{{ route('users.lessons.index', $course->id) }}" class="btn btn-outline-secondary">
        ← Back to Lessons
      </a>
    </div>

    {{-- Lesson Card --}}
    <div class="card shadow-sm rounded-10">
      <div class="card-body lesson-content">

        {{-- Lesson Title --}}
        <h3 class="mb-4 text-center">
          {{ $lesson->title }}
        </h3>

        {{-- ================= VIDEO SECTION ================= --}}

        {{-- YouTube / iframe video --}}
        @if ($lesson->video_url)
          <div class="lesson-video-wrapper">
            <div class="ratio ratio-16x9">
              <iframe src="{{ $lesson->video_url }}" allowfullscreen>
              </iframe>
            </div>
          </div>

          {{-- Uploaded video file --}}
        @elseif($lesson->video_file)
          <div class="lesson-video-wrapper">
            <video controls>
              <source src="{{ asset('storage/' . $lesson->video_file) }}">
              Your browser does not support the video tag.
            </video>
          </div>



          {{-- PDF file --}}
        @elseif($lesson->pdf_file)
          <div class="lesson-video-wrapper">
            <a href="{{ asset('storage/' . $lesson->pdf_file) }}" target="_blank"
              class="btn btn-outline-primary w-100 mb-2">
              View PDF
            </a>
          </div>
        @endif


        {{-- ================= DESCRIPTION ================= --}}
        @if ($lesson->description)
          <div class="mt-4">
            {!! $lesson->description !!}
          </div>
        @else
          <p class="text-muted text-center mt-4">
            No description available for this lesson.
          </p>
        @endif

      </div>
    </div>

  </div>
@endsection
