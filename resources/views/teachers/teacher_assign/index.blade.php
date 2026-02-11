@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Teacher – User Assignment</h3>

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
                    <span>LMS</span>
                </li>
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Teacher Assign</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Top Bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3>Assigned Users</h3>

            <ul class="nav nav-tabs border-0 gap-2 tabs-default-active">
                <li>
                <button type="button" class="btn btn-primary ">
                    <a href="{{ route('admin.teacher.assign.index') }}"
                       class="text-white fs-16 text-decoration-none">
                        + Assign User
                    </a>
                </button>
                </li>
            </ul>
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
                            <th>Assigned At</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($assignments as $assign)
                        <tr>
                            <td>#{{ $assign->id ?? '-' }}</td>

                            <td class="fs-16 fw-medium text-secondary">
                                {{ $assign->teacher->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $assign->user->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $assign->created_at?->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">

                                    {{-- Remove --}}
                                    <form method="POST"
                                          action="{{ route('admin.teacher.assign.delete', [$assign->teacher_id, $assign->user_id]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-transparent p-0 border-0 hover-text-danger"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Remove"
                                                onclick="return confirm('Remove this assignment?')">
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
                            <td colspan="5" class="text-center">
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
                    Showing {{ $assignments->firstItem() }} to {{ $assignments->lastItem() }}
                    of {{ $assignments->total() }} entries
                </span>

                {{ $assignments->links() }}
            </div>

        </div>
    </div>
</div>

@endsection
