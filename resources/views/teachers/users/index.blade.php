@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Users List</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span>Project Management</span>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Users List</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Search + Add --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">

            <form action="{{ route('admin.users.index') }}"
                  method="GET"
                  class="table-src-form position-relative m-0">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control w-350"
                       placeholder="Search user...">
                <button class="src-btn position-absolute top-50 start-0 translate-middle-y bg-transparent p-0 border-0">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>

            <a href="{{ route('admin.users.create') }}"
               class="text-primary fs-16 text-decoration-none">
                + Add New User
            </a>
        </div>

        {{-- Table --}}
        <div class="default-table-area mx-minus-1 table-contact-list">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                           
                            <th>Contact ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr>
                           

                            <td>#{{ $user->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->image
                                            ? asset('uploads/users/'.$user->image)
                                            : asset('admin/images/user1.jpg') }}"
                                         class="rounded-circle"
                                         style="width:35px;height:35px;">
                                    <h4 class="fw-medium fs-16 mb-0 ms-2">
                                        {{ $user->name }}
                                    </h4>
                                </div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->role }}</td>

                            

                            <td>
                                @if($user->status)
                                    <span class="text-success bg-success bg-opacity-10 default-badge">
                                        Active
                                    </span>
                                @else
                                    <span class="text-danger bg-danger bg-opacity-10 default-badge">
                                        Deactive
                                    </span>
                                @endif
                            </td>

                           <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">


                                    {{--View Assigned Courses --}}
                                    <a href="{{ route('admin.course-assign.show', $user->id) }}"
   class="bg-transparent p-0 border-0 hover-text-success"
   title="View Assigned Courses">
    <i class="material-symbols-outlined fs-16 fw-normal text-primary">
        visibility
    </i>
</a>



                                    {{-- Edit --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="bg-transparent p-0 border-0 hover-text-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Edit">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            edit
                                        </i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-transparent p-0 border-0 hover-text-danger"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Delete"
                                                onclick="return confirm('Delete this user?')">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                                delete
                                            </i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-20">
                <span class="fs-15">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }}
                    of {{ $users->total() }} entries
                </span>

                {{ $users->links() }}
            </div>

        </div>
    </div>
</div>

@endsection
