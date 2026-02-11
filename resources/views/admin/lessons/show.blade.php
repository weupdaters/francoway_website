@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Lesson Details</h3>
    </div>

    <div class="row">

        {{-- LEFT --}}
        <div class="col-lg-8">
            <div class="card p-4 mb-4">

                <div class="mb-3">
                    <label class="fw-semibold">Lesson Title</label>
                    <p class="text-secondary mb-0">{{ $lesson->title }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Course</label>
                    <p class="text-secondary mb-0">
                        {{ optional($lesson->course)->title ?? 'N/A' }}
                    </p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Section</label>
                    <p class="text-secondary mb-0">
                        {{ optional($lesson->section)->title ?? 'N/A' }}
                    </p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Description</label>
                    <div class="text-secondary">
                        {!! $lesson->description ?: '<em>No description available</em>' !!}
                    </div>
                </div>

            </div>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">
            <div class="card p-4 mb-4">

                <h5 class="mb-3">Lesson Media</h5>

                {{-- VIDEO --}}
                @if($lesson->video_file)
                    <video controls width="100%" class="mb-3 rounded">
                        <source src="{{ asset('storage/'.$lesson->video_file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                {{-- AUDIO --}}
                @elseif($lesson->audio_file)
                    <audio controls class="w-100 mb-3">
                        <source src="{{ asset('storage/'.$lesson->audio_file) }}" type="audio/mpeg">
                    </audio>

                {{-- PDF --}}
                @elseif($lesson->pdf_file)
                    <a href="{{ asset('storage/'.$lesson->pdf_file) }}"
                       target="_blank"
                       class="btn btn-outline-primary w-100 mb-2">
                        View PDF
                    </a>

                {{-- IMAGE --}}
                @elseif($lesson->image_file)
                    <img src="{{ asset('storage/'.$lesson->image_file) }}"
                         class="img-fluid rounded mb-3">

                @else
                    <p class="text-muted">No media available</p>
                @endif

                {{-- Buttons --}}
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.lessons.edit', [$lesson->course_id, $lesson->id]) }}"
                       class="btn btn-primary w-50">
                        Edit
                    </a>

                    <a href="{{ route('admin.lessons.index', $lesson->course_id) }}"
                       class="btn btn-outline-secondary w-50">
                        Back
                    </a>
                </div>

            </div>
        </div>

    </div>

    {{-- COMMENTS --}}
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card p-4">

                <h5 class="mb-3">
                    Lesson Comments
                    <span class="text-muted">
                        ({{ $lesson->comments->count() ?? 0 }})
                    </span>
                </h5>

                @forelse($lesson->comments as $comment)
                    <div class="border rounded p-3 mb-2">

                        <strong>{{ optional($comment->user)->name ?? 'User Deleted' }}</strong>

                        <p class="mb-1">{{ $comment->comment }}</p>

                        <small class="text-muted">
                            {{ $comment->created_at->diffForHumans() }}
                        </small>

                        <form method="POST"
                              action="{{ route('admin.lesson-comments.destroy', $comment->id) }}"
                              class="mt-2"
                              onsubmit="return confirm('Delete this comment?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted mb-0">No comments found.</p>
                @endforelse

            </div>
        </div>
    </div>

</div>

@endsection
