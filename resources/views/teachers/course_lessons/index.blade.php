@extends('teachers.layouts.app')

@section('title', 'Manage Lessons | Teacher Panel')

@push('styles')
<style>
    :root {
        --primary-navy: #071530;
        --accent-red: #E53935;
        --soft-bg: #f8fafc;
        --border-color: #eff3f9;
        --text-muted: #64748b;
    }

    .lessons-container {
        font-family: 'Outfit', sans-serif;
    }

    /* Page Header */
    .page-header-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px 30px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        margin-bottom: 25px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 4px;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 0;
    }

    /* Breadcrumbs */
    .premium-breadcrumb {
        font-size: 13px;
        font-weight: 600;
    }
    .premium-breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.2s;
    }
    .premium-breadcrumb a:hover {
        color: var(--accent-red);
    }
    .premium-breadcrumb .active {
        color: var(--accent-red);
        font-weight: 700;
    }

    /* Cards */
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        overflow: hidden;
    }

    /* Course Sidebar Card */
    .course-thumbnail-wrapper {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        overflow: hidden;
        border-radius: 14px;
    }

    .course-thumbnail-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .published-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background-color: #10b981;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }

    .sidebar-course-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--primary-navy);
        line-height: 1.3;
    }

    .sidebar-course-desc {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .course-spec-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1.5px solid var(--border-color);
        font-size: 13px;
    }
    .course-spec-item:last-child {
        border-bottom: none;
    }
    .spec-label {
        color: var(--text-muted);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .spec-value {
        color: var(--primary-navy);
        font-weight: 700;
    }

    /* Navigation Menu */
    .sidebar-nav-menu {
        list-style: none;
        padding: 0;
        margin: 20px 0 0 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .sidebar-nav-item a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        border-radius: 12px;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar-nav-item.active a {
        background-color: rgba(7, 21, 48, 0.05);
        color: var(--primary-navy);
        font-weight: 700;
    }

    .sidebar-nav-item a:hover:not(.active a) {
        color: var(--primary-navy);
        background-color: var(--soft-bg);
    }

    /* Stat Box Cards */
    .stat-box-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 6px 20px rgba(7, 21, 48, 0.01);
    }

    .stat-icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .stat-value {
        font-size: 20px;
        font-weight: 800;
        color: var(--primary-navy);
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 0;
    }

    /* Lessons Table Styling */
    .lessons-table {
        border-collapse: separate !important;
        border-spacing: 0 10px !important;
        margin-bottom: 0;
    }

    .lessons-table thead th {
        background-color: transparent !important;
        color: var(--primary-navy) !important;
        font-weight: 800;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 10px 16px;
        border-bottom: none !important;
    }

    .lessons-table tbody tr {
        background-color: #ffffff !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .lessons-table tbody td {
        padding: 14px 16px !important;
        color: var(--text-muted);
        font-size: 13.5px;
        border-top: 1px solid var(--border-color) !important;
        border-bottom: 1px solid var(--border-color) !important;
        background-color: #ffffff !important;
        vertical-align: middle;
    }

    .lessons-table tbody tr td:first-child {
        border-left: 1px solid var(--border-color) !important;
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
    }

    .lessons-table tbody tr td:last-child {
        border-right: 1px solid var(--border-color) !important;
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    .lessons-table tbody tr:hover {
        transform: translateY(-1.5px) !important;
        box-shadow: 0 8px 24px rgba(7, 21, 48, 0.04) !important;
    }

    /* Lesson Title block */
    .lesson-thumb-box {
        width: 60px;
        height: 40px;
        border-radius: 6px;
        overflow: hidden;
        position: relative;
        background-color: var(--soft-bg);
        border: 1px solid var(--border-color);
    }
    .lesson-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .lesson-play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 14px;
        color: var(--primary-navy);
    }

    /* Badges */
    .premium-pill {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .reorder-handle {
        cursor: grab;
        color: #cbd5e1;
        font-size: 16px;
        transition: color 0.2s;
    }
    .reorder-handle:hover {
        color: var(--text-muted);
    }

    /* Action Buttons */
    .action-btn-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        background-color: #ffffff;
        color: var(--text-muted);
        transition: all 0.2s;
        text-decoration: none;
    }
    .action-btn-circle:hover {
        background-color: var(--soft-bg);
        color: var(--primary-navy);
        border-color: var(--text-muted);
    }
    .action-btn-circle.text-danger:hover {
        background-color: #fef2f2;
        color: var(--accent-red);
        border-color: #fee2e2;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 lessons-container">

    {{-- Page Header --}}
    <div class="page-header-box d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-3 p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                <i class="ri-book-open-line"></i>
            </div>
            <div>
                <h3 class="page-title">Manage Lessons</h3>
                <p class="page-subtitle">Organize and manage lessons for your course</p>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 align-items-center premium-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Courses</a></li>
                <li class="breadcrumb-item active" id="breadcrumbCourseName">Select Course</li>
            </ol>
        </nav>
    </div>

    {{-- Main Columns --}}
    <div class="row g-4">

        {{-- LEFT COLUMN: Course Sidebar --}}
        <div class="col-xl-4 col-lg-5">
            
            {{-- Course Selection List (Only shown when no course is clicked, or as a selector) --}}
            <div class="card premium-card p-4 mb-4" id="courseSelectionCard">
                <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">📚 Assigned Courses</h5>
                <ul class="list-group list-group-flush" id="courseList">
                    @foreach ($alluserCourses as $alluserCourse)
                        @if($alluserCourse->course)
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3 cursor-pointer" 
                                data-id="{{ $alluserCourse->course->id }}" style="cursor: pointer;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 13px;">
                                        {{ strtoupper(substr($alluserCourse->course->title, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 14px;">{{ $alluserCourse->course->title }}</div>
                                        <small class="text-muted">Click to open manager</small>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-muted small"></i>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- Course Detail Sidebar (Populated via JS) --}}
            <div class="card premium-card p-4 d-none" id="courseDetailSidebar">
                <div class="course-thumbnail-wrapper mb-3">
                    <img id="sideCourseThumbnail" src="" class="course-thumbnail-img" alt="Thumbnail" onerror="this.src=noImageBanner;">
                    <span class="published-badge">Published</span>
                </div>

                <h4 class="sidebar-course-title mb-2" id="sideCourseTitle">—</h4>
                <p class="sidebar-course-desc mb-4" id="sideCourseDesc">—</p>

                <div class="course-specs mb-4">
                    <div class="course-spec-item">
                        <span class="spec-label"><i class="bi bi-collection-play text-primary"></i> Total Lessons</span>
                        <span class="spec-value" id="sideLessonsCount">0</span>
                    </div>
                    <div class="course-spec-item">
                        <span class="spec-label"><i class="bi bi-clock text-warning"></i> Duration</span>
                        <span class="spec-value" id="sideDuration">Self-Paced</span>
                    </div>
                    <div class="course-spec-item">
                        <span class="spec-label"><i class="bi bi-people text-success"></i> Students Enrolled</span>
                        <span class="spec-value" id="sideEnrolledCount">0</span>
                    </div>
                    <div class="course-spec-item">
                        <span class="spec-label"><i class="bi bi-check-circle text-info"></i> Status</span>
                        <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 11px;">Active</span>
                    </div>
                </div>

                <ul class="sidebar-nav-menu">
                    <li class="sidebar-nav-item"><a href="#"><i class="bi bi-info-circle"></i> Course Overview</a></li>
                    <li class="sidebar-nav-item active"><a href="#"><i class="bi bi-journal-text"></i> Lessons</a></li>
                    <li class="sidebar-nav-item"><a href="#"><i class="bi bi-patch-question"></i> Quizzes</a></li>
                    <li class="sidebar-nav-item"><a href="#"><i class="bi bi-file-earmark-check"></i> Assignments</a></li>
                    <li class="sidebar-nav-item"><a href="#"><i class="bi bi-gear"></i> Settings</a></li>
                </ul>

                <button class="btn btn-outline-secondary w-100 mt-4 py-2 rounded-12 fw-bold text-uppercase" style="font-size: 12.5px;" onclick="showCourseSelector()">
                    ← Switch Course
                </button>
            </div>

        </div>

        {{-- RIGHT COLUMN: Lessons manager --}}
        <div class="col-xl-8 col-lg-7">
            
            {{-- Choose Course Placeholder --}}
            <div class="card premium-card p-5 text-center" id="lessonsPlaceholder">
                <div class="py-5">
                    <div class="fs-1 mb-3 select-none">📖</div>
                    <h5 class="fw-bold text-dark">No Course Selected</h5>
                    <p class="text-muted small">Please select one of your assigned courses from the left list to manage its lessons.</p>
                </div>
            </div>

            {{-- Lessons Dashboard (Populated via JS) --}}
            <div class="d-none" id="lessonsDashboard">
                
                {{-- Header Summary Box --}}
                <div class="card premium-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h4 class="fw-extrabold text-dark mb-1" style="font-size: 18px; font-weight: 800;">Lessons (<span id="lessonsCountHeader">0</span>)</h4>
                            <p class="text-muted small mb-0">Reorder, edit or add new lessons to build your course structure.</p>
                        </div>
                        <button class="btn btn-primary px-4 fw-bold" id="addLessonBtn" style="display: none !important;">
                            + Add New Lesson
                        </button>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-box-card">
                            <div class="stat-icon-wrapper bg-primary-subtle text-primary"><i class="bi bi-journal-text"></i></div>
                            <div>
                                <div class="stat-value" id="statTotalLessons">0</div>
                                <div class="stat-label">Total Lessons</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-box-card">
                            <div class="stat-icon-wrapper bg-success-subtle text-success"><i class="bi bi-check-circle"></i></div>
                            <div>
                                <div class="stat-value" id="statPublished">0</div>
                                <div class="stat-label">Published</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-box-card">
                            <div class="stat-icon-wrapper bg-warning-subtle text-warning"><i class="bi bi-file-earmark"></i></div>
                            <div>
                                <div class="stat-value">0</div>
                                <div class="stat-label">Draft</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-box-card">
                            <div class="stat-icon-wrapper bg-info-subtle text-info"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <div class="stat-value">0</div>
                                <div class="stat-label">Scheduled</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table Area --}}
                <div class="table-responsive border-0">
                    <table class="table lessons-table align-middle">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Lesson Title</th>
                                <th style="width: 120px;">Type</th>
                                <th style="width: 120px;">Duration</th>
                                <th style="width: 120px;">Status</th>
                                <th class="text-end" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="lessonTableBody">
                            <!-- JS Inject -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    let selectedCourse = null;
    const noImageBanner = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500"><defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23f8fafc;stop-opacity:1"/><stop offset="100%" style="stop-color:%23e2e8f0;stop-opacity:1"/></linearGradient></defs><rect width="100%" height="100%" fill="url(%23bg)"/><g transform="translate(400, 220)" text-anchor="middle"><path d="M-24,-40 L24,-40 C32,-40 38,-34 38,-26 L38,26 C38,34 32,40 24,40 L-24,40 C-32,40 -38,34 -38,26 L-38,-26 C-38,-34 -32,-40 -24,-40 Z" fill="none" stroke="%2364748b" stroke-width="4" stroke-linejoin="round"/><circle cx="0" cy="0" r="14" fill="none" stroke="%2364748b" stroke-width="4"/><circle cx="20" cy="-22" r="4" fill="%2364748b"/><text x="0" y="85" fill="%23071530" font-family="Outfit, sans-serif" font-size="24" font-weight="800" letter-spacing="1">NO IMAGE AVAILABLE</text><text x="0" y="115" fill="%2364748b" font-family="Outfit, sans-serif" font-size="16" font-weight="500">FrancoWay Learning Portal</text></g></svg>';

    $(document).ready(function() {
        // Auto-select the first course on page load if items exist
        let firstCourseItem = $('#courseList [data-id]').first();
        if (firstCourseItem.length > 0) {
            firstCourseItem.trigger('click');
        }
    });

    /* ===============================
       COURSE SELECT / TOGGLES
    ===============================*/
    $('#courseList').on('click', '[data-id]', function() {
        $('#courseList li').removeClass('active bg-light');
        $(this).addClass('active bg-light');
        
        selectedCourse = $(this).data('id');
        $('#lessonsPlaceholder').addClass('d-none');
        $('#lessonsDashboard').removeClass('d-none');
        $('#courseSelectionCard').addClass('d-none');
        $('#courseDetailSidebar').removeClass('d-none');

        // Setup add lesson button
        $('#addLessonBtn')
            .attr('style', 'display: inline-flex !important;')
            .off('click')
            .on('click', function() {
                if (!selectedCourse) return;
                window.location.href = "{{ route('teacher.lessons.create', ':id') }}".replace(':id', selectedCourse);
            });

        loadLessons(selectedCourse);
    });

    function showCourseSelector() {
        $('#courseSelectionCard').removeClass('d-none');
        $('#courseDetailSidebar').addClass('d-none');
        $('#lessonsPlaceholder').removeClass('d-none');
        $('#lessonsDashboard').addClass('d-none');
        selectedCourse = null;
        $('#breadcrumbCourseName').text('Select Course');
    }

    /* ===============================
       LOAD LESSONS
    ===============================*/
    function loadLessons(courseId) {
        $('#lessonTableBody').html(`
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                    <p class="mt-2 mb-0 text-muted">Loading lessons...</p>
                </td>
            </tr>
        `);

        $.ajax({
            url: "{{ url('/teacher/ajax/course') }}/" + courseId + "/lessons",
            type: "GET",
            success: function(res) {
                // Populate Breadcrumbs & Title
                $('#breadcrumbCourseName').text(res.course.title);
                $('#sideCourseTitle').text(res.course.title);
                $('#sideCourseDesc').text(res.course.description || 'No description available for this course.');
                
                // Course stats
                let lessonsCount = res.lessons.length;
                $('#sideLessonsCount').text(lessonsCount);
                $('#lessonsCountHeader').text(lessonsCount);
                $('#statTotalLessons').text(lessonsCount);
                $('#statPublished').text(lessonsCount);
                $('#sideEnrolledCount').text(res.enrolled_count || 0);

                // Set Thumbnail
                let courseThumbnail = res.course.thumbnail ? "{{ asset('storage') }}/" + res.course.thumbnail : noImageBanner;
                $('#sideCourseThumbnail').attr('src', courseThumbnail);

                if (lessonsCount === 0) {
                    $('#lessonTableBody').html(`
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="fs-2 mb-2">📂</div>
                                <div class="fw-bold">No Lessons Created Yet</div>
                                <small>Click '+ Add New Lesson' to get started.</small>
                            </td>
                        </tr>
                    `);
                    return;
                }

                let html = '';
                res.lessons.forEach((lesson, index) => {
                    let lType = lesson.lesson_type || lesson.type || 'video';
                    let typeBadgeColor = 'bg-primary-subtle text-primary';
                    let typeLabel = 'Video';
                    let thumbContent = '';

                    let imagePath = lesson.image_file ? ("{{ asset('storage') }}/" + lesson.image_file) : null;

                    if (lType === 'image') {
                        typeBadgeColor = 'bg-success-subtle text-success';
                        typeLabel = 'Image';
                        if (imagePath) {
                            thumbContent = `<img src="${imagePath}" alt="${lesson.title}">`;
                        } else {
                            thumbContent = `<i class="bi bi-image-fill lesson-play-icon text-success fs-5"></i>`;
                        }
                    } else if (lType === 'audio') {
                        typeBadgeColor = 'bg-warning-subtle text-warning';
                        typeLabel = 'Audio';
                        thumbContent = `<i class="bi bi-mic-fill lesson-play-icon text-warning fs-5"></i>`;
                    } else if (lType === 'pdf') {
                        typeBadgeColor = 'bg-danger-subtle text-danger';
                        typeLabel = 'PDF';
                        thumbContent = `<i class="bi bi-file-earmark-pdf-fill lesson-play-icon text-danger fs-5"></i>`;
                    } else if (lType === 'summary' || lType === 'text') {
                        typeBadgeColor = 'bg-info-subtle text-info';
                        typeLabel = 'Summary';
                        thumbContent = `<i class="bi bi-file-text-fill lesson-play-icon text-info fs-5"></i>`;
                    } else { // video or default
                        typeBadgeColor = 'bg-primary-subtle text-primary';
                        typeLabel = 'Video';
                        if (imagePath) {
                            thumbContent = `<img src="${imagePath}" alt="${lesson.title}"><i class="bi bi-play-circle-fill lesson-play-icon text-white drop-shadow"></i>`;
                        } else {
                            thumbContent = `<i class="bi bi-play-circle-fill lesson-play-icon text-primary fs-5"></i>`;
                        }
                    }

                    let durationText = lesson.duration ? lesson.duration : '—';

                    html += `
                        <tr>
                            <td class="text-center"><i class="bi bi-grip-vertical reorder-handle"></i></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="lesson-thumb-box flex-shrink-0">
                                        ${thumbContent}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 14px;">${lesson.title}</div>
                                        <small class="text-muted d-block" style="font-size: 11.5px; max-width: 320px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                            ${lesson.description || 'No description provided.'}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="premium-pill ${typeBadgeColor}">${typeLabel}</span>
                            </td>
                            <td class="fw-semibold text-dark">${durationText}</td>
                            <td>
                                <span class="premium-pill bg-success-subtle text-success">Published</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- VIEW -->
                                    <a href="/teacher/lessons/${lesson.id}" class="action-btn-circle" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!-- EDIT -->
                                    <a href="/teacher/lessons/${lesson.id}/edit" class="action-btn-circle" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- DELETE -->
                                    <button class="action-btn-circle text-danger deleteLesson" data-id="${lesson.id}" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                $('#lessonTableBody').html(html);
            }
        });
    }

    /* ===============================
       DELETE LESSON
    ===============================*/
    $(document).on('click', '.deleteLesson', function() {
        let lessonId = $(this).data('id');
        confirmAction('Delete Lesson', 'Are you sure you want to delete this lesson?', 'Yes, delete it!', function() {
            $.ajax({
                url: '/teacher/ajax/lesson/' + lessonId,
                method: 'GET',
                success: function(res) {
                    showToast('Lesson deleted successfully', 'success');
                    loadLessons(selectedCourse);
                }
            });
        });
    });
</script>
@endpush
