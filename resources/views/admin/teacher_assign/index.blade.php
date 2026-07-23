@extends('admin.layouts.app')

@section('title', 'Teacher Assignment')

@section('content')

  <div class="main-content-container overflow-hidden">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
      <h3 class="mb-0">Teacher Assignment</h3>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
              <i class="ri-home-8-line fs-15 text-primary me-1"></i>
              <span class="text-body fs-14">Dashboard</span>
            </a>
          </li>

          <li class="breadcrumb-item active">
            Assign user
          </li>
        </ol>
      </nav>
    </div>

    <div class="card bg-white rounded-10 border border-white mb-4">

      {{-- TOP BAR --}}
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
        <h4>Assignments</h4>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal">
          + Assign User
        </button>
      </div>

      {{-- TABLE --}}
      <div class="default-table-area mx-minus-1 style-two">
        <div class="table-responsive">

          <table class="table align-middle">

            <thead>
              <tr>
                <th>ID</th>
                <th>Teacher</th>
                <th>User</th>
                <th>Course</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($assignments as $a)
                <tr>

                  <td>#{{ $a->id }}</td>

                  <td>{{ optional($a->teacher)->name ?? '-' }}</td>

                  <td>{{ optional($a->user)->name ?? '-' }}</td>

                  <td>{{ optional($a->course)->title ?? '-' }}</td>

                  <td>
                    <div class="d-flex gap-2">

                      <button class="bg-transparent border-0 editBtn" data-id="{{ $a->id }}">
                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                      </button>

                      <button class="bg-transparent border-0 deleteBtn" data-id="{{ $a->id }}">
                        <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                      </button>

                    </div>
                  </td>

                </tr>

              @empty

                <tr>
                  <td colspan="5" class="text-center py-4">
                    No Assignments Found
                  </td>
                </tr>
              @endforelse
            </tbody>

          </table>

        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-between align-items-center p-20">

          <span class="fs-15">
            Showing {{ $assignments->firstItem() }}
            to {{ $assignments->lastItem() }}
            of {{ $assignments->total() }}
          </span>

          {{ $assignments->links() }}

        </div>

      </div>
    </div>
  </div>


  {{-- ================= ADD MODAL ================= --}}
  <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <form id="assignForm" class="modal-content bg-white rounded-10 border border-white">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" id="assignModalLabel">
            <img src="https://img.icons8.com/color/48/add-user-male.png" style="width: 20px; height: 20px; object-fit: contain; margin-right: 8px;" alt="assign user">
            Assign User
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">

            <div class="col-12 col-md-4">
              <label for="teacher_id" class="form-label small fw-semibold">Teacher</label>
              <select name="teacher_id" id="teacher_id" class="form-select" required>
                <option value="">Select Teacher</option>
                @foreach ($teachers as $t)
                  <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
              </select>
              <div class="form-text">Choose the teacher who will manage this user.</div>
            </div>

            <div class="col-12 col-md-4">
              <label for="user_id" class="form-label small fw-semibold">User</label>
              <select name="user_id" id="user_id" class="form-select" required>
                <option value="">Select User</option>
                @foreach ($users as $u)
                  <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
              </select>
              <div class="form-text">Select an existing student / user account.</div>
            </div>

            <div class="col-12 col-md-4">
              <label for="course_id" class="form-label small fw-semibold">Course</label>
              <select name="course_id" id="course_id" class="form-select" required>
                <option value="">Select Course</option>
              </select>
              <div class="form-text">Courses assigned to the selected user will appear here.</div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <span>Save</span>
            <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- ================= EDIT MODAL ================= --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form id="editForm" class="modal-content bg-white rounded-10 border border-white">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" id="edit_id">

        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" id="editModalLabel">
            <img src="https://img.icons8.com/color/48/edit.png" style="width: 20px; height: 20px; object-fit: contain; margin-right: 8px;" alt="edit">
            Edit Assignment
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_teacher" class="form-label small fw-semibold">Teacher</label>
            <select name="teacher_id" id="edit_teacher" class="form-select" required>
              @foreach ($teachers as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
              @endforeach
            </select>
            <div class="form-text">Change the assigned teacher.</div>
          </div>

          <div class="mb-3">
            <label for="edit_user" class="form-label small fw-semibold">User (Student)</label>
            <select name="user_id" id="edit_user" class="form-select" required>
              @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
              @endforeach
            </select>
            <div class="form-text">Change the assigned user for this record.</div>
          </div>

          <div class="mb-3">
            <label for="edit_course" class="form-label small fw-semibold">Course</label>
            <select name="course_id" id="edit_course" class="form-select" required>
              @foreach ($courses as $c)
                <option value="{{ $c->id }}">{{ $c->title }}</option>
              @endforeach
            </select>
            <div class="form-text">Change the assigned course.</div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <span>Update</span>
            <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </form>
    </div>
  </div>



@endsection



@push('scripts')
  <script>
    $(document).ready(function() {

      /* USER → COURSE */
      $('#user_id').change(function() {

        let userId = $(this).val();

        $.get(`/admin/user/${userId}/courses`, function(data) {

          let html = '<option value="">Select Course</option>';
          data.forEach(c => {
            html += `<option value="${c.id}">${c.title}</option>`;
          });

          $('#course_id').html(html);

        });

      });


      /* ADD */
      $('#assignForm').submit(function(e) {

        e.preventDefault();

        $.post("{{ route('admin.teacher.assign.store') }}",
          $(this).serialize(),

          function() {
            Swal.fire({
              icon: 'success',
              title: 'Assignment Added',
              showConfirmButton: true,
              confirmButtonColor: '#E31B23'
            }).then(() => {
              $('#assignModal').modal('hide');
              location.reload();
            });
          });

      });


      /* EDIT OPEN */
      $('.editBtn').click(function() {

        let id = $(this).data('id');

        $.get(`/admin/teacher-assign/${id}`, function(res) {

          $('#edit_id').val(res.id);
          $('#edit_teacher').val(res.teacher_id);
          $('#edit_user').val(res.user_id);
          $('#edit_course').val(res.course_id);

          $('#editModal').modal('show');

        });

      });


      /* UPDATE */
      $('#editForm').submit(function(e) {

        e.preventDefault();

        let id = $('#edit_id').val();

        $.ajax({
          url: `/admin/teacher-assign/${id}`,
          type: 'POST',
          data: {
            _token: "{{ csrf_token() }}",
            _method: 'PUT',
            teacher_id: $('#edit_teacher').val(),
            user_id: $('#edit_user').val(),
            course_id: $('#edit_course').val()
          },
          success: function() {
            Swal.fire({
              icon: 'success',
              title: 'Assignment Updated',
              showConfirmButton: true,
              confirmButtonColor: '#E31B23'
            }).then(() => {
              location.reload();
            });
          }
        });

      });


      /* DELETE */
      $('.deleteBtn').click(function() {

        let id = $(this).data('id');

        confirmAction('Delete Assignment', 'Are you sure you want to delete this teacher assignment?', 'Yes, delete it!', function() {
          $.ajax({
            url: `/admin/teacher-assign/${id}`,
            type: 'POST',
            data: {
              _token: "{{ csrf_token() }}",
              _method: 'DELETE'
            },
            success: function() {
              Swal.fire({
                icon: 'success',
                title: 'Assignment Deleted',
                showConfirmButton: true,
                confirmButtonColor: '#E31B23'
              }).then(() => {
                location.reload();
              });
            }
          });
        });

      });

    });
  </script>
@endpush
