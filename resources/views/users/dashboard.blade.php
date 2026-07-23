@extends('users.layouts.app')

@section('title', 'Student Dashboard | ' . ($settings['site_name'] ?? 'Francoway'))

@push('styles')
<style>
    /* Welcome Banner (Skyline & Flag layout) specific to Dashboard */
    .welcome-banner-clean {
        background: #F4F7FC url('{{ asset("assets/images/user_dashboard_banner.png") }}') no-repeat center right;
        background-size: cover;
        position: relative;
        overflow: hidden;
        padding: 45px 40px;
        border-radius: 20px;
        margin-bottom: 30px;
        border: 1px solid #EAEAEA;
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
    }
    .welcome-text-title {
        font-family: 'Poppins', sans-serif !important;
        font-size: 38px;
        font-weight: 800;
        color: #071530;
        line-height: 1.25;
    }
    .welcome-text-title span.highlight-red {
        color: #E53935;
    }
    .welcome-user-greeting {
        font-family: 'Outfit', sans-serif;
        color: #071530;
        font-size: 15px;
        font-weight: 800;
        display: block;
        margin-bottom: 5px;
    }

    /* Large white container holding grid and stats (Apple Style) */
    .dashboard-white-card-container {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(7, 21, 48, 0.02);
        border: 1px solid #EAEAEA;
    }
    .card-container-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .card-container-title {
        font-size: 18px;
        font-weight: 800;
        font-family: 'Outfit', sans-serif;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #071530;
    }
    .card-container-title i {
        color: #E53935;
        font-size: 20px;
    }
    .btn-view-all-courses {
        color: #E53935;
        font-weight: 700;
        font-size: 13.5px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }
    .btn-view-all-courses:hover {
        gap: 8px;
        color: #0B1F4D;
    }

    /* Premium Course Cards inside Grid */
    .mirror-course-card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #EAEAEA;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .mirror-course-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(7, 21, 48, 0.06);
    }
    .mirror-card-img-box {
        position: relative;
        aspect-ratio: 16/10;
        overflow: hidden;
    }
    .mirror-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .mirror-status-badge {
        position: absolute;
        bottom: 12px;
        right: 12px;
        font-weight: 800;
        font-size: 9.5px;
        text-transform: capitalize;
        padding: 4px 10px;
        border-radius: 8px;
        color: #ffffff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .mirror-badge-in-progress {
        background-color: #16A34A; /* Green in screenshot */
    }
    .mirror-badge-completed {
        background-color: #16A34A; /* Green in screenshot */
    }
    .mirror-badge-blue-progress {
        background-color: #0B1F4D; /* Blue in screenshot */
    }
    .mirror-card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .mirror-course-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 16px;
        color: #071530;
        margin-bottom: 8px;
    }
    .mirror-course-desc {
        font-size: 12.5px;
        color: #5A6A85;
        line-height: 1.5;
        margin-bottom: 20px;
    }
    
    /* Progress bar */
    .mirror-progress-bar-wrap {
        margin-bottom: 20px;
    }
    .mirror-progress-track {
        height: 5px;
        background-color: #F1F5F9;
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .mirror-progress-bar-fill {
        height: 100%;
        background-color: #E53935; /* Red bar in screenshot */
        border-radius: 3px;
    }
    .mirror-progress-pct {
        font-size: 11px;
        color: #5A6A85;
        font-weight: 600;
        text-align: right;
    }

    /* Buttons */
    .mirror-btn-navy {
        height: 44px;
        border-radius: 10px;
        background-color: #0B1F4D;
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background-color 0.2s;
    }
    .mirror-btn-navy:hover {
        background-color: #E53935;
    }
    .mirror-btn-outline {
        height: 44px;
        border-radius: 10px;
        background-color: transparent;
        border: 1px solid #0B1F4D;
        color: #0B1F4D;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .mirror-btn-outline:hover {
        background-color: #0B1F4D;
        color: #ffffff;
    }
    .mirror-btn-red {
        height: 44px;
        border-radius: 10px;
        background-color: #E53935;
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background-color 0.2s;
        text-decoration: none;
    }
    .mirror-btn-red:hover {
        background-color: #0B1F4D;
        color: #ffffff;
    }

    /* Right Stack Statistics Cards */
    .mirror-stat-card {
        border-radius: 12px;
        border: 1px solid #EAEAEA;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        background-color: #ffffff;
        transition: transform 0.2s;
    }
    .mirror-stat-card:hover {
        transform: translateY(-2px);
    }
    .mirror-stat-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .mirror-stat-icon-blue {
        background-color: rgba(11, 31, 77, 0.06);
        color: #0B1F4D;
    }
    .mirror-stat-icon-green {
        background-color: rgba(22, 163, 74, 0.06);
        color: #16A34A;
    }
    .mirror-stat-icon-orange {
        background-color: rgba(245, 158, 11, 0.06);
        color: #F59E0B;
    }
    .mirror-stat-label {
        font-size: 11.5px;
        color: #5A6A85;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 2px;
    }
    .mirror-stat-val {
        font-size: 20px;
        font-weight: 900;
        color: #071530;
        font-family: 'Outfit', sans-serif;
    }

    /* Bottom Features row */
    .mirror-features-row {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #EAEAEA;
        margin-top: 30px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .mirror-feature-item {
        text-align: center;
        flex: 1;
        min-width: 140px;
    }
    .mirror-feature-icon {
        font-size: 26px;
        color: #0B1F4D;
        margin-bottom: 8px;
    }
    .mirror-feature-title {
        font-weight: 800;
        font-size: 13px;
        color: #071530;
        margin-bottom: 2px;
    }
    .mirror-feature-sub {
        font-size: 11px;
        color: #5A6A85;
    }

    @media (max-width: 768px) {
        .welcome-banner-clean {
            padding: 30px 20px;
            background-position: 70% center;
        }
        .welcome-text-title {
            font-size: 28px;
        }
        .mirror-features-row {
            flex-direction: column;
            align-items: flex-start;
            padding: 20px;
        }
        .mirror-feature-item {
            text-align: left;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .mirror-feature-icon {
            margin-bottom: 0;
        }
    }
</style>
@endpush

@section('content')
<!-- Welcome Banner area (Unbordered Skyline Illustration) -->
<div class="welcome-banner-clean" data-aos="fade-down" data-aos-duration="600">
    <div class="row align-items-center">
        <div class="col-lg-6 z-3">
            <span class="welcome-user-greeting">Bonjour, {{ auth()->user()->name }}! 👋</span>
            <h1 class="welcome-text-title mt-2">
                Welcome to your <span class="highlight-red">French</span><br>learning journey.
            </h1>
            <p class="text-muted small mt-3">Continue learning and achieve your goals.</p>
        </div>
    </div>
</div>

<!-- Large White Container holding Grid and Stats Stack -->
<div class="dashboard-white-card-container mb-4" data-aos="fade-up" data-aos-duration="600">
    
    <div class="card-container-header">
        <h4 class="card-container-title">
            <i class="bi bi-journal-check"></i> My Purchased Courses
        </h4>
        <a href="{{ route('courses.index') }}" class="btn-view-all-courses">
            View All Courses <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="row g-4">
        
        <!-- Left Courses cards grid (col-lg-9) -->
        <div class="col-lg-9">
            <div class="row g-4">
                @if($courses->count())
                    @foreach ($courses->take(3) as $course)
                        @php
                            $subscription = \App\Models\CourseUserSubscription::where('user_id', auth()->id())
                                ->where('course_id', $course->id)
                                ->latest()
                                ->first();

                            $daysLeft = null;
                            if($subscription && $subscription->expiry_date){
                                $today = now()->startOfDay();
                                $expiry = \Carbon\Carbon::parse($subscription->expiry_date)->startOfDay();
                                $daysLeft = $today->diffInDays($expiry, false);
                            }

                            $isFree = $course->price == 0;
                            $isExpired = (!$isFree && $daysLeft !== null && $daysLeft < 0);
                            $isPending = (!$isFree && (!$subscription || $subscription->payment_status === 'pending' || $subscription->status === 'unpaid'));
                            
                            $completed = ($course->completionPercentage >= 100);
                            
                            // Mirror Status badge mapping
                            $badgeClass = 'mirror-badge-in-progress';
                            $statusText = 'In Progress';
                            if($isPending) {
                                $badgeClass = 'bg-warning text-dark';
                                $statusText = '🔒 Pending Payment';
                            } elseif($completed){
                                $badgeClass = 'mirror-badge-completed';
                                $statusText = 'Completed';
                            } elseif($isExpired) {
                                $badgeClass = 'bg-secondary';
                                $statusText = 'Expired';
                            } else {
                                if($loop->index % 2 == 1){
                                    $badgeClass = 'mirror-badge-blue-progress';
                                }
                            }

                            $titleLower = strtolower($course->title);
                            if (strpos($titleLower, 'a1') !== false) {
                                $imgUrl = 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&q=80&w=400';
                            } elseif (strpos($titleLower, 'a2') !== false) {
                                $imgUrl = 'https://images.unsplash.com/photo-1549144511-f099e773c147?auto=format&fit=crop&q=80&w=400';
                            } else {
                                $imgUrl = 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&q=80&w=400';
                            }
                            $courseImage = $course->thumbnail ? asset('storage/'.$course->thumbnail) : $imgUrl;
                        @endphp

                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="mirror-course-card">
                                <div class="mirror-card-img-box">
                                    <img src="{{ $courseImage }}" class="mirror-card-img" alt="{{ $course->title }}">
                                    <span class="mirror-status-badge {{ $badgeClass }}">{{ $statusText }}</span>
                                </div>

                                <div class="mirror-card-body">
                                    <div>
                                        <h5 class="mirror-course-title mb-1">{{ $course->title }}</h5>
                                        <p class="mirror-course-desc">
                                            {{ \Illuminate\Support\Str::limit($course->description, 55) }}
                                        </p>
                                    </div>

                                    <div>
                                        <!-- Red Progress Bar styling -->
                                        <div class="mirror-progress-bar-wrap">
                                            <div class="mirror-progress-track">
                                                <div class="mirror-progress-bar-fill" style="width: {{ $course->completionPercentage ?? 0 }}%"></div>
                                            </div>
                                            <div class="mirror-progress-pct">{{ $course->completionPercentage ?? 0 }}% Complete</div>
                                        </div>

                                        <!-- Action Buttons mirroring -->
                                        @if($isExpired)
                                            <button class="mirror-btn-navy w-100" disabled>🔒 Expired</button>
                                        @elseif($isPending)
                                            <a href="{{ route('users.checkout', $course->id) }}" class="mirror-btn-red w-100 text-center text-truncate d-block">
                                                <i class="bi bi-credit-card-2-front-fill"></i> Complete Payment
                                            </a>
                                        @else
                                            <div class="d-flex gap-2">
                                                @if($completed)
                                                    <a href="{{ route('users.lessons.index', $course->id) }}" class="mirror-btn-outline flex-grow-1 text-truncate">
                                                        <i class="bi bi-book-half"></i> Review
                                                    </a>
                                                @else
                                                    <a href="{{ route('users.lessons.index', $course->id) }}" class="mirror-btn-navy flex-grow-1 text-truncate">
                                                        <i class="bi bi-play-fill"></i> Continue
                                                    </a>
                                                @endif
                                                <a href="{{ route('ai.practice', ['course_id' => $course->id]) }}" class="mirror-btn-red flex-grow-1 text-truncate">
                                                    <i class="bi bi-robot"></i> Start Quiz
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Card 1: French Beginner A1 -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="mirror-course-card">
                            <div class="mirror-card-img-box">
                                <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&q=80&w=400" class="mirror-card-img" alt="French Beginner A1">
                                <span class="mirror-status-badge mirror-badge-completed">In Progress</span>
                            </div>
                            <div class="mirror-card-body">
                                <div>
                                    <h5 class="mirror-course-title mb-1">French Beginner A1</h5>
                                    <p class="mirror-course-desc">Start your French journey with basic conversations and vocabulary.</p>
                                </div>
                                <div>
                                    <div class="mirror-progress-bar-wrap">
                                        <div class="mirror-progress-track">
                                            <div class="mirror-progress-bar-fill" style="width: 65%"></div>
                                        </div>
                                        <div class="mirror-progress-pct">65% Complete</div>
                                    </div>
                                     <div class="d-flex gap-2">
                                         <a href="/users/courses/24" class="mirror-btn-navy flex-grow-1 text-truncate">
                                             <i class="bi bi-play-fill"></i> Continue
                                         </a>
                                         <a href="{{ route('ai.practice', ['course_id' => 24]) }}" class="mirror-btn-red flex-grow-1 text-truncate">
                                             <i class="bi bi-robot"></i> Start Quiz
                                         </a>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: French Grammar Essentials -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="mirror-course-card">
                            <div class="mirror-card-img-box">
                                <img src="https://images.unsplash.com/photo-1549144511-f099e773c147?auto=format&fit=crop&q=80&w=400" class="mirror-card-img" alt="French Grammar Essentials">
                                <span class="mirror-status-badge mirror-badge-completed">Completed</span>
                            </div>
                            <div class="mirror-card-body">
                                <div>
                                    <h5 class="mirror-course-title mb-1">French Grammar Essentials</h5>
                                    <p class="mirror-course-desc">Master the essential grammar rules in French.</p>
                                </div>
                                <div>
                                    <div class="mirror-progress-bar-wrap">
                                        <div class="mirror-progress-track">
                                            <div class="mirror-progress-bar-fill" style="width: 100%"></div>
                                        </div>
                                        <div class="mirror-progress-pct">100% Complete</div>
                                    </div>
                                     <div class="d-flex gap-2">
                                         <a href="/users/courses/25" class="mirror-btn-outline flex-grow-1 text-truncate">
                                             <i class="bi bi-book-half"></i> Review
                                         </a>
                                         <a href="{{ route('ai.practice', ['course_id' => 25]) }}" class="mirror-btn-red flex-grow-1 text-truncate">
                                             <i class="bi bi-robot"></i> Start Quiz
                                         </a>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: French Conversation B1 -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="mirror-course-card">
                            <div class="mirror-card-img-box">
                                <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&q=80&w=400" class="mirror-card-img" alt="French Conversation B1">
                                <span class="mirror-status-badge mirror-badge-blue-progress">In Progress</span>
                            </div>
                            <div class="mirror-card-body">
                                <div>
                                    <h5 class="mirror-course-title mb-1">French Conversation B1</h5>
                                    <p class="mirror-course-desc">Improve your speaking skills and converse confidently.</p>
                                </div>
                                <div>
                                    <div class="mirror-progress-bar-wrap">
                                        <div class="mirror-progress-track">
                                            <div class="mirror-progress-bar-fill" style="width: 30%"></div>
                                        </div>
                                        <div class="mirror-progress-pct">30% Complete</div>
                                    </div>
                                     <div class="d-flex gap-2">
                                         <a href="/users/courses/26" class="mirror-btn-navy flex-grow-1 text-truncate">
                                             <i class="bi bi-play-fill"></i> Continue
                                         </a>
                                         <a href="{{ route('ai.practice', ['course_id' => 26]) }}" class="mirror-btn-red flex-grow-1 text-truncate">
                                             <i class="bi bi-robot"></i> Start Quiz
                                         </a>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right stacked Statistics cards (col-lg-3) -->
        <div class="col-lg-3">
            <div class="mirror-stat-card">
                <div class="mirror-stat-icon-box mirror-stat-icon-blue">
                    <i class="bi bi-book-half"></i>
                </div>
                <div>
                    <div class="mirror-stat-label">Courses Enrolled</div>
                    <div class="mirror-stat-val">{{ $courses->count() }}</div>
                </div>
            </div>

            <div class="mirror-stat-card">
                <div class="mirror-stat-icon-box mirror-stat-icon-green">
                    <i class="bi bi-bar-chart-line-fill"></i>
                </div>
                <div>
                    <div class="mirror-stat-label">Overall Progress</div>
                    <div class="mirror-stat-val">{{ $overallProgress ?? 0 }}%</div>
                </div>
            </div>

            <div class="mirror-stat-card">
                <div class="mirror-stat-icon-box mirror-stat-icon-orange">
                    <i class="bi bi-robot"></i>
                </div>
                <div>
                    <div class="mirror-stat-label">AI Practice Sessions</div>
                    <div class="mirror-stat-val">{{ $aiAttemptsCount ?? 0 }}</div>
                </div>
            </div>

            <div class="mirror-stat-card">
                <div class="mirror-stat-icon-box mirror-stat-icon-blue">
                    <i class="bi bi-person-bounding-box"></i>
                </div>
                <div>
                    <div class="mirror-stat-label">Profile Completed</div>
                    <div class="mirror-stat-val">{{ $profileComplete ?? 0 }}%</div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- 5. BOTTOM FEATURES ROW -->
<div class="mirror-features-row" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
    <div class="mirror-feature-item">
        <div class="mirror-feature-icon"><i class="bi bi-people-fill"></i></div>
        <div class="mirror-feature-title">Expert Mentorship</div>
        <div class="mirror-feature-sub">Native & DELF Certified</div>
    </div>
    <div class="mirror-feature-item">
        <div class="mirror-feature-icon"><i class="bi bi-chat-quote-fill"></i></div>
        <div class="mirror-feature-title">Conversational Focus</div>
        <div class="mirror-feature-sub">Speak From Day One</div>
    </div>
    <div class="mirror-feature-item">
        <div class="mirror-feature-icon"><i class="bi bi-patch-check-fill"></i></div>
        <div class="mirror-feature-title">98% Success Rate</div>
        <div class="mirror-feature-sub">Proven DELF/DALF Results</div>
    </div>
    <div class="mirror-feature-item">
        <div class="mirror-feature-icon"><i class="bi bi-airplane-fill"></i></div>
        <div class="mirror-feature-title">Canada PR Boost</div>
        <div class="mirror-feature-sub">+50 Express Entry Points</div>
    </div>
    <div class="mirror-feature-item">
        <div class="mirror-feature-icon"><i class="bi bi-globe-americas"></i></div>
        <div class="mirror-feature-title">Global Validation</div>
        <div class="mirror-feature-sub">Govt. & Corporate Aligned</div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    $(document).ready(function() {
        AOS.init();
    });
</script>
@endpush