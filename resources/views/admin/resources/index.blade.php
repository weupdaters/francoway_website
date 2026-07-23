@extends('admin.layouts.app')

@section('title', 'Resources Management')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Resources Management</h3>

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
                <li class="breadcrumb-item active">
                    <span class="text-secondary">Resources</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Card --}}
    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- Top Bar --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h3>All Resources</h3>

            <a href="{{ route('admin.resources.create') }}"
               class="btn btn-primary fs-16">
                + Add Resource
            </a>
        </div>

        {{-- Table --}}
        <div class="default-table-area mx-minus-1">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>PDF</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($resources as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>

                            <td>{{ $item->title }}</td>

                            <td>
                                <img src="{{ asset('storage/'.$item->image) }}"
                                     width="60"
                                     class="rounded">
                            </td>

                            <td>
                                <a href="{{ asset('storage/'.$item->pdf) }}"
                                   target="_blank"
                                   class="text-primary">
                                    View PDF
                                </a>
                            </td>

                            <td>
                                {{ optional($item->created_at)->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex justify-content-end gap-3">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.resources.edit', $item->id) }}"
                                       class="bg-transparent border-0 p-0"
                                       data-bs-toggle="tooltip"
                                       data-bs-title="Edit">
                                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.resources.destroy', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-transparent border-0 p-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Delete"
                                                onclick="return confirm('Are you sure?')">
                                            <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                                        </button>
                                    </form>

                                </div>
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No resources found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-20">
                <span class="fs-15">
                    Showing {{ $resources->firstItem() }}
                    to {{ $resources->lastItem() }}
                    of {{ $resources->total() }} entries
                </span>

                {{ $resources->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
