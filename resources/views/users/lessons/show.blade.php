@extends('users.layouts.app')

@section('title', $lesson->title)

@section('content')

  <style>
    /* ===== Lesson Media Styling ===== */
    .lesson-video-wrapper {
      max-width: 800px;
      margin: 0 auto 20px;
    }

    .lesson-video-wrapper video {
      width: 100%;
      height: 420px;
      display: block;
      object-fit: contain;
      background: #000;
      border-radius: 12px;
    }

    .lesson-video-wrapper iframe {
      width: 100%;
      border-radius: 12px;
      border: none;
    }

    .lesson-video-wrapper img {
      max-width: 100%;
      max-height: 420px;
      width: auto;
      height: auto;
      object-fit: contain;
      border-radius: 12px;
      display: block;
      margin: 0 auto;
    }

    .lesson-content {
      max-width: 900px;
      margin: 0 auto;
    }

    .lesson-description {
      line-height: 1.8;
      font-size: 15px;
      color: #4a5568;
    }

    .lesson-description p {
      margin-bottom: 1rem;
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

        {{-- ================= MEDIA SECTION ================= --}}

        {{-- YouTube / iframe video --}}
        @if ($lesson->video_url)
          <div class="lesson-video-wrapper">
            <div class="ratio ratio-16x9" style="border-radius:12px; overflow:hidden;">
              <iframe src="{{ $lesson->video_url }}" allowfullscreen style="border-radius:12px;"></iframe>
            </div>
          </div>

        {{-- Uploaded video file --}}
        @elseif($lesson->video_file)
          <div class="lesson-video-wrapper">
            <video controls controlsList="nodownload" disablePictureInPicture>
              <source src="{{ asset('storage/' . $lesson->video_file) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>

        {{-- PDF file --}}
        @elseif($lesson->pdf_file)
          <div class="lesson-video-wrapper">
            <iframe
              src="{{ asset('storage/' . $lesson->pdf_file) }}"
              style="width:100%; height:500px; border:none; border-radius:12px; display:block;">
            </iframe>
          </div>

        {{-- Image file --}}
        @elseif($lesson->image_file)
          <div class="lesson-video-wrapper" style="text-align:center;">
            <img src="{{ asset('storage/' . $lesson->image_file) }}" alt="{{ $lesson->title }}">
          </div>

        {{-- Audio file --}}
        @elseif($lesson->audio_file)
          <div class="lesson-video-wrapper">
            <audio controls class="w-100" style="border-radius:12px;">
              <source src="{{ asset('storage/' . $lesson->audio_file) }}">
              Your browser does not support the audio tag.
            </audio>
          </div>
        @endif


        {{-- ================= DESCRIPTION ================= --}}
        @if ($lesson->description)
          <div class="mt-4 lesson-description">
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
