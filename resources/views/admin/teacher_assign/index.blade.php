@extends('admin.layouts.app')

@section('title', 'Teacher – User Assignment')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Teacher – User Assignment</h3>

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span>LMS</span>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Teacher Assignment</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Top Bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3>Assignments</h3>

            <button class="btn btn-primary fs-16"
                    data-bs-toggle="modal"
                    data-bs-target="#assignModal">
                + Assign User
            </button>
        </div>

        {{-- Table --}}
        <div class="default-table-area mx-minus-1">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Teacher</th>
                            <th>User</th>
                            <th>Course</th>
                            <th>Assigned At</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($assignments as $assign)
                        <tr>
                            <td>#{{ $assign->id }}</td>

                            <td>{{ optional($assign->teacher)->name ?? '-' }}</td>
                            <td>{{ optional($assign->user)->name ?? '-' }}</td>
                            <td>{{ optional($assign->course)->title ?? '-' }}</td>

                            <td>
                                {{ optional($assign->created_at)->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex justify-content-end gap-3">

                                    {{-- Edit --}}
                                    <button class="bg-transparent border-0 p-0 editBtn"
                                            data-id="{{ $assign->id }}"
                                            data-teacher="{{ $assign->teacher_id }}"
                                            data-user="{{ $assign->user_id }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Edit">
                                        <i class="material-symbols-outlined fs-18 text-warning">
                                            edit
                                        </i>
                                    </button>

                                    {{-- Delete --}}
                                    <button class="bg-transparent border-0 p-0 deleteBtn"
                                            data-id="{{ $assign->id }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Delete">
                                        <i class="material-symbols-outlined fs-18 text-danger">
                                            delete
                                        </i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No assignments found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-20">
                <span class="fs-15">
                    Showing {{ $assignments->firstItem() }}
                    to {{ $assignments->lastItem() }}
                    of {{ $assignments->total() }} entries
                </span>

                {{ $assignments->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ================= ADD MODAL ================= --}}
<div class="modal fade" id="assignModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="assignForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign User to Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="form-select" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Select User</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select name="course_id" id="course_id" class="form-select" required>
                            <option value="">Select Course</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Assignment</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <select name="user_id" id="edit_user" class="form-select"></select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('teacher_id').addEventListener('change', function () {
    let teacherId = this.value;

    let userSelect   = document.getElementById('user_id');
    let courseSelect = document.getElementById('course_id');

    userSelect.innerHTML   = '<option value="">Loading...</option>';
    courseSelect.innerHTML = '<option value="">Loading...</option>';

    if (!teacherId) {
        userSelect.innerHTML   = '<option value="">Select User</option>';
        courseSelect.innerHTML = '<option value="">Select Course</option>';
        return;
    }

    // Load users
    fetch(`/admin/teacher/${teacherId}/users`)
        .then(res => res.json())
        .then(data => {
            userSelect.innerHTML = '<option value="">Select User</option>';
            data.forEach(user => {
                userSelect.innerHTML += `<option value="${user.id}">${user.name}</option>`;
            });
        });

    // Load courses
    fetch(`/admin/teacher/${teacherId}/courses`)
        .then(res => res.json())
        .then(data => {
            courseSelect.innerHTML = '<option value="">Select Course</option>';
            data.forEach(course => {
                courseSelect.innerHTML += `<option value="${course.id}">${course.title}</option>`;
            });
        });
});
</script>
@endpush
@stack('scripts')


@endsection
