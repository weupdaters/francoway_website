@extends('teachers.layouts.app')

@section('content')

{{--breadcrumb --}}
      <div class="col-xl-12 col-lg-12" style="margin-left: 90em;">
        <div class="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="{{ route('teacher.dashboard') }}"><span>Dashboard</span></a></li>
            
            <li class="breadcrumb-item"><span><a href="#">Courses</a></span></li>
            <li class="breadcrumb-item active">
              <span>Lessons</span>
            </li>
          </ol>
        </div>
      </div>
  <div class="container-fluid py-4 bg-white">
    <div class="row g-4 bg-white ">
      

      {{-- ================= LEFT : COURSES ================= --}}

      <div class="col-xl-4 col-lg-5">
        <div class="card border bg-white h-100">

          <div class="card-header bg-white border-bottom">
            <h6 class="mb-0 fw-semibold text-dark">📚 My Courses</h6>
          </div>

          <div class="card-body p-0 bg-white">
            <ul class="list-group list-group-flush bg-white" id="courseList">
              @foreach ($alluserCourses as $alluserCourse)
                @if($alluserCourse->course)
                <li class="list-group-item d-flex align-items-center gap-3 px-4 py-3 bg-white"
                  data-id="{{ $alluserCourse->course->id }}" role="button">

                  <div
                    class="rounded-circle bg-primary text-white
                                            d-flex align-items-center justify-content-center fw-semibold"
                    style="width:42px;height:42px;">
                    {{ strtoupper(substr($alluserCourse->course->title, 0, 1)) }}
                  </div>

                  <div class="flex-grow-1">
                    <div class="fw-semibold text-dark">
                      {{ $alluserCourse->course->title }}
                    </div>
                    <small class="text-muted">Click to manage lessons</small>
                  </div>

                  <span class="text-muted"><i class="fas fa-chevron-right"></i></span>
                </li>
                @endif
              @endforeach
            </ul>
          </div>

        </div>
      </div>

      {{-- ================= RIGHT : LESSONS ================= --}}
      <div class="col-xl-8 col-lg-7">
        <div class="card border bg-white h-100">

          <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <div>
              <h6 class="mb-0 fw-semibold text-dark" id="courseTitle">
                Select a course
              </h6>
              <small class="text-muted">Manage lessons professionally</small>
            </div>

            <button class="btn btn-sm btn-primary px-3" id="addLessonBtn" style="display: none !important;">
              + Add Lesson
            </button>
          </div>

          <div class="card-body bg-white" id="lessonArea">
            <div class="text-center py-5 text-muted">
              <div class="fs-3 mb-2">📖</div>
              <p class="mb-0">Choose a course to view lessons</p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection


@push('scripts')
  <script>
    let selectedCourse = null;

    /* ===============================
       COURSE CLICK
    ===============================*/
    $('#courseList').on('click', '[data-id]', function() {

      $('#courseList .list-group-item')
        .removeClass('active bg-light');

      $(this).addClass('active bg-light');

      selectedCourse = $(this).data('id');

      $('#addLessonBtn')
        .attr('style', 'display: inline-flex !important;')
        .off('click')
        .on('click', function() {
          if (!selectedCourse) return;
          window.location.href =
            "{{ route('teacher.lessons.create', ':id') }}".replace(':id', selectedCourse);
        });

      loadLessons(selectedCourse);
    });


    /* ===============================
       LOAD LESSONS
    ===============================*/
    function loadLessons(courseId) {

      $('#lessonArea').html(`
        <div class="text-center py-5 text-muted">
            <div class="spinner-border spinner-border-sm"></div>
            <p class="mt-2 mb-0">Loading lessons...</p>
        </div>
    `);

      $.ajax({
        url: "{{ url('/teacher/ajax/course') }}/" + courseId + "/lessons",
        type: "GET",
        success: function(res) {

          $('#courseTitle').text(res.course.title);

          if (res.lessons.length === 0) {
            $('#lessonArea').html(`
                    <div class="text-center py-5 text-muted">
                        <div class="fs-3 mb-2">📂</div>
                        No lessons created yet
                    </div>
                `);
            return;
          }

          let html = '<div class="list-group list-group-flush bg-white">';

          res.lessons.forEach(lesson => {

            html += `
                <div class="list-group-item bg-white d-flex justify-content-between align-items-center px-4 py-3">
                    <div>
                        <div class="fw-semibold text-dark">${lesson.title}</div>
                        <small class="text-muted">Lesson ID: ${lesson.id}</small>
                    </div>

                    <div class="d-flex gap-2">

                        <!-- VIEW -->
                        <button class="btn btn-sm btn-light border viewLesson"
                                data-id="${lesson.id}" title="View">
                            <i class="bi bi-eye"></i>
                        </button>

                        <!-- EDIT -->
                        <button class="btn btn-sm btn-light border editLesson"
                                data-id="${lesson.id}" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <!-- DELETE -->
                        <button class="btn btn-sm btn-light border text-danger deleteLesson"
                                data-id="${lesson.id}" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>
                </div>`;
          });

          html += '</div>';
          $('#lessonArea').html(html);
        }
      });
    }


    /* ===============================
       VIEW LESSON
    ===============================*/
    $(document).on('click', '.viewLesson', function() {
      let id = $(this).data('id');
      window.location.href =
        "{{ route('teacher.lessons.show', ':id') }}".replace(':id', id);
    });


    /* ===============================
       EDIT LESSON
    ===============================*/
    $(document).on('click', '.editLesson', function() {
      let id = $(this).data('id');
      window.location.href =
        "{{ route('teacher.lessons.edit', ':id') }}".replace(':id', id);
    });


    /* ===============================
       DELETE LESSON
    ===============================*/
    $(document).on('click', '.deleteLesson', function() {

    let lessonId = $(this).data('id');

    if (!confirm('Delete this lesson?')) return;

    $.ajax({
    url: '/teacher/ajax/lesson/' + lessonId,
    method: 'GET',
    success: function(res) {
        alert('Deleted Successfully');
        location.reload();
    }
});


    });
  </script>
@endpush
