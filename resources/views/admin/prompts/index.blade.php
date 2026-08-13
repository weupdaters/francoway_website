@extends('admin.layouts.app')

@section('title', 'Prompts Management')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Prompts Management</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    Prompts
                </li>
            </ol>
        </nav>
    </div>

    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- TOP BAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
            <h4 class="mb-0">All Prompts</h4>

            <div class="d-flex align-items-center gap-2 flex-wrap">
                {{-- Search Form --}}
                <form action="{{ route('admin.prompts.index') }}" method="GET" class="d-flex align-items-center me-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search prompts..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary border-0 bg-light" type="submit">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>
                </form>

                <a href="{{ route('admin.prompts.create') }}" class="btn btn-primary">
                    + Add Prompt
                </a>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="default-table-area mx-minus-1 style-two">
            <div class="table-responsive">
                <table class="table align-middle">
                     <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Course</th>
                            <th>Skill</th>
                            <th>Prompt Preview</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($prompts as $prompt)
                        <tr>
                            <td>#{{ $prompt->id }}</td>
                            <td><strong>{{ $prompt->title }}</strong></td>
                            <td>
                                @if($prompt->course)
                                    <span class="text-body fw-medium">{{ $prompt->course->title }}</span>
                                @else
                                    <span class="badge bg-secondary text-white">Global</span>
                                @endif
                            </td>
                            <td>
                                @if($prompt->skill === 'reading')
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                        <i class="ri-book-open-line me-1"></i> Reading
                                    </span>
                                @elseif($prompt->skill === 'listening')
                                    <span class="badge bg-info-subtle text-info border border-info-subtle">
                                        <i class="ri-customer-service-line me-1"></i> Listening
                                    </span>
                                @elseif($prompt->skill === 'speaking')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                        <i class="ri-mic-line me-1"></i> Speaking
                                    </span>
                                @elseif($prompt->skill === 'writing')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        <i class="ri-edit-2-line me-1"></i> Writing
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                        {{ ucfirst($prompt->skill) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted d-inline-block text-truncate" style="max-width: 350px;" title="{{ $prompt->prompt_text }}">
                                    {{ Str::limit($prompt->prompt_text, 100) }}
                                </span>
                            </td>
                            <td>
                                @if($prompt->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.prompts.edit', $prompt->id) }}" class="bg-transparent border-0">
                                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                                    </a>
                                    <form action="{{ route('admin.prompts.destroy', $prompt->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-transparent border-0" onclick="return confirm('Delete this prompt?')">
                                            <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No Prompts Found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-between align-items-center p-20">
                <span class="fs-15 text-muted">
                    Showing {{ $prompts->firstItem() ?? 0 }}
                    to {{ $prompts->lastItem() ?? 0 }}
                    of {{ $prompts->total() ?? 0 }}
                </span>
                {{ $prompts->links() }}
            </div>
        </div>

    </div>

</div>

@endsection
