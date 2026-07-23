@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">User Details</h3>

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
                    <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                        Users
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="text-secondary">View User</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white p-20 rounded-10 border border-white mb-4">

        <div class="row align-items-center">

            {{-- User Image --}}
            <div class="col-lg-3 text-center">
                <img
                    src="{{ $user->image
                        ? asset('storage/'.$user->image)
                        : asset('admin/images/user1.jpg') }}"
                    class="rounded-circle mb-3"
                    width="120"
                    height="120"
                    alt="{{ $user->name }}"
                >
            </div>

            {{-- User Info --}}
            <div class="col-lg-9">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th width="200">Full Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email Address</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td>
                                <span class="badge bg-info text-capitalize">
                                    {{ $user->role }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                @if($user->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Deactive</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>
                                {{ $user->description ?? '—' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Buttons --}}
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('admin.users.edit', $user->id) }}"
               class="btn btn-primary">
                Edit User
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="btn btn-secondary">
                Back
            </a>
        </div>

    </div>
</div>

@endsection
