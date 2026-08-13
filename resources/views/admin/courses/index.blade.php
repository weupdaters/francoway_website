@extends('admin.layouts.app')

@section('content')

<style>
.course-card {
    border-radius: 18px;
    transition: all 0.3s ease;
    background: #ffffff;
}

.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.course-avatar {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    background: linear-gradient(135deg,#4e73df,#1cc88a);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
    font-weight: 600;
}

.progress {
    height: 6px;
    border-radius: 20px;
    background-color: #f1f3f7;
}

.progress-bar {
    border-radius: 20px;
}

.btn-prompt {
    background: #071530 !important;
    color: #ffffff !important;
    border: 1px solid #071530 !important;
    box-shadow: 0 4px 14px rgba(7, 21, 48, 0.12) !important;
}

.btn-prompt:hover {
    background: #E53935 !important;
    color: #ffffff !important;
    border-color: #E53935 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 20px rgba(229, 57, 53, 0.22) !important;
}

.list-group-item.active {
    background: #071530 !important;
    color: #ffffff !important;
    font-weight: 600;
}
.list-group-item:not(.active) {
    background-color: #f8fafc !important;
    color: #4a5568 !important;
}
.list-group-item:not(.active):hover {
    background-color: #eff3f9 !important;
    color: #071530 !important;
}
</style>
{{-- Breadcrumb --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Course LIst</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14 hover">Dashboard</span>
                    </a>
                </li>
        
                <li class="breadcrumb-item"><span>Courses</span></li>
                
            </ol>
        </nav>
    </div>

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1 bg-white p-3 border border-white rounded-10">
        <h3 class="mb-0 fw-semibold">Courses</h3>

        <a href="{{ route('admin.courses.create') }}"
           class="btn btn-primary px-4">
            + Create Course
        </a>
    </div>

    <div class="row g-4">

        @forelse($courses as $course)

        @php
            $progress = $course->status ? 90 : 40;
        @endphp

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm course-card h-100 p-4">

                {{-- Top Section --}}
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div class="d-flex align-items-center">
                        <div class="course-avatar me-3">
                            {{ strtoupper(substr($course->title,0,1)) }}
                        </div>

                        <div>
                            <h5 class="mb-1 fw-semibold">
                                {{ $course->title }}
                            </h5>
                            <small class="text-muted">
                                Course ID: #{{ $course->id }}
                            </small>
                        </div>
                    </div>

                    @if($course->status)
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                            Published
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                            Draft
                        </span>
                    @endif

                </div>

                {{-- Price & Prompt --}}
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <span class="fs-5 fw-bold text-dark">
                        {{ $course->price > 0 ? '$'.$course->price : 'Free Course' }}
                    </span>
                    @if($course->has_custom_prompt)
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                            Custom Prompt
                        </span>
                    @endif
                </div>

                {{-- Progress --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="text-muted">Completion</small>
                        <small class="fw-semibold">{{ $progress }}%</small>
                    </div>

                    <div class="progress">
                        <div class="progress-bar bg-primary"
                             style="width: {{ $progress }}%">
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="mt-auto d-flex gap-2">
                    <a href="{{ route('admin.courses.show',$course->slug ?? $course->id) }}"
                       class="btn btn-primary flex-grow-1 rounded-pill">
                        View Details
                    </a>
                    <button type="button" 
                            class="btn btn-prompt rounded-pill px-3" 
                            data-bs-toggle="modal" 
                            data-bs-target="#promptModal-{{ $course->id }}">
                        {{ $course->has_custom_prompt ? 'Edit Prompt' : 'Add Prompt' }}
                    </button>
                </div>

                {{-- Icons --}}
                <div class="d-flex justify-content-end gap-3 mt-4">

                    <a href="{{ route('admin.lessons.index', $course->slug ?? $course->id) }}">
                        <img src="https://img.icons8.com/color/48/add.png" style="width: 18px; height: 18px; object-fit: contain;" alt="add lessons">
                    </a>

                   

                    <a href="{{ route('admin.courses.edit',$course->slug ?? $course->id) }}">
                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                    </a>

                    <form action="{{ route('admin.courses.destroy',$course->slug ?? $course->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-transparent border-0 p-0"
                                onclick="return confirm('Delete this course?')">
                            <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                        </button>
                    </form>


                </div>

            </div>
        </div>

        <!-- Modal for Custom Prompt -->
        <div class="modal fade" id="promptModal-{{ $course->id }}" tabindex="-1" aria-labelledby="promptModalLabel-{{ $course->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 bg-white">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark fs-18" id="promptModalLabel-{{ $course->id }}">
                            AI Custom Prompts: {{ $course->title }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @php
                        $prompts = [];
                        if ($course->custom_prompt) {
                            $prompts = json_decode($course->custom_prompt, true);
                            if (json_last_error() !== JSON_ERROR_NONE || !is_array($prompts)) {
                                $prompts = [
                                    'reading' => $course->custom_prompt,
                                    'listening' => '',
                                    'speaking' => '',
                                    'writing' => '',
                                ];
                            }
                        }
                        $readingPrompt = $prompts['reading'] ?? '';
                        $listeningPrompt = $prompts['listening'] ?? '';
                        $speakingPrompt = $prompts['speaking'] ?? '';
                        $writingPrompt = $prompts['writing'] ?? '';
                    @endphp
                    <form action="{{ route('admin.courses.update-prompt', $course->slug ?? $course->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body py-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="list-group rounded-3 shadow-sm border-0" id="modalModuleList-{{ $course->id }}" role="tablist">
                                        <button type="button" class="list-group-item list-group-item-action active border-0 py-3 d-flex align-items-center gap-2" id="modal-reading-list-{{ $course->id }}" data-bs-toggle="list" href="#modal-reading-{{ $course->id }}" role="tab" aria-controls="modal-reading-{{ $course->id }}">
                                            <i class="ri-book-open-line fs-18"></i> <span>Reading</span>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center gap-2" id="modal-listening-list-{{ $course->id }}" data-bs-toggle="list" href="#modal-listening-{{ $course->id }}" role="tab" aria-controls="modal-listening-{{ $course->id }}">
                                            <i class="ri-customer-service-line fs-18"></i> <span>Listening</span>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center gap-2" id="modal-speaking-list-{{ $course->id }}" data-bs-toggle="list" href="#modal-speaking-{{ $course->id }}" role="tab" aria-controls="modal-speaking-{{ $course->id }}">
                                            <i class="ri-mic-line fs-18"></i> <span>Speaking</span>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center gap-2" id="modal-writing-list-{{ $course->id }}" data-bs-toggle="list" href="#modal-writing-{{ $course->id }}" role="tab" aria-controls="modal-writing-{{ $course->id }}">
                                            <i class="ri-edit-2-line fs-18"></i> <span>Writing</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="tab-content" id="modalTabContent-{{ $course->id }}">
                                        <div class="tab-pane fade show active p-3 bg-light rounded-3 border-0" id="modal-reading-{{ $course->id }}" role="tabpanel" aria-labelledby="modal-reading-list-{{ $course->id }}">
                                            <label class="label fs-13 mb-2 text-muted uppercase">Reading Custom Prompt</label>
                                            <textarea name="prompts[reading]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Reading...">{{ $readingPrompt }}</textarea>
                                        </div>
                                        <div class="tab-pane fade p-3 bg-light rounded-3 border-0" id="modal-listening-{{ $course->id }}" role="tabpanel" aria-labelledby="modal-listening-list-{{ $course->id }}">
                                            <label class="label fs-13 mb-2 text-muted uppercase">Listening Custom Prompt</label>
                                            <textarea name="prompts[listening]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Listening...">{{ $listeningPrompt }}</textarea>
                                        </div>
                                        <div class="tab-pane fade p-3 bg-light rounded-3 border-0" id="modal-speaking-{{ $course->id }}" role="tabpanel" aria-labelledby="modal-speaking-list-{{ $course->id }}">
                                            <label class="label fs-13 mb-2 text-muted uppercase">Speaking Custom Prompt</label>
                                            <textarea name="prompts[speaking]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Speaking...">{{ $speakingPrompt }}</textarea>
                                        </div>
                                        <div class="tab-pane fade p-3 bg-light rounded-3 border-0" id="modal-writing-{{ $course->id }}" role="tabpanel" aria-labelledby="modal-writing-list-{{ $course->id }}">
                                            <label class="label fs-13 mb-2 text-muted uppercase">Writing Custom Prompt</label>
                                            <textarea name="prompts[writing]" class="form-control" style="height:180px;" placeholder="Enter custom prompt for Writing...">{{ $writingPrompt }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 pt-0 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal" style="background-color: transparent !important; border: 1.5px solid #EAEAEA !important; color: #6c757d !important; box-shadow: none !important;">Cancel</button>
                            <button type="submit" class="btn btn-prompt rounded-pill px-4">Save Prompt</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
            <div class="col-12 text-center">
                No courses found
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-5 flex-wrap gap-2">
        <span>
            Showing {{ $courses->firstItem() ?? 0 }}
            to {{ $courses->lastItem() ?? 0 }}
            of {{ $courses->total() }} entries
        </span>

        {{ $courses->links() }}
    </div>

    {{-- Prompts Management Section --}}
    <div class="card bg-white rounded-10 border border-white mt-5 mb-4 shadow-sm p-4">
        
        {{-- TOP BAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pb-3 border-bottom mb-4">
            <h3 class="mb-0 fw-semibold">Prompts Management</h3>
            <a href="{{ route('admin.prompts.create') }}" class="btn btn-primary px-4">
                + Add Prompt
            </a>
        </div>

        {{-- TABLE --}}
        <div class="default-table-area mx-minus-1">
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
                    @forelse($allPrompts as $prompt)
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
                            <td colspan="7" class="text-center py-4 text-muted">
                                No Prompts Found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span class="fs-15 text-muted">
                    Showing {{ $allPrompts->firstItem() ?? 0 }}
                    to {{ $allPrompts->lastItem() ?? 0 }}
                    of {{ $allPrompts->total() ?? 0 }} entries
                </span>
                {{ $allPrompts->links() }}
            </div>
        </div>

    </div>

</div>



@endsection