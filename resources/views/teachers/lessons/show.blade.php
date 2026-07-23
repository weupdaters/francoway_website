@extends('teachers.layouts.app')

@section('content')
  <div class="container-fluid py-4">

    <div class="row g-4">

      {{-- ================= LESSON INFO (25%) ================= --}}
      <div class="col-lg-3">
        <div class="card p-3 h-100 bg-white rounded-10 border border-white">
          <h5 class="mb-3 fw-bold" style="font-family: 'Outfit', sans-serif;">Lesson Information</h5>

          <p class="mb-1 fw-semibold text-dark">Title</p>
          <p class="text-muted mb-3">{{ $lesson->title }}</p>

          <p class="mb-1 fw-semibold text-dark">Course</p>
          <p class="text-muted mb-3">{{ $lesson->course->title ?? 'N/A' }}</p>

          <p class="mb-1 fw-semibold text-dark">Description</p>
          <div class="text-muted mb-3" style="line-height:1.6; font-size:14px;">
            {!! $lesson->description ? $lesson->description : '<em>No description available</em>' !!}
          </div>

          <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" class="btn btn-primary btn-sm mt-3 rounded-pill">
            <i class="bi bi-pencil me-1"></i> Edit Lesson
          </a>

          <a href="{{ route('teacher.course_lessons_user.index', $lesson->course_id) }}"
            class="btn btn-outline-secondary btn-sm mt-2 rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Back
          </a>
        </div>
      </div>

      {{-- ================= MEDIA & COMMENTS (75%) ================= --}}
      <div class="col-lg-9">
        <div class="card p-3 mb-4 bg-white rounded-10 border border-white">
          <h5 class="mb-3 fw-bold" style="font-family: 'Outfit', sans-serif;">Lesson Media</h5>

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
                alt="Lesson Image"
                onerror="this.style.display='none';">
            </div>

            {{-- SUMMARY --}}
          @elseif($lesson->summary)
            <div class="border p-3 rounded">
              {!! nl2br(e($lesson->summary)) !!}
            </div>
          @else
            <p class="text-danger mb-0">No media available</p>
          @endif
        </div>

        {{-- ================= COMMENTS & DISCUSSION ================= --}}
        <div class="card p-4 bg-white rounded-16 border shadow-2xs" style="border-color: #EAEAEA !important;">
          <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2" style="font-family: 'Outfit', sans-serif;">
            <i class="bi bi-chat-left-text text-danger"></i>
            <span>Lesson Discussion ({{ $lesson->comments->where('parent_id', null)->count() }})</span>
          </h5>

          {{-- TOP ADD COMMENT FORM --}}
          <form method="POST" action="{{ route('teacher.lesson.comment', $lesson->id) }}" class="mb-4">
            @csrf
            <textarea name="comment" class="form-control mb-2 rounded-12 p-3" rows="3" placeholder="Post a comment or announcement for students..." required style="border-color: #E2E8F0;"></textarea>
            <div class="d-flex justify-content-end">
              <button class="btn btn-danger btn-sm px-4 rounded-pill shadow-sm" style="background-color: #E53935; border-color: #E53935;">
                <i class="bi bi-send me-1"></i> Post Comment
              </button>
            </div>
          </form>

          {{-- COMMENTS LIST --}}
          <div class="comments-section">
            @forelse ($lesson->comments->where('parent_id', null) as $comment)
              <div class="card border mb-3 rounded-12 shadow-2xs" style="background: #F8FAFC; border-color: #EAEAEA !important;">
                <div class="card-body p-3">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                           style="width: 38px; height: 38px; font-size: 14px; background: #071530;">
                        {{ substr($comment->user->name ?? 'U', 0, 1) }}
                      </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="d-flex align-items-center gap-2">
                          <h6 class="fw-bold text-dark mb-0" style="font-size: 14px;">{{ $comment->user->name ?? 'User' }}</h6>
                          @if(($comment->user->role ?? '') === 'teacher')
                            <span class="badge bg-danger bg-opacity-10 text-danger" style="font-size: 9.5px;">Teacher</span>
                          @endif
                        </div>
                        <small class="text-muted" style="font-size: 11px;">{{ $comment->created_at ? $comment->created_at->diffForHumans() : 'Just now' }}</small>
                      </div>

                      {{-- Comment Text --}}
                      <p id="comment-text-{{ $comment->id }}" class="mb-2 text-secondary" style="font-size: 13.5px; line-height: 1.6;">{{ $comment->comment }}</p>

                      {{-- Inline Edit Form for Main Comment --}}
                      <form id="edit-form-{{ $comment->id }}" method="POST" action="{{ route('users.comment.update', $comment->id) }}" class="d-none mt-2 mb-3">
                        @csrf
                        @method('PUT')
                        <textarea name="comment" class="form-control mb-2 rounded-10" rows="2" required style="border-color: #CBD5E1;">{{ $comment->comment }}</textarea>
                        <div class="d-flex gap-2 justify-content-end">
                          <button type="button" class="btn btn-sm btn-light rounded-pill px-3" onclick="toggleEditForm({{ $comment->id }})">Cancel</button>
                          <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3" style="background-color: #071530;">Save Changes</button>
                        </div>
                      </form>

                      {{-- Action Links (Reply, Edit, Delete) --}}
                      <div class="d-flex align-items-center gap-3 mb-2">
                        @if(auth()->check() && $comment->user_id !== auth()->id())
                          <button class="btn btn-sm text-danger p-0 border-0 bg-transparent d-inline-flex align-items-center gap-1"
                                  onclick="toggleReplyForm({{ $comment->id }})" style="font-size: 12px; font-weight: 600;">
                            <i class="bi bi-reply-fill"></i> Reply as Teacher
                          </button>
                        @endif

                        @if(auth()->check() && $comment->user_id == auth()->id())
                          <button class="btn btn-sm text-primary p-0 border-0 bg-transparent d-inline-flex align-items-center gap-1"
                                  onclick="toggleEditForm({{ $comment->id }})" style="font-size: 12px; font-weight: 600;">
                            <i class="bi bi-pencil-square"></i> Edit
                          </button>
                        @endif

                        @if(auth()->check() && ($comment->user_id == auth()->id() || in_array(auth()->user()->role ?? '', ['teacher', 'admin'])))
                          <form method="POST" action="{{ route('users.comment.destroy', $comment->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-secondary p-0 border-0 bg-transparent d-inline-flex align-items-center gap-1"
                                    style="font-size: 12px; font-weight: 600;">
                              <i class="bi bi-trash-fill"></i> Delete
                            </button>
                          </form>
                        @endif
                      </div>

                      {{-- REPLIES THREAD --}}
                      @if($comment->replies->count() > 0)
                        <div class="replies-list mt-3 ps-3 border-start border-2 border-danger-subtle">
                          @foreach ($comment->replies as $reply)
                            <div class="reply-card bg-white p-3 rounded-12 border mb-2 shadow-2xs" style="border-color: #E2E8F0 !important;">
                              <div class="d-flex justify-content-between align-items-start mb-1">
                                <div class="d-flex align-items-center gap-2">
                                  <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                                       style="width: 26px; height: 26px; font-size: 11px; background: #071530;">
                                    {{ substr($reply->user->name ?? 'U', 0, 1) }}
                                  </div>
                                  <span class="fw-bold text-dark" style="font-size: 13px;">{{ $reply->user->name ?? 'User' }}</span>
                                  @if(($reply->user->role ?? '') === 'teacher')
                                    <span class="badge bg-danger bg-opacity-10 text-danger" style="font-size: 9px;">Teacher</span>
                                  @endif
                                </div>
                                <small class="text-muted" style="font-size: 10px;">{{ $reply->created_at ? $reply->created_at->diffForHumans() : 'Just now' }}</small>
                              </div>

                              <p id="comment-text-{{ $reply->id }}" class="mb-2 text-secondary" style="font-size: 13px;">{{ $reply->comment }}</p>

                              {{-- Inline Edit Form for Reply --}}
                              <form id="edit-form-{{ $reply->id }}" method="POST" action="{{ route('users.comment.update', $reply->id) }}" class="d-none mt-2 mb-2">
                                @csrf
                                @method('PUT')
                                <textarea name="comment" class="form-control mb-2 rounded-10" rows="2" required style="border-color: #CBD5E1;">{{ $reply->comment }}</textarea>
                                <div class="d-flex gap-2 justify-content-end">
                                  <button type="button" class="btn btn-sm btn-light rounded-pill px-3" onclick="toggleEditForm({{ $reply->id }})">Cancel</button>
                                  <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3" style="background-color: #071530;">Save</button>
                                </div>
                              </form>

                              {{-- Reply Edit / Delete Action Buttons --}}
                              @if(auth()->check() && $reply->user_id == auth()->id())
                                <button class="btn btn-sm text-primary p-0 border-0 bg-transparent d-inline-flex align-items-center gap-1"
                                        onclick="toggleEditForm({{ $reply->id }})" style="font-size: 11.5px; font-weight: 600;">
                                  <i class="bi bi-pencil-square"></i> Edit
                                </button>
                              @endif

                              @if(auth()->check() && ($reply->user_id == auth()->id() || in_array(auth()->user()->role ?? '', ['teacher', 'admin'])))
                                <form method="POST" action="{{ route('users.comment.destroy', $reply->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm text-secondary p-0 border-0 bg-transparent d-inline-flex align-items-center gap-1"
                                          style="font-size: 11.5px; font-weight: 600;">
                                    <i class="bi bi-trash-fill"></i> Delete
                                  </button>
                                </form>
                              @endif
                            </div>
                          @endforeach
                        </div>
                      @endif

                      {{-- INLINE TEACHER REPLY FORM (Hidden by default, expands on Reply click) --}}
                      <form id="reply-form-{{ $comment->id }}" method="POST" action="{{ route('teacher.comment.reply', $comment->id) }}" class="reply-form d-none mt-3 p-3 bg-white border rounded-12">
                        @csrf
                        <textarea name="comment" class="form-control mb-2 rounded-10" rows="2" placeholder="Reply as teacher..." required style="border-color: #CBD5E1;"></textarea>
                        <div class="d-flex justify-content-end gap-2">
                          <button type="button" class="btn btn-light btn-sm rounded-pill px-3" onclick="toggleReplyForm({{ $comment->id }})">Cancel</button>
                          <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3" style="background-color: #E53935; border-color: #E53935;">Post Reply</button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center py-4 text-muted">
                <i class="bi bi-chat-left-dots fs-2 mb-2 d-block text-secondary"></i>
                <p class="mb-0 small">No comments on this lesson yet.</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
  function toggleReplyForm(id) {
      const form = document.getElementById('reply-form-' + id);
      if (form) {
          form.classList.toggle('d-none');
      }
  }

  function toggleEditForm(id) {
      const form = document.getElementById('edit-form-' + id);
      const text = document.getElementById('comment-text-' + id);
      if (form) {
          form.classList.toggle('d-none');
      }
      if (text) {
          text.classList.toggle('d-none');
      }
  }
  </script>
@endsection
