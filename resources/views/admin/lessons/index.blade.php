@extends('admin.layouts.app')

@section('title', 'Lessons List')

@section('content')

  <div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
      <h3 class="mb-0">Lessons</h3>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14">Dashboard</span>
            </a>
          </li>
          <li class="breadcrumb-item active">
          <a href="{{ route('admin.courses.index', $course->id) }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14 hover">course</span>
            </a>
          </li>
          <li class="breadcrumb-item active">
            <span class="text-secondary">Lessons</span>
          </li>
        </ol>
      </nav>
    </div>

    {{-- Main Card --}}
    <div class="card bg-white rounded-10 border-0 mb-4">

      {{-- Top Bar --}}
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20 border-bottom">
        <h4 class="mb-0">Lessons List</h4>

        <div class="d-flex gap-3">

          <a href="{{ route('admin.lessons.create', $course->id) }}" class="btn btn-primary">
            + Create Lesson
          </a>

         
        </div>
      </div>

      {{-- Lessons Cards --}}
      <div class="row g-4 p-20">

        @forelse($lessons as $lesson)
          <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-12 d-flex flex-column bg-white">

              {{-- Card Body --}}
              <div class="card-body text-center flex-grow-1">

                {{-- Media Thumbnail or Icon --}}
                <div class="mb-3">
                  @if (!empty($lesson->image_file))
                    <div style="position: relative; width: 100%; height: 140px; border-radius: 10px; overflow: hidden; background: #071530;">
                      <img src="{{ asset('storage/' . $lesson->image_file) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $lesson->title }}">
                      @if($lesson->lesson_type === 'video')
                        <i class="bi bi-play-circle-fill text-white fs-3" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-shadow: 0 2px 8px rgba(0,0,0,0.5);"></i>
                      @endif
                    </div>
                  @else
                    @php
                      $type = $lesson->lesson_type ?? 'video';
                      $iconClass = 'ri-video-line text-primary';
                      $bgClass = 'bg-primary-subtle';
                      if($type === 'image') { $iconClass = 'ri-image-line text-success'; $bgClass = 'bg-success-subtle'; }
                      elseif($type === 'pdf') { $iconClass = 'ri-file-pdf-line text-danger'; $bgClass = 'bg-danger-subtle'; }
                      elseif($type === 'audio') { $iconClass = 'ri-mic-line text-warning'; $bgClass = 'bg-warning-subtle'; }
                      elseif($type === 'summary' || $type === 'text') { $iconClass = 'ri-file-text-line text-info'; $bgClass = 'bg-info-subtle'; }
                    @endphp
                    <div class="rounded-circle {{ $bgClass }} d-inline-flex align-items-center justify-content-center" style="width:70px;height:70px;">
                      <i class="{{ $iconClass }} fs-30"></i>
                    </div>
                  @endif
                </div>

                {{-- Lesson Title --}}
                <h5 class="fw-semibold mb-1">
                  {{ $lesson->title }}
                </h5>

                {{-- Course --}}
                <p class="text-muted fs-14 mb-2">
                  Course: {{ $lesson->course->title ?? 'N/A' }}
                </p>

                {{-- Type Status Badge --}}
                @php
                  $lType = $lesson->lesson_type ?? 'video';
                @endphp
                @if ($lType === 'image')
                  <span class="badge bg-success-subtle text-success">
                    <i class="ri-image-line me-1"></i> Image Lesson
                  </span>
                @elseif ($lType === 'pdf')
                  <span class="badge bg-danger-subtle text-danger">
                    <i class="ri-file-pdf-line me-1"></i> PDF Document
                  </span>
                @elseif ($lType === 'audio')
                  <span class="badge bg-warning-subtle text-warning">
                    <i class="ri-mic-line me-1"></i> Audio Lesson
                  </span>
                @elseif ($lType === 'summary')
                  <span class="badge bg-info-subtle text-info">
                    <i class="ri-file-text-line me-1"></i> Summary
                  </span>
                @else
                  @if(!empty($lesson->video_file))
                    <span class="badge bg-primary-subtle text-primary">
                      <i class="ri-video-line me-1"></i> Video Available
                    </span>
                  @else
                    <span class="badge bg-secondary-subtle text-secondary">
                      <i class="ri-video-line me-1"></i> Video Lesson
                    </span>
                  @endif
                @endif


              </div>

              {{-- Action Icons Bottom --}}
              <div class="border-top py-3">
                <div class="d-flex justify-content-center gap-4">

                  {{-- View --}}
                  <a href="{{ route('admin.lessons.show', [
                      'course' => $lesson->course_id,
                      'lesson' => $lesson->id
                  ]) }}">
                    <img src="https://img.icons8.com/color/48/visible.png" style="width: 22px; height: 22px; object-fit: contain;" alt="view">
                  </a>

                  {{-- Edit --}}
                  <a href="{{ route('admin.lessons.edit', [$lesson->course->id, $lesson->id]) }}" data-bs-toggle="tooltip"
                    title="Edit">
                    <img src="https://img.icons8.com/color/48/edit.png" style="width: 22px; height: 22px; object-fit: contain;" alt="edit">
                  </a>

                  {{-- Delete --}}
                  <form action="{{ route('admin.lessons.destroy', [$lesson->course->id, $lesson->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-transparent border-0 p-0" data-bs-toggle="tooltip" title="Delete"
                      onclick="return confirm('Delete this lesson?')">
                      <img src="https://img.icons8.com/color/48/trash.png" style="width: 22px; height: 22px; object-fit: contain;" alt="delete">
                    </button>
                  </form>


                </div>
              </div>

            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted mb-0">No lessons found</p>
          </div>
        @endforelse

      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-between align-items-center p-20 border-top">
        <span class="fs-14 text-muted">
          Showing {{ $lessons->firstItem() }} to {{ $lessons->lastItem() }}
          of {{ $lessons->total() }} entries
        </span>

        {{ $lessons->links() }}
      </div>

    </div>
  </div>

@endsection
