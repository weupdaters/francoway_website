@extends('teachers.layouts.app')

@section('content')
  <div class="container-fluid py-4">

    <div class="row g-4">

      {{-- ================= LESSON INFO (25%) ================= --}}
      <div class="col-lg-3">
        <div class="card p-3 h-100 bg-white rounded-10 border border-white">
          <h5 class="mb-3">Lesson Information</h5>

          <p class="mb-1 fw-semibold">Title</p>
          <p class="text-muted">{{ $lesson->title }}</p>

          <p class="mb-1 fw-semibold">Course</p>
          <p class="text-muted">{{ $lesson->course->title ?? 'N/A' }}</p>

          <p class="mb-1 fw-semibold">Description</p>
          <div class="text-muted" style="line-height:1.6; font-size:14px;">
            {!! $lesson->description ? $lesson->description : '<em>No description available</em>' !!}
          </div>

          <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" class="btn btn-primary btn-sm mt-3">
            Edit Lesson
          </a>

          <a href="{{ route('teacher.course_lessons_user.index', $lesson->course_id) }}"
            class="btn btn-outline-secondary btn-sm mt-2">
            Back
          </a>
        </div>
      </div>

      {{-- ================= MEDIA (75%) ================= --}}
      <div class="col-lg-9">
        <div class="card p-3 mb-4 bg-white rounded-10 border border-white">
          <h5 class="mb-3">Lesson Media</h5>

          {{-- VIDEO --}}
          @if ($lesson->video_file)
            <div style="width:100%; max-height:400px; overflow:hidden; border-radius:12px;">
              <video
                style="width:100%; height:400px; display:block; object-fit:contain; background:#000; border-radius:12px;"
                controls
                controlsList="nodownload"
                disablePictureInPicture>
                <source src="{{ asset('storage/' . $lesson->video_file) }}" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>

            {{-- AUDIO --}}
          @elseif($lesson->audio_file)
            <audio class="w-100" controls controlsList="nodownload" style="border-radius:12px;">
              <source src="{{ asset('storage/' . $lesson->audio_file) }}">
            </audio>

            {{-- PDF --}}
          @elseif($lesson->pdf_file)
            <iframe
              src="{{ asset('storage/' . $lesson->pdf_file) }}"
              style="width:100%; height:500px; border:none; border-radius:12px; display:block;">
            </iframe>

            {{-- IMAGE --}}
          @elseif($lesson->image_file)
            <div style="width:100%; text-align:center;">
              <img
                src="{{ asset('storage/' . $lesson->image_file) }}"
                style="max-width:100%; max-height:400px; width:auto; height:auto; object-fit:contain; border-radius:12px; display:block; margin:0 auto;"
                alt="Lesson Image">
            </div>

            {{-- SUMMARY --}}
          @elseif($lesson->summary)
            <div class="border p-3 rounded">
              {!! nl2br(e($lesson->summary)) !!}
            </div>
          @else
            <p class="text-danger">No media available</p>
          @endif
        </div>

        {{-- ================= COMMENTS ================= --}}
        <div class="card p-3 bg-white rounded-10 border border-white">
          <h5 class="mb-3">
            Comments ({{ $lesson->comments->count() }})
          </h5>

          @foreach ($lesson->comments as $comment)
            <div class="border rounded p-3 mb-3">

              <strong>{{ $comment->user->name }}</strong>
              <p class="mb-1">{{ $comment->comment }}</p>
              <small class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
              </small>

              {{-- REPLIES --}}
              @foreach ($comment->replies as $reply)
                <div class="border rounded p-2 mt-2 ms-4 bg-light">
                  <strong>{{ $reply->user->name }} (Teacher)</strong>
                  <p class="mb-0">{{ $reply->comment }}</p>
                </div>
              @endforeach

              {{-- TEACHER REPLY --}}
              <form method="POST" action="{{ route('teacher.comment.reply', $comment->id) }}" class="mt-2">
                @csrf
                <textarea name="comment" class="form-control mb-2" rows="2" placeholder="Reply as teacher..." required></textarea>
                <button class="btn btn-sm btn-secondary">
                  Reply
                </button>
              </form>

            </div>
          @endforeach

          {{-- ADD COMMENT --}}
          <form method="POST" action="{{ route('teacher.lesson.comment', $lesson->id) }}">
            @csrf
            <textarea name="comment" class="form-control mb-2" rows="3" placeholder="Add a comment..." required></textarea>
            <button class="btn btn-primary">
              Comment
            </button>
          </form>

        </div>
      </div>

    </div>
  </div>
@endsection
