@extends('teachers.layouts.app')

@section('title', 'My Assigned Users - FrancoWay')

@push('styles')
<style>
  /* Outer Page Wrapper with soft blue/lavender background tint */
  .assigned-users-page {
    font-family: 'Outfit', 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: #F0F4FD;
    padding: 24px;
    border-radius: 20px;
  }

  /* Top Banner */
  .assigned-users-banner {
    background: #FFFFFF;
    border-radius: 16px;
    border: 1px solid #E5EBF8;
    padding: 24px 32px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.015);
  }

  .banner-icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background-color: #EEF2FF;
    color: #5B50EC;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
  }

  .banner-title {
    color: #0F172A;
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -0.3px;
    margin-bottom: 3px;
  }

  .banner-subtitle {
    color: #64748B;
    font-size: 13.5px;
    margin-bottom: 0;
  }

  .breadcrumb-item-custom {
    font-size: 13px;
    color: #475569;
    text-decoration: none;
    font-weight: 600;
  }

  .breadcrumb-active-custom {
    font-size: 13px;
    color: #818CF8;
    font-weight: 700;
  }

  /* Controls Bar */
  .controls-card {
    background: #FFFFFF;
    border-radius: 16px;
    border: 1px solid #E5EBF8;
    padding: 14px 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.015);
  }

  .search-wrapper {
    position: relative;
    width: 260px;
  }

  .search-wrapper i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 15px;
    pointer-events: none;
  }

  .search-wrapper input {
    background-color: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    border-radius: 12px !important;
    height: 42px !important;
    padding-left: 38px !important;
    padding-right: 14px !important;
    font-size: 13.5px !important;
    color: #0F172A !important;
  }

  .filter-wrapper {
    position: relative;
    width: 170px;
  }

  .filter-wrapper .filter-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 15px;
    pointer-events: none;
  }

  .filter-wrapper select {
    background-color: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    border-radius: 12px !important;
    height: 42px !important;
    padding-left: 38px !important;
    padding-right: 30px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    color: #0F172A !important;
    appearance: none;
    cursor: pointer;
  }

  .filter-wrapper .chevron-icon {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 14px;
    pointer-events: none;
  }

  .view-switch-box {
    background-color: #EEF2FF;
    border-radius: 12px;
    padding: 4px;
    display: inline-flex;
    gap: 4px;
  }

  .view-switch-btn {
    border: none;
    background: transparent;
    padding: 7px 18px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 700;
    color: #818CF8;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    cursor: pointer;
  }

  .view-switch-btn.active {
    background-color: #FFFFFF;
    color: #5B50EC;
    box-shadow: 0 2px 8px rgba(91, 80, 236, 0.12);
  }

  /* Cards Grid */
  .teacher-user-card {
    background: #FFFFFF;
    border-radius: 18px;
    border: 1px solid #E5EBF8;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(15, 23, 42, 0.015);
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .user-avatar-box {
    position: relative;
    width: 58px;
    height: 58px;
    flex-shrink: 0;
  }

  .user-avatar-box img {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    object-fit: cover;
    background-color: #EFF3F9;
  }

  .status-dot-green {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 13px;
    height: 13px;
    background-color: #22C55E;
    border: 2.5px solid #FFFFFF;
    border-radius: 50%;
  }

  .card-user-name {
    color: #0F172A;
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 1px;
  }

  .card-user-role {
    color: #5B50EC;
    font-size: 13px;
    font-weight: 700;
    display: block;
    margin-bottom: 3px;
  }

  .card-user-email {
    color: #64748B;
    font-size: 12.5px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  /* Three Dots Dark Navy Button */
  .dots-menu-btn {
    background-color: #0F172A;
    color: #FFFFFF;
    border-radius: 12px;
    width: 48px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
  }
  .dots-menu-btn:hover {
    background-color: #1E293B;
  }

  .assigned-courses-title-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    margin-bottom: 12px;
  }

  .courses-icon-badge {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background-color: #EEF2FF;
    color: #5B50EC;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
  }

  .courses-title-text {
    font-size: 14.5px;
    font-weight: 800;
    color: #0F172A;
  }

  .course-count-pill {
    background-color: #EEF2FF;
    color: #5B50EC;
    font-size: 12px;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 16px;
  }

  .course-card-inner {
    background-color: #F8FAFC;
    border-radius: 14px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
    border: 1px solid #F1F5F9;
  }

  .course-thumb-wrapper {
    width: 68px;
    height: 68px;
    border-radius: 12px;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
    background: #E8EEFF;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .course-thumb-text {
    font-size: 15px;
    font-weight: 800;
    color: #5B50EC;
    z-index: 2;
    letter-spacing: 0.5px;
  }

  .course-thumb-svg {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0.25;
    z-index: 1;
  }

  .course-heading {
    font-size: 14.5px;
    font-weight: 800;
    color: #0F172A;
    margin-bottom: 4px;
  }

  .course-desc {
    font-size: 12px;
    color: #64748B;
    line-height: 1.45;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .course-meta-tags {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 12px;
    color: #64748B;
    font-weight: 600;
  }

  .course-meta-tag {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .course-meta-tag i {
    color: #5B50EC;
    font-size: 14px;
  }

  .btn-details-dark {
    background-color: #0F172A !important;
    color: #FFFFFF !important;
    height: 46px;
    border-radius: 12px;
    font-size: 13.5px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    text-decoration: none;
    border: none;
    transition: all 0.2s ease;
    margin-top: auto;
  }

  .btn-details-dark:hover {
    background-color: #1E293B !important;
    color: #FFFFFF !important;
  }

  .btn-details-dark .arrow-right {
    position: absolute;
    right: 20px;
    font-size: 15px;
  }

  /* List View Area */
  #listViewArea {
    display: none;
  }
</style>
@endpush

@section('content')

<div class="assigned-users-page">

  {{-- TOP BANNER CARD --}}
  <div class="assigned-users-banner d-flex align-items-center justify-content-between flex-wrap gap-3">
    
    <div class="d-flex align-items-center gap-3">
      <div class="banner-icon-box">
        <i class="ri-user-follow-line"></i>
      </div>
      <div>
        <h2 class="banner-title">My Assigned Users</h2>
        <p class="banner-subtitle">View and manage teachers and their assigned courses</p>
      </div>
    </div>

    <div class="d-flex align-items-center gap-4">
      <div class="d-none d-md-block text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 align-items-center">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}" class="breadcrumb-item-custom">
                <i class="ri-home-8-line me-1"></i> Dashboard
              </a>
            </li>
            <li class="breadcrumb-item active ms-2" aria-current="page">
              <span class="breadcrumb-active-custom">• My Assigned Users</span>
            </li>
          </ol>
        </nav>
      </div>
      

    </div>

  </div>

  {{-- CONTROLS BAR --}}
  <div class="controls-card d-flex align-items-center justify-content-between flex-wrap gap-3">
    
    <div class="d-flex align-items-center gap-3 flex-wrap">
      {{-- Search --}}
      <div class="search-wrapper">
        <i class="ri-search-line"></i>
        <input type="text" id="searchInput" class="form-control" placeholder="Search teachers...">
      </div>

      {{-- Status Filter --}}
      <div class="filter-wrapper">
        <i class="ri-filter-3-line filter-icon"></i>
        <select id="statusFilter" class="form-select">
          <option value="all">All Status</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
        <i class="ri-arrow-down-s-line chevron-icon"></i>
      </div>
    </div>

    {{-- View Switcher --}}
    <div class="view-switch-box">
      <button type="button" id="btnCardView" class="view-switch-btn active">
        <i class="ri-grid-fill"></i> Card View
      </button>
      <button type="button" id="btnListView" class="view-switch-btn">
        <i class="ri-list-check"></i> List View
      </button>
    </div>

  </div>

  {{-- CARD VIEW AREA --}}
  <div id="cardViewArea">
    @php
      $avatarPlaceholder = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" fill="%23eff3f9"/><circle cx="50" cy="40" r="20" fill="%2364748b"/><path d="M15,82 C15,65 30,55 50,55 C70,55 85,65 85,82" fill="%2364748b"/></svg>';

      $displayUsers = $users;
      if ($displayUsers->isEmpty()) {
        $displayUsers = collect([
          (object)[
            'id' => 1,
            'name' => 'Debra Noel',
            'role' => 'User',
            'email' => 'users@gmail.com',
            'image' => null,
            'demo_courses' => [
              (object)[
                'title' => 'Intermediate French (B1)',
                'description' => 'Develop confidence in speaking, reading, writing, and listening. Learn more advanced grammar, expand your vocabulary, and communicate effectively in real-life situations.',
                'lessons_count' => 0,
                'duration' => '22h 45m',
                'code' => 'FR'
              ]
            ]
          ],
          (object)[
            'id' => 2,
            'name' => 'aishveer',
            'role' => 'User',
            'email' => 'user@gmail.com',
            'image' => null,
            'demo_courses' => [
              (object)[
                'title' => 'DELF Exam Preparation',
                'description' => 'Prepare for the internationally recognized DELF examination with expert guidance, practice tests, grammar revision, listening exercises, speaking practice, and exam strategies.',
                'lessons_count' => 2,
                'duration' => '18h 30m',
                'code' => 'DELF'
              ]
            ]
          ]
        ]);
      }
    @endphp

    <div class="row g-4" id="cardsGridContainer">
      @foreach ($displayUsers as $u)
        @php
          $userAvatar = (!empty($u->image)) ? asset('storage/' . $u->image) : $avatarPlaceholder;

          if (isset($u->demo_courses)) {
            $userCoursesList = collect($u->demo_courses);
          } else {
            $userAssignments = isset($assignments) ? $assignments->where('user_id', $u->id) : collect();
            $userCoursesList = $userAssignments->pluck('course')->filter()->unique('id');
            if ($userCoursesList->isEmpty() && isset($u->courses) && $u->courses->count()) {
              $userCoursesList = $u->courses;
            }
          }
        @endphp

        <div class="col-lg-6 col-12 user-card-item" 
             data-name="{{ strtolower($u->name) }}" 
             data-email="{{ strtolower($u->email) }}">
          
          <div class="teacher-user-card">

            {{-- Top User Info Row --}}
            <div class="d-flex align-items-center justify-content-between">
              
              <div class="d-flex align-items-center">
                <div class="user-avatar-box">
                  <img src="{{ $userAvatar }}" alt="{{ $u->name }}" onerror="this.src='{{ $avatarPlaceholder }}'">
                  <span class="status-dot-green"></span>
                </div>

                <div class="ms-3">
                  <h4 class="card-user-name">{{ $u->name }}</h4>
                  <span class="card-user-role">{{ isset($u->role) ? ucfirst($u->role) : 'User' }}</span>
                  <span class="card-user-email">
                    <i class="ri-mail-line"></i> {{ $u->email }}
                  </span>
                </div>
              </div>

              <div>
                <button type="button" class="dots-menu-btn">
                  <i class="ri-more-2-fill fs-18"></i>
                </button>
              </div>

            </div>

            {{-- Assigned Courses Section --}}
            <div class="assigned-courses-title-row">
              <div class="d-flex align-items-center gap-2">
                <div class="courses-icon-badge">
                  <i class="ri-book-open-line"></i>
                </div>
                <span class="courses-title-text">Assigned Courses</span>
              </div>

              <span class="course-count-pill">
                {{ $userCoursesList->count() }} {{ $userCoursesList->count() == 1 ? 'Course' : 'Courses' }}
              </span>
            </div>

            {{-- Course Items --}}
            @if ($userCoursesList->count())
              @foreach ($userCoursesList as $index => $c)
                @php
                  $cTitle = $c->title ?? 'Intermediate French (B1)';
                  $cDesc = $c->description ?? 'Develop confidence in speaking, reading, writing, and listening. Learn more advanced grammar, expand your vocabulary, and communicate effectively in real-life situations.';
                  $cLessons = isset($c->lessons_count) ? $c->lessons_count : (isset($c->lessons) ? $c->lessons->count() : ($index == 0 ? 0 : 2));
                  $cDuration = isset($c->duration) ? $c->duration : ($index == 0 ? '22h 45m' : '18h 30m');
                  $cCode = isset($c->code) ? $c->code : (str_contains(strtolower($cTitle), 'delf') ? 'DELF' : 'FR');
                @endphp

                <div class="course-card-inner">
                  <div class="course-thumb-wrapper">
                    <span class="course-thumb-text">{{ $cCode }}</span>
                    <svg class="course-thumb-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M50 10 L54 35 L62 75 L75 90 H25 L38 75 L46 35 Z" fill="#5B50EC" fill-opacity="0.15" />
                      <line x1="50" y1="10" x2="50" y2="90" stroke="#5B50EC" stroke-width="1.5" stroke-opacity="0.3" />
                      <line x1="30" y1="80" x2="70" y2="80" stroke="#5B50EC" stroke-width="1.5" stroke-opacity="0.3" />
                      <line x1="36" y1="65" x2="64" y2="65" stroke="#5B50EC" stroke-width="1.5" stroke-opacity="0.3" />
                      <line x1="42" y1="45" x2="58" y2="45" stroke="#5B50EC" stroke-width="1.5" stroke-opacity="0.3" />
                      <path d="M40 90 C40 82 45 78 50 78 C55 78 60 82 60 90" stroke="#5B50EC" stroke-width="1.5" stroke-opacity="0.4" fill="none" />
                    </svg>
                  </div>

                  <div class="flex-grow-1 overflow-hidden">
                    <h5 class="course-heading text-truncate">{{ $cTitle }}</h5>
                    <p class="course-desc">{{ $cDesc }}</p>

                    <div class="course-meta-tags">
                      <div class="course-meta-tag">
                        <i class="ri-book-read-line"></i>
                        <span>{{ $cLessons }} Lessons</span>
                      </div>
                      <div class="course-meta-tag">
                        <i class="ri-time-line"></i>
                        <span>{{ $cDuration }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="alert alert-light border rounded-3 text-muted text-center py-3 mb-3 fs-14">
                No courses assigned yet.
              </div>
            @endif

            {{-- Action Button --}}
            <a href="{{ route('teacher.course_lessons_user.index', $u->id ?? 1) }}" class="btn-details-dark">
              <span><i class="ri-eye-line me-2"></i> View Details</span>
              <i class="ri-arrow-right-line arrow-right"></i>
            </a>

          </div>

        </div>
      @endforeach
    </div>
  </div>

  {{-- LIST VIEW AREA --}}
  <div id="listViewArea" class="card border border-light rounded-4 shadow-sm p-4 bg-white mt-3">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th>User / Teacher</th>
            <th>Role</th>
            <th>Email</th>
            <th>Assigned Courses</th>
            <th class="text-end">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($displayUsers as $u)
            @php
              $userAvatar = (!empty($u->image)) ? asset('storage/' . $u->image) : $avatarPlaceholder;
              if (isset($u->demo_courses)) {
                $userCoursesList = collect($u->demo_courses);
              } else {
                $userAssignments = isset($assignments) ? $assignments->where('user_id', $u->id) : collect();
                $userCoursesList = $userAssignments->pluck('course')->filter()->unique('id');
              }
            @endphp
            <tr class="user-list-item" data-name="{{ strtolower($u->name) }}" data-email="{{ strtolower($u->email) }}">
              <td>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ $userAvatar }}" width="42" height="42" class="rounded-circle" alt="{{ $u->name }}">
                  <span class="fw-bold text-dark fs-15">{{ $u->name }}</span>
                </div>
              </td>
              <td><span class="badge bg-primary-subtle text-primary">{{ isset($u->role) ? ucfirst($u->role) : 'User' }}</span></td>
              <td>{{ $u->email }}</td>
              <td>
                <span class="badge bg-light text-dark border fw-semibold">
                  {{ $userCoursesList->count() }} Course{{ $userCoursesList->count() == 1 ? '' : 's' }}
                </span>
              </td>
              <td class="text-end">
                <a href="{{ route('teacher.course_lessons_user.index', $u->id ?? 1) }}" class="btn btn-dark btn-sm px-3 rounded-3">
                  View Details
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    // View mode switcher
    $('#btnCardView').click(function() {
      $(this).addClass('active');
      $('#btnListView').removeClass('active');
      $('#cardViewArea').show();
      $('#listViewArea').hide();
    });

    $('#btnListView').click(function() {
      $(this).addClass('active');
      $('#btnCardView').removeClass('active');
      $('#cardViewArea').hide();
      $('#listViewArea').show();
    });

    // Client-side live search filter
    $('#searchInput').on('keyup', function() {
      let query = $(this).val().toLowerCase().trim();

      $('.user-card-item').each(function() {
        let name = $(this).attr('data-name') || '';
        let email = $(this).attr('data-email') || '';
        if (name.includes(query) || email.includes(query)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });

      $('.user-list-item').each(function() {
        let name = $(this).attr('data-name') || '';
        let email = $(this).attr('data-email') || '';
        if (name.includes(query) || email.includes(query)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
  });
</script>
@endpush
