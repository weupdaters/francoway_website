@extends('layouts.master')

@php
// 1. Determine if we are rendering a dynamic database model or a mock course
$isDynamic = isset($course) && $course instanceof \App\Models\Course;

if ($isDynamic) {
    $courseTitle = $course->title;
    $courseDescription = $course->description;
    $courseShortDesc = strip_tags(Str::limit($course->description, 150));
    $coursePrice = '₹' . number_format($course->price, 2);
    $courseOldPrice = $course->price > 0 ? '₹' . number_format($course->price * 1.3, 2) : '';
    $courseDuration = '8 Weeks'; // default fallback since not in db
    $courseSessions = count($course->lessons) . ' Lessons';
    $courseEnrolled = '120+ Students';
    $courseLevel = 'French Module';
    
    // Map header image based on title
    $titleLower = strtolower($course->title);
    $mappedHeaderImg = 'hero_banner.png';
    $mappedBgImg = 'course_bg_a1.png';
    if (strpos($titleLower, 'a1') !== false) {
        $mappedHeaderImg = 'course_header_a1.png';
        $mappedBgImg = 'course_bg_a1.png';
        $courseLevel = 'Beginner';
    } elseif (strpos($titleLower, 'a2') !== false) {
        $mappedHeaderImg = 'course_header_a2.png';
        $mappedBgImg = 'course_bg_a2.png';
        $courseLevel = 'Elementary';
    } elseif (strpos($titleLower, 'b1') !== false) {
        $mappedHeaderImg = 'course_header_b1.png';
        $mappedBgImg = 'course_bg_b1.png';
        $courseLevel = 'Intermediate';
    } elseif (strpos($titleLower, 'b2') !== false) {
        $mappedHeaderImg = 'course_header_b2.png';
        $mappedBgImg = 'course_bg_b2.png';
        $courseLevel = 'Upper Intermediate';
    } elseif (strpos($titleLower, 'c1') !== false) {
        $mappedHeaderImg = 'course_header_c1.png';
        $mappedBgImg = 'course_bg_c1.png';
        $courseLevel = 'Advanced';
    } elseif (strpos($titleLower, 'delf') !== false || strpos($titleLower, 'dalf') !== false || strpos($titleLower, 'prep') !== false) {
        $mappedHeaderImg = 'course_bg_delf.png';
        $mappedBgImg = 'course_bg_delf.png';
        $courseLevel = 'Exam Prep';
    }
    
    $headerImg = $course->cover_image ? asset('storage/' . $course->cover_image) : asset('assets/images/' . $mappedHeaderImg);
    $courseCardBg = $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/images/' . $mappedBgImg);
    
    // Mock list of points for dynamic course overview
    $courseLearn = [
        'Complete comprehension of the language structure',
        'Interactive speaking practice with native resources',
        'Regular listening comprehension and dictation tasks',
        'Mock evaluations aligning with CEFR criteria',
        'Targeted vocabulary training for real-world scenarios'
    ];
    $courseIdeal = [
        'Students aiming to build official CEFR levels',
        'Immigrants moving to Canada seeking extra CRS points',
        'Language enthusiasts looking to establish conversational fluency'
    ];
    
    $courseSectionsCount = count($course->sections);
    $courseLessonsCount = count($course->lessons);
    
    $relatedCourses = \App\Models\Course::where('id', '!=', $course->id)->inRandomOrder()->limit(3)->get();
} else {
    // Mock data flow for static routes (e.g. /course/a1-beginner)
    $courses = [
        'a1-beginner' => [
            'title' => 'A1 – Beginner French Course',
            'level' => 'Beginner',
            'short_desc' => 'Start your French journey with basics of speaking, listening & more.',
            'bg_image' => 'course_bg_a1.png',
            'price' => '$99.00',
            'old_price' => '$149.00',
            'duration' => '8 Weeks',
            'lessons' => '24 Sessions',
            'enrolled' => '1200+ Students',
            'description' => 'Unlocks the power of the French language for absolute beginners. This course will provide you with the fundamental skills and vocabulary needed to introduce yourself, ask simple questions, and communicate basic needs in day-to-day scenarios.',
            'learn' => [
                'Basic French pronunciation & phonetic rules',
                'Greetings, introductions and personal details',
                'Numbers, dates, times and basic counting systems',
                'Essential grammar rules (present tense of être, avoir, aller, faire)',
                'Everyday vocabulary for shopping, family, food and travel'
            ],
            'ideal' => [
                'Absolute beginners with no prior knowledge of French',
                'Students planning to study or travel to French-speaking countries',
                'Professionals preparing for basic Canada PR requirements'
            ]
        ],
        'a2-elementary' => [
            'title' => 'A2 – Elementary French Course',
            'level' => 'Elementary',
            'short_desc' => 'Build your foundation & communicate in everyday situations.',
            'bg_image' => 'course_bg_a2.png',
            'price' => '$119.00',
            'old_price' => '$169.00',
            'duration' => '10 Weeks',
            'lessons' => '30 Sessions',
            'enrolled' => '950+ Students',
            'description' => 'Take your French to the next level. This level reinforces your grammar fundamentals and helps you describe your background, immediate environment, and matters in areas of immediate need with fluency and clarity.',
            'learn' => [
                'Expressing past events using Passé Composé and Imparfait',
                'Making plans, invitations, and expressing agreement or disagreement',
                'Describing your profession, hobbies, and educational background',
                'Expressing opinions, comparison, and giving advice',
                'Intermediate vocabulary for work, holidays, and urban living'
            ],
            'ideal' => [
                'Students who have completed A1 level French or equivalent',
                'Immigrants moving to Canada seeking basic French communication proficiency',
                'Language enthusiasts looking to establish conversational fluency'
            ]
        ],
        'b1-intermediate' => [
            'title' => 'B1 – Intermediate French Course',
            'level' => 'Intermediate',
            'short_desc' => 'Improve fluency & express yourself with confidence.',
            'bg_image' => 'course_bg_b1.png',
            'price' => '$149.00',
            'old_price' => '$199.00',
            'duration' => '12 Weeks',
            'lessons' => '36 Sessions',
            'enrolled' => '800+ Students',
            'description' => 'Transition from basic communication to active discussion. This course prepares you to handle most situations likely to arise while travelling in a French-speaking area, write simple connected texts, and describe experiences, dreams, hopes, and ambitions.',
            'learn' => [
                'Expressing doubts, possibilities, and hypotheses using Subjonctif and Conditionnel',
                'Conducting debates, expressing complex personal opinions on social issues',
                'Writing structured essays, professional letters and emails',
                'Understanding news, broadcasts, articles, and literary excerpts',
                'Enriching vocabulary with idioms and formal expressions'
            ],
            'ideal' => [
                'Students aiming to clear DELF B1 exam',
                'Professionals seeking mid-level French recognition for employment',
                'Academic students planning to enroll in bilingual universities'
            ]
        ],
        'b2-upper-intermediate' => [
            'title' => 'B2 – Upper Intermediate French Course',
            'level' => 'Upper Intermediate',
            'short_desc' => 'Advanced communication skills for academic & professional growth.',
            'bg_image' => 'course_bg_b2.png',
            'price' => '$179.00',
            'old_price' => '$249.00',
            'duration' => '12 Weeks',
            'lessons' => '40 Sessions',
            'enrolled' => '650+ Students',
            'description' => 'Achieve full degree of independence. You will be able to understand the main ideas of complex text, interact with a degree of fluency and spontaneity with native speakers, and produce clear, detailed text on a wide range of subjects.',
            'learn' => [
                'Mastering advanced grammar constructs (gerunds, passive voice, double pronouns)',
                'Interacting spontaneously in debates, negotiations, and interviews',
                'Analyzing detailed articles, reports, and arguments',
                'Developing accent, tone, and slang variations used by native speakers',
                'Synthesizing oral and written information into cohesive arguments'
            ],
            'ideal' => [
                'Candidates preparing for DELF B2 (critical for Canada PR CRS points)',
                'Students seeking study-abroad options in pure French courses',
                'Professionals aiming for high-responsibility bilingual positions'
            ]
        ],
        'c1-advanced' => [
            'title' => 'C1 – Advanced French Course',
            'level' => 'Advanced',
            'short_desc' => 'Achieve advanced fluency for career, studies & international exams.',
            'bg_image' => 'course_bg_c1.png',
            'price' => '$229.00',
            'old_price' => '$299.00',
            'duration' => '14 Weeks',
            'lessons' => '45 Sessions',
            'enrolled' => '450+ Students',
            'description' => 'Command the language at an academic level. This course guides you to understand a wide range of demanding, longer texts, express ideas fluently and spontaneously, and use language flexibly and effectively for social, academic, and professional purposes.',
            'learn' => [
                'Understanding implicit meanings in complex text and literary works',
                'Presenting clear, detailed, and well-structured arguments on complex subjects',
                'Adapting speech style seamlessly across social, academic, and work settings',
                'Writing complex essays, thesis, reports, and reviews with advanced style',
                'Refining nuance, rhetoric, and cultural context'
            ],
            'ideal' => [
                'Experienced French speakers aiming for DALF C1 certificate',
                'Bilingual translators, translators-to-be, and language teachers',
                'Scholars aiming for doctorate research in francophone countries'
            ]
        ],
        'delf-dalf-preparation' => [
            'title' => 'DELF / DALF Exam Preparation Course',
            'level' => 'Exam Prep',
            'short_desc' => 'Complete preparation for all DELF & DALF exam levels.',
            'bg_image' => 'course_bg_delf.png',
            'price' => '$249.00',
            'old_price' => '$329.00',
            'duration' => '6 Weeks',
            'lessons' => '18 Sessions',
            'enrolled' => '1500+ Students',
            'description' => 'Targeted preparation designed exclusively for exam success. Under the guidance of our expert trainers, you will drill past papers, master time-management strategies, and refine key skills across Reading, Writing, Listening, and Speaking modules.',
            'learn' => [
                'Understanding complete exam structure, grading criteria and evaluation grids',
                'Practicing with real mock exams under timed, official conditions',
                'Developing custom writing templates for maximum points in Production Écrite',
                'Enhancing speaking confidence and vocabulary for Production Orale',
                'Key audio cues for Compréhension de l\'Oral and key reading tactics'
            ],
            'ideal' => [
                'Candidates who have already studied the syllabus and are preparing for final exam',
                'Canada PR aspirants looking to maximize points via TEF/TCF/DELF',
                'Students seeking quick, focused correction and mock evaluations'
            ]
        ]
    ];
    
    $courseId = $courseId ?? 'a1-beginner';
    $mockCourse = $courses[$courseId] ?? $courses['a1-beginner'];
    
    $courseTitle = $mockCourse['title'];
    $courseDescription = $mockCourse['description'];
    $courseShortDesc = $mockCourse['short_desc'];
    $coursePrice = $mockCourse['price'];
    $courseOldPrice = $mockCourse['old_price'];
    $courseDuration = $mockCourse['duration'];
    $courseSessions = $mockCourse['lessons'];
    $courseEnrolled = $mockCourse['enrolled'];
    $courseLevel = $mockCourse['level'];
    $courseLearn = $mockCourse['learn'];
    $courseIdeal = $mockCourse['ideal'];
    $courseSectionsCount = 4;
    $courseLessonsCount = 16;
    
    $headerImages = [
        'a1-beginner' => 'course_header_a1.png',
        'a2-elementary' => 'course_header_a2.png',
        'b1-intermediate' => 'course_header_b1.png',
        'b2-upper-intermediate' => 'course_header_b2.png',
        'c1-advanced' => 'course_header_c1.png',
        'delf-dalf-preparation' => 'course_bg_delf.png',
    ];
    $headerImg = asset('assets/images/' . ($headerImages[$courseId] ?? 'hero_banner.png'));
    $courseCardBg = asset('assets/images/' . ($mockCourse['bg_image'] ?? 'course_bg_a1.png'));
    
    $relatedIds = array_diff(array_keys($courses), [$courseId]);
    shuffle($relatedIds);
    $relatedIds = array_slice($relatedIds, 0, 3);
    
    $relatedCourses = [];
    foreach ($relatedIds as $relId) {
        $rel = $courses[$relId];
        $relatedCourses[] = (object) [
            'id' => $relId,
            'is_mock' => true,
            'title' => $rel['title'],
            'level' => $rel['level'],
            'short_desc' => $rel['short_desc'],
            'bg_image' => $rel['bg_image'],
            'price' => $rel['price'],
            'thumbnail' => null
        ];
    }
}
@endphp

@section('title', $courseTitle . ' - Francoway')
@section('description', $courseShortDesc)

@section('content')
    <!-- Course Detail Top Banner (Matching dark aesthetic with breadcrumbs) -->
    <section class="relative bg-[#0B1E43] text-white pt-24 pb-28 md:pt-28 md:pb-36 overflow-hidden">
        <!-- Background Image for Course -->
        <div class="absolute inset-0 z-0 select-none pointer-events-none opacity-20">
            <img src="{{ $headerImg }}" class="w-full h-full object-cover object-center" alt="Course Banner">
        </div>
        <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top_right,rgba(227,27,37,0.12),transparent_50%)]"></div>
        <div class="absolute inset-0 z-0 bg-[linear-gradient(135deg,#0B1E43_20%,#071530_100%)] opacity-95"></div>
        
        <div class="max-w-7xl mx-auto px-4 md:px-6 relative z-10 text-center">
            <!-- Breadcrumbs -->
            <nav class="text-white/60 text-[10px] md:text-xs font-heading font-black tracking-widest uppercase mb-4 flex items-center justify-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-[#E31B23] transition-colors">Home</a>
                <span>/</span>
                <span class="hover:text-white transition-colors">Courses</span>
                <span>/</span>
                <span class="text-white font-bold">{{ $courseLevel }}</span>
            </nav>
            
            <!-- Main Title -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-black tracking-tight leading-tight max-w-4xl mx-auto">
                {{ $courseTitle }}
            </h1>
        </div>
    </section>

    <!-- Main Detail Section (Curved white content area shifting up) -->
    <section class="relative z-20 -mt-16 md:-mt-24 pb-16 md:pb-24">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="bg-white rounded-[2.5rem] p-6 md:p-12 shadow-[0_15px_45px_rgba(8,29,71,0.04)] border border-gray-100">
                
                <!-- Instructor Banner (Avatar, Category, Rating) -->
                <div class="flex flex-col sm:flex-row gap-6 items-center justify-between pb-8 border-b border-gray-100 mb-10">
                    <div class="flex flex-wrap items-center gap-6 md:gap-8 justify-center sm:justify-start">
                        <!-- Instructor Avatar -->
                        <div class="flex items-center gap-3.5">
                            <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-[#E31B23] bg-gray-50 flex items-center justify-center font-heading font-black text-base text-[#0B1E43]">
                                ER
                            </div>
                            <div>
                                <span class="text-[11px] md:text-xs uppercase font-heading font-black tracking-wider text-gray-400 block">Instructor</span>
                                <h4 class="text-base font-extrabold text-[#0B1E43]">Elisa Roy</h4>
                            </div>
                        </div>
                        
                        <!-- Category Info -->
                        <div class="h-10 w-px bg-gray-200 hidden md:block"></div>
                        <div>
                            <span class="text-[11px] md:text-xs uppercase font-heading font-black tracking-wider text-gray-400 block">Category</span>
                            <h4 class="text-base font-extrabold text-[#0B1E43]">French Language</h4>
                        </div>
                        
                        <!-- Reviews -->
                        <div class="h-10 w-px bg-gray-200 hidden md:block"></div>
                        <div>
                            <span class="text-[11px] md:text-xs uppercase font-heading font-black tracking-wider text-gray-400 block">Review</span>
                            <div class="flex items-center gap-1.5">
                                <div class="flex text-[#F8B803] scale-100 origin-left">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                </div>
                                <span class="text-xs md:text-sm font-bold text-gray-500">(5.0 Rating)</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Share Options -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs md:text-sm font-bold text-gray-400 font-heading tracking-wider uppercase mr-1">Share:</span>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-100 hover:border-blue-600 hover:bg-blue-50 text-gray-500 hover:text-blue-600 transition-colors flex items-center justify-center">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-100 hover:border-sky-500 hover:bg-sky-50 text-gray-500 hover:text-sky-500 transition-colors flex items-center justify-center">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Main Layout Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Columns: Description & Details -->
                    <div class="lg:col-span-8 space-y-8">
                        <!-- Navigation Tabs (Preview Style) -->
                        <div class="flex flex-wrap gap-2.5 pb-2 border-b border-gray-100" id="tab-headers">
                            <button onclick="switchTab(event, 'overview')" class="tab-btn px-6 py-3 rounded-full text-sm font-black font-heading bg-[#0B1E43] text-white transition-all shadow-sm">Overview</button>
                            <button onclick="switchTab(event, 'curriculum')" class="tab-btn px-6 py-3 rounded-full text-sm font-black font-heading text-gray-500 hover:bg-gray-50 hover:text-[#0B1E43] transition-all">Curriculum</button>
                            <button onclick="switchTab(event, 'instructor')" class="tab-btn px-6 py-3 rounded-full text-sm font-black font-heading text-gray-500 hover:bg-gray-50 hover:text-[#0B1E43] transition-all">Instructor</button>
                            <button onclick="switchTab(event, 'faqs')" class="tab-btn px-6 py-3 rounded-full text-sm font-black font-heading text-gray-500 hover:bg-gray-50 hover:text-[#0B1E43] transition-all">FAQs</button>
                            <button onclick="switchTab(event, 'reviews')" class="tab-btn px-6 py-3 rounded-full text-sm font-black font-heading text-gray-500 hover:bg-gray-50 hover:text-[#0B1E43] transition-all">Reviews</button>
                        </div>
                        
                        <!-- TAB PANES CONTAINER -->
                        <div class="space-y-8">
                            
                            <!-- 1. OVERVIEW TAB PANE -->
                            <div id="tab-pane-overview" class="tab-pane space-y-8">
                                <div class="space-y-4">
                                    <h3 class="text-2xl md:text-3xl font-heading font-black text-[#0B1E43]">Course Description</h3>
                                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                        {{ $courseDescription }}
                                    </p>
                                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                        Whether you are starting completely fresh or looking to brush up on past language classes, our structured approach ensures high-quality retention and fast speaking proficiency.
                                    </p>
                                </div>
                                
                                <div class="bg-[#FAF9F5]/40 border border-gray-100 p-8 md:p-10 rounded-3xl space-y-5">
                                    <h3 class="text-xl md:text-2xl font-heading font-black text-[#0B1E43]">What You Will Learn</h3>
                                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-base text-gray-600">
                                        @foreach($courseLearn as $item)
                                            <li class="flex items-start gap-3">
                                                <svg class="w-5 h-5 text-[#E31B23] shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="space-y-4">
                                    <h3 class="text-xl md:text-2xl font-heading font-black text-[#0B1E43]">Certification</h3>
                                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                        Upon successful completion of this course modules, you will receive a **Francoway Course Completion Certificate**. This credentials validates your listening, writing, reading, and speaking skills at the {{ $courseLevel }} level of the Common European Framework of Reference for Languages (CEFR).
                                    </p>
                                </div>
                                
                                <div class="space-y-4">
                                    <h3 class="text-xl md:text-2xl font-heading font-black text-[#0B1E43]">Ideal For</h3>
                                    <ul class="space-y-3 text-base text-gray-600">
                                        @foreach($courseIdeal as $ideal)
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-[#E31B23] mt-2.5 shrink-0"></span>
                                                <span>{{ $ideal }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- 2. CURRICULUM TAB PANE -->
                            <div id="tab-pane-curriculum" class="tab-pane space-y-6 hidden">
                                <div class="flex items-center justify-between text-xs md:text-sm font-heading font-black tracking-widest text-[#0B1E43]/60 uppercase pb-2 border-b border-gray-100">
                                    <span>{{ $courseSectionsCount }} Sections • {{ $courseLessonsCount }} Lessons • {{ $courseDuration }}</span>
                                    <button onclick="toggleAllCurriculum()" class="text-[#E31B23] hover:underline normal-case">Expand All Sections</button>
                                </div>
                                
                                <div class="space-y-4">
                                    @if ($isDynamic && count($course->sections) > 0)
                                        @foreach($course->sections as $sIdx => $section)
                                            <!-- Dynamic Section -->
                                            <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                                <button onclick="toggleAccordion('curr-{{ $section->id }}')" class="w-full flex items-center justify-between p-6 bg-[#FAF9F5]/30 hover:bg-[#FAF9F5]/50 transition-colors text-left focus:outline-none">
                                                    <div class="flex items-center gap-4">
                                                        <span class="w-8 h-8 rounded-full bg-[#0B1E43]/5 text-[#0B1E43] flex items-center justify-center text-sm font-black">{{ $sIdx + 1 }}</span>
                                                        <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">{{ $section->title }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        <span class="text-xs font-black text-gray-400 uppercase tracking-wider bg-gray-100 px-3 py-1 rounded">{{ count($section->lessons) }} Lessons</span>
                                                        <svg id="arrow-curr-{{ $section->id }}" class="w-5 h-5 text-gray-400 transition-transform transform {{ $sIdx === 0 ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </button>
                                                <div id="content-curr-{{ $section->id }}" class="p-6 border-t border-gray-50 space-y-4 {{ $sIdx === 0 ? '' : 'hidden' }}">
                                                    @forelse($section->lessons as $lIdx => $lesson)
                                                        <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                            <span class="flex items-center gap-2.5">
                                                                📄 {{ $sIdx + 1 }}.{{ $lIdx + 1 }} {{ $lesson->title }}
                                                            </span>
                                                            @if ($lIdx === 0 && $sIdx === 0)
                                                                <span class="text-[#E31B23] font-bold text-xs uppercase tracking-wider">Preview</span>
                                                            @else
                                                                <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                            @endif
                                                        </div>
                                                    @empty
                                                        <p class="text-xs text-gray-450 italic">No lessons in this section yet.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- Static Fallback Accordion -->
                                        <!-- Section 1 -->
                                        <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                            <button onclick="toggleAccordion('curr-1')" class="w-full flex items-center justify-between p-6 bg-[#FAF9F5]/30 hover:bg-[#FAF9F5]/50 transition-colors text-left focus:outline-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="w-8 h-8 rounded-full bg-[#0B1E43]/5 text-[#0B1E43] flex items-center justify-center text-sm font-black">1</span>
                                                    <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">Introduction & Orientation</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <span class="text-xs font-black text-gray-400 uppercase tracking-wider bg-gray-100 px-3 py-1 rounded">4 Lessons</span>
                                                    <svg id="arrow-curr-1" class="w-5 h-5 text-gray-400 transition-transform transform rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </button>
                                            <div id="content-curr-1" class="p-6 border-t border-gray-50 space-y-4">
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 1.1 Course Orientation & French Alphabets
                                                    </span>
                                                    <span class="text-[#E31B23] font-bold text-xs uppercase tracking-wider">Preview</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 1.2 Phonetics & Vowel Pronunciations
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 1.3 Personal Greetings & Basic Vocabulary
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 1.4 Level Evaluation Mock
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section 2 -->
                                        <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                            <button onclick="toggleAccordion('curr-2')" class="w-full flex items-center justify-between p-6 bg-[#FAF9F5]/30 hover:bg-[#FAF9F5]/50 transition-colors text-left focus:outline-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="w-8 h-8 rounded-full bg-[#0B1E43]/5 text-[#0B1E43] flex items-center justify-center text-sm font-black">2</span>
                                                    <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">Key Grammar & Syntax</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <span class="text-xs font-black text-gray-400 uppercase tracking-wider bg-gray-100 px-3 py-1 rounded">4 Lessons</span>
                                                    <svg id="arrow-curr-2" class="w-5 h-5 text-gray-400 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </button>
                                            <div id="content-curr-2" class="p-6 border-t border-gray-50 space-y-4 hidden">
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 2.1 Essential Verbs & Conjugation
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 2.2 Articles, Pronouns & Gender agreement
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 2.3 Sentence construction rules
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 2.4 Intermediate grammar drills
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section 3 -->
                                        <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                            <button onclick="toggleAccordion('curr-3')" class="w-full flex items-center justify-between p-6 bg-[#FAF9F5]/30 hover:bg-[#FAF9F5]/50 transition-colors text-left focus:outline-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="w-8 h-8 rounded-full bg-[#0B1E43]/5 text-[#0B1E43] flex items-center justify-center text-sm font-black">3</span>
                                                    <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">Conversational Practice</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <span class="text-xs font-black text-gray-400 uppercase tracking-wider bg-gray-100 px-3 py-1 rounded">4 Lessons</span>
                                                    <svg id="arrow-curr-3" class="w-5 h-5 text-gray-400 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </button>
                                            <div id="content-curr-3" class="p-6 border-t border-gray-50 space-y-4 hidden">
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 3.1 Speaking roleplays (shopping, travel)
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 3.2 Reading comprehension exercises
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 3.3 Audio listening transcription drills
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 3.4 Group speaking feedback sessions
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section 4 -->
                                        <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                            <button onclick="toggleAccordion('curr-4')" class="w-full flex items-center justify-between p-6 bg-[#FAF9F5]/30 hover:bg-[#FAF9F5]/50 transition-colors text-left focus:outline-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="w-8 h-8 rounded-full bg-[#0B1E43]/5 text-[#0B1E43] flex items-center justify-center text-sm font-black">4</span>
                                                    <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">Exam Tactics & Final Mocks</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <span class="text-xs font-black text-gray-400 uppercase tracking-wider bg-gray-100 px-3 py-1 rounded">4 Lessons</span>
                                                    <svg id="arrow-curr-4" class="w-5 h-5 text-gray-400 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </button>
                                            <div id="content-curr-4" class="p-6 border-t border-gray-50 space-y-4 hidden">
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 4.1 Exam outline & evaluation grid structure
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 4.2 Production Écrite templates
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 4.3 Production Orale confidence mock
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                                    <span class="flex items-center gap-2.5">
                                                        📄 4.4 Final certificate assessment
                                                    </span>
                                                    <span class="text-gray-400 text-xs font-semibold">🔒 Locked</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- 3. INSTRUCTOR TAB PANE -->
                            <div id="tab-pane-instructor" class="tab-pane space-y-6 hidden">
                                <div class="bg-[#FAF9F5]/40 border border-gray-100 rounded-3xl p-8 md:p-10 flex flex-col md:flex-row gap-8 items-start">
                                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-full overflow-hidden border-4 border-white shadow-md bg-gray-50 flex items-center justify-center font-heading font-black text-3xl text-[#0B1E43] shrink-0">
                                        ER
                                    </div>
                                    <div class="space-y-4 flex-grow">
                                        <div>
                                            <h3 class="text-2xl font-heading font-black text-[#0B1E43]">Elisa Roy</h3>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest font-heading">226 Students • 8 Courses</span>
                                        </div>
                                        
                                        <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                            As an instructor, I am fervently dedicated to shaping the linguistic and literary acumen of my students. With a profound passion for language education, I strive to make learning French immersive, simple, and exciting.
                                        </p>
                                        
                                        <div class="flex gap-3.5">
                                            <a href="#" class="w-10 h-10 rounded-full border border-gray-150 hover:bg-[#FAF9F5] flex items-center justify-center text-gray-450 hover:text-[#0B1E43] transition-all">
                                                <span class="text-xs font-black">FB</span>
                                            </a>
                                            <a href="#" class="w-10 h-10 rounded-full border border-gray-150 hover:bg-[#FAF9F5] flex items-center justify-center text-gray-450 hover:text-[#0B1E43] transition-all">
                                                <span class="text-xs font-black">X</span>
                                            </a>
                                            <a href="#" class="w-10 h-10 rounded-full border border-gray-150 hover:bg-[#FAF9F5] flex items-center justify-center text-gray-450 hover:text-[#0B1E43] transition-all">
                                                <span class="text-xs font-black">LN</span>
                                            </a>
                                            <a href="#" class="w-10 h-10 rounded-full border border-gray-150 hover:bg-[#FAF9F5] flex items-center justify-center text-gray-450 hover:text-[#0B1E43] transition-all">
                                                <span class="text-xs font-black">YT</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 4. FAQS TAB PANE -->
                            <div id="tab-pane-faqs" class="tab-pane space-y-4 hidden">
                                <!-- FAQ 1 -->
                                <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                    <button onclick="toggleAccordion('faq-1')" class="w-full flex items-center justify-between p-6 bg-white hover:bg-gray-50 transition-colors text-left focus:outline-none">
                                        <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">How long is the course?</span>
                                        <svg id="arrow-faq-1" class="w-5 h-5 text-gray-400 transition-transform transform rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="content-faq-1" class="p-6 border-t border-gray-50 text-sm md:text-base text-gray-600 leading-relaxed">
                                        The course duration is {{ $courseDuration }}, consisting of {{ $courseSessions }} live interactive sessions. Recorded lessons are also made available on the dashboard.
                                    </div>
                                </div>

                                <!-- FAQ 2 -->
                                <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                    <button onclick="toggleAccordion('faq-2')" class="w-full flex items-center justify-between p-6 bg-white hover:bg-gray-50 transition-colors text-left focus:outline-none">
                                        <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">Will I receive a certificate upon completion?</span>
                                        <svg id="arrow-faq-2" class="w-5 h-5 text-gray-400 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="content-faq-2" class="p-6 border-t border-gray-50 text-sm md:text-base text-gray-600 leading-relaxed hidden">
                                        Yes! Upon successfully clearing the final evaluation mock check at the end of the modules, a digital Francoway CEFR-aligned Course Completion Certificate will be sent to you.
                                    </div>
                                </div>

                                <!-- FAQ 3 -->
                                <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                    <button onclick="toggleAccordion('faq-3')" class="w-full flex items-center justify-between p-6 bg-white hover:bg-gray-50 transition-colors text-left focus:outline-none">
                                        <span class="font-heading font-black text-base md:text-lg text-[#0B1E43]">What if I have questions during the course?</span>
                                        <svg id="arrow-faq-3" class="w-5 h-5 text-gray-400 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="content-faq-3" class="p-6 border-t border-gray-50 text-sm md:text-base text-gray-600 leading-relaxed hidden">
                                        You can reach out to Elisa Roy directly via our dedicated student support forum, email, or ask questions during the weekly live interactive Q&A sessions.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 5. REVIEWS TAB PANE -->
                            <div id="tab-pane-reviews" class="tab-pane space-y-6 hidden">
                                <div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10 flex flex-col md:flex-row gap-8 md:gap-16 items-center">
                                    <!-- Overall Score Card -->
                                    <div class="bg-[#FAF9F5]/40 border border-gray-100 rounded-2xl p-8 text-center w-full md:w-52 shrink-0 shadow-sm">
                                        <h3 class="text-5xl md:text-6xl font-heading font-black text-[#0B1E43] mb-2">5.0</h3>
                                        <div class="flex text-[#F8B803] justify-center mb-2 scale-110">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        </div>
                                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest block">5 Reviews</span>
                                    </div>
                                    
                                    <!-- Star Bars distribution -->
                                    <div class="w-full space-y-4">
                                        <!-- 5 star -->
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="w-16 text-gray-400 font-bold">5 Stars</span>
                                            <div class="flex-grow h-3 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-[#F8B803] rounded-full w-full"></div>
                                            </div>
                                            <span class="w-4 text-right text-gray-550 font-bold">5</span>
                                        </div>
                                        <!-- 4 star -->
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="w-16 text-gray-400 font-bold">4 Stars</span>
                                            <div class="flex-grow h-3 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-[#F8B803] rounded-full w-0"></div>
                                            </div>
                                            <span class="w-4 text-right text-gray-550 font-bold">0</span>
                                        </div>
                                        <!-- 3 star -->
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="w-16 text-gray-400 font-bold">3 Stars</span>
                                            <div class="flex-grow h-3 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-[#F8B803] rounded-full w-0"></div>
                                            </div>
                                            <span class="w-4 text-right text-gray-550 font-bold">0</span>
                                        </div>
                                        <!-- 2 star -->
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="w-16 text-gray-400 font-bold">2 Stars</span>
                                            <div class="flex-grow h-3 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-[#F8B803] rounded-full w-0"></div>
                                            </div>
                                            <span class="w-4 text-right text-gray-550 font-bold">0</span>
                                        </div>
                                        <!-- 1 star -->
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="w-16 text-gray-400 font-bold">1 Star</span>
                                            <div class="flex-grow h-3 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-[#F8B803] rounded-full w-0"></div>
                                            </div>
                                            <span class="w-4 text-right text-gray-550 font-bold">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Leave a Reply Form -->
                        <div class="pt-8 border-t border-gray-100 space-y-6">
                            <h3 class="text-lg md:text-xl font-heading font-black text-[#0B1E43]">Leave a Reply</h3>
                            <p class="text-xs text-gray-400">Your email address will not be published. Required fields are marked *</p>
                            
                            <form action="#" class="space-y-4" onsubmit="event.preventDefault(); alert('Merci! Your comment has been submitted and is pending approval.'); this.reset();">
                                <div>
                                    <label class="text-xs font-bold text-gray-500 font-heading uppercase block mb-1">Comment *</label>
                                    <textarea rows="5" required class="w-full bg-gray-50 border border-gray-100 focus:border-[#0B1E43] focus:bg-white rounded-2xl p-4 text-sm transition-all focus:outline-none placeholder-gray-300" placeholder="Write your thoughts..."></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 font-heading uppercase block mb-1">Name *</label>
                                        <input type="text" required class="w-full bg-gray-50 border border-gray-100 focus:border-[#0B1E43] focus:bg-white rounded-xl p-3.5 text-sm transition-all focus:outline-none placeholder-gray-300" placeholder="Your name">
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 font-heading uppercase block mb-1">Email *</label>
                                        <input type="email" required class="w-full bg-gray-50 border border-gray-100 focus:border-[#0B1E43] focus:bg-white rounded-xl p-3.5 text-sm transition-all focus:outline-none placeholder-gray-300" placeholder="Your email">
                                    </div>
                                </div>
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-3.5 bg-[#0B1E43] hover:bg-blue-900 text-white font-extrabold text-xs uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Right Column: Sticky Sidebar Card -->
                    <div class="lg:col-span-4 lg:sticky lg:top-28 space-y-6">
                        <div class="bg-white border border-gray-100 rounded-3xl p-5 shadow-lg shadow-blue-900/5 overflow-hidden">
                            <!-- Preview Thumbnail -->
                            <div class="relative aspect-video rounded-2xl overflow-hidden bg-gray-100 mb-6">
                                <img src="{{ $courseCardBg }}" alt="{{ $courseTitle }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-[#0B1E43]/20 flex items-center justify-center">
                                    <button class="w-12 h-12 bg-white text-[#E31B23] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-300" onclick="alert('Playing Course Preview Video...');">
                                        <svg class="w-5 h-5 fill-current ml-0.5" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Price Block -->
                            <div class="flex items-baseline gap-3 mb-6">
                                <span class="text-4xl font-heading font-black text-[#E31B23]">{{ $coursePrice }}</span>
                                @if($courseOldPrice)
                                    <span class="text-base text-gray-400 line-through font-bold">{{ $courseOldPrice }}</span>
                                @endif
                            </div>
                            
                            <!-- Course Stats Checklist -->
                            <h4 class="text-sm font-bold text-gray-400 font-heading tracking-wider uppercase mb-3 border-b border-gray-100 pb-2">Course Includes:</h4>
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                    <span class="flex items-center gap-2 font-medium">
                                        👩‍🏫 Instructor:
                                    </span>
                                    <span class="font-bold text-[#0B1E43]">Elisa Roy</span>
                                </div>
                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                    <span class="flex items-center gap-2 font-medium">
                                        ⏱ Duration:
                                    </span>
                                    <span class="font-bold text-[#0B1E43]">{{ $courseDuration }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                    <span class="flex items-center gap-2 font-medium">
                                        📚 Sessions:
                                    </span>
                                    <span class="font-bold text-[#0B1E43]">{{ $courseSessions }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm md:text-base text-gray-600">
                                    <span class="flex items-center gap-2 font-medium">
                                        👥 Enrolled:
                                    </span>
                                    <span class="font-bold text-[#0B1E43]">{{ $courseEnrolled }}</span>
                                </div>
                            </div>
                            
                            @php
                                $checkoutUrl = $isDynamic && !isset($course->is_mock) 
                                    ? route('users.checkout', $course->id) 
                                    : route('users.checkout', 1);
                            @endphp
                            <a href="{{ $checkoutUrl }}" class="w-full text-center inline-block py-4 bg-[#0B1E43] hover:bg-blue-900 text-white font-black text-sm uppercase tracking-widest rounded-2xl transition-all duration-300 shadow-md mb-3 btn-pulse-blue">
                                Buy Now
                            </a>
                            <a href="{{ url('/#enquire') }}" class="w-full text-center inline-block py-3.5 bg-transparent border-2 border-[#E31B23] text-[#E31B23] hover:bg-[#E31B23] hover:text-white font-black text-sm uppercase tracking-widest rounded-2xl transition-all duration-300">
                                Book Free Demo
                            </a>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>

    <!-- Related Courses Section -->
    <section class="py-16 bg-[#F8FAFC]/40 relative border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <h2 class="text-xl md:text-2xl font-heading font-black text-[#0B1E43] mb-8 text-center uppercase tracking-wider">
                Related <span class="text-[#E31B23]">Courses</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedCourses as $rel)
                    @php
                        $relUrl = $isDynamic && !isset($rel->is_mock) ? route('courses.show', $rel->id) : url('/course/' . $rel->id);
                        
                        $bgImage = 'assets/images/course_bg_a1.png';
                        $textColor = '#E31B23';
                        $btnBg = 'bg-[#E31B23]';
                        $btnHover = 'hover:bg-red-700';
                        
                        $titleLower = strtolower($rel->title);
                        if (strpos($titleLower, 'a1') !== false) {
                            $bgImage = 'assets/images/course_bg_a1.png';
                            $textColor = '#E31B23';
                            $btnBg = 'bg-[#E31B23]';
                            $btnHover = 'hover:bg-red-700';
                        } elseif (strpos($titleLower, 'a2') !== false) {
                            $bgImage = 'assets/images/course_bg_a2.png';
                            $textColor = '#0B1E43';
                            $btnBg = 'bg-[#0B1E43]';
                            $btnHover = 'hover:bg-blue-900';
                        } elseif (strpos($titleLower, 'b1') !== false) {
                            $bgImage = 'assets/images/course_bg_b1.png';
                            $textColor = '#E31B23';
                            $btnBg = 'bg-[#E31B23]';
                            $btnHover = 'hover:bg-red-700';
                        } elseif (strpos($titleLower, 'b2') !== false) {
                            $bgImage = 'assets/images/course_bg_b2.png';
                            $textColor = '#0B1E43';
                            $btnBg = 'bg-[#0B1E43]';
                            $btnHover = 'hover:bg-blue-900';
                        } elseif (strpos($titleLower, 'c1') !== false) {
                            $bgImage = 'assets/images/course_bg_c1.png';
                            $textColor = '#E31B23';
                            $btnBg = 'bg-[#E31B23]';
                            $btnHover = 'hover:bg-red-700';
                        } elseif (strpos($titleLower, 'delf') !== false || strpos($titleLower, 'dalf') !== false || strpos($titleLower, 'prep') !== false) {
                            $bgImage = 'assets/images/course_bg_delf.png';
                            $textColor = '#0B1E43';
                            $btnBg = 'bg-[#0B1E43]';
                            $btnHover = 'hover:bg-blue-900';
                        } else {
                            $idx = $loop->index % 6;
                            $images = [
                                'assets/images/course_bg_a1.png',
                                'assets/images/course_bg_a2.png',
                                'assets/images/course_bg_b1.png',
                                'assets/images/course_bg_b2.png',
                                'assets/images/course_bg_c1.png',
                                'assets/images/course_bg_delf.png'
                            ];
                            $bgImage = $images[$idx];
                            $textColor = ($idx % 2 === 0) ? '#E31B23' : '#0B1E43';
                            $btnBg = ($idx % 2 === 0) ? 'bg-[#E31B23]' : 'bg-[#0B1E43]';
                            $btnHover = ($idx % 2 === 0) ? 'hover:bg-red-700' : 'hover:bg-blue-900';
                        }
                        
                        $relTitle = $rel->title;
                        $relDesc = $isDynamic && !isset($rel->is_mock) ? strip_tags($rel->description) : $rel->short_desc;
                    @endphp
                    
                    <!-- Dynamic Course Card (Matching homepage) -->
                    <div class="bg-white rounded-3xl border border-gray-100 hover:shadow-[0_12px_35px_rgba(8,29,71,0.06)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col justify-between p-6 md:p-8 min-h-[220px] group">
                        <div class="absolute inset-0 z-0 select-none pointer-events-none">
                            <img src="{{ asset($bgImage) }}" class="w-full h-full object-cover object-right group-hover:scale-105 transition-transform duration-700 ease-out">
                        </div>
                        <div class="relative z-10 max-w-[65%] flex flex-col justify-between h-full space-y-4">
                            <div>
                                <span class="text-sm md:text-base font-black tracking-wider uppercase block mb-1" style="color: {{ $textColor }};">
                                    {{ $relTitle }}
                                </span>
                                <p class="text-[13px] md:text-sm text-gray-555 font-medium leading-relaxed line-clamp-3">
                                    {{ $relDesc }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ $relUrl }}" class="inline-flex items-center justify-center gap-1 px-4 py-2 {{ $btnBg }} text-white text-[11px] font-bold uppercase rounded-lg {{ $btnHover }} transition-colors duration-300">
                                    Learn More
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@push('js')
<script>
    // Tab switching logic
    function switchTab(event, tabId) {
        // Remove active styling from all tab buttons
        const tabButtons = document.querySelectorAll('.tab-btn');
        tabButtons.forEach(btn => {
            btn.classList.remove('bg-[#0B1E43]', 'text-white', 'shadow-sm');
            btn.classList.add('text-gray-500', 'hover:bg-gray-50', 'hover:text-[#0B1E43]');
        });

        // Add active styling to clicked button
        const clickedBtn = event.currentTarget;
        clickedBtn.classList.remove('text-gray-500', 'hover:bg-gray-50', 'hover:text-[#0B1E43]');
        clickedBtn.classList.add('bg-[#0B1E43]', 'text-white', 'shadow-sm');

        // Hide all tab panes
        const tabPanes = document.querySelectorAll('.tab-pane');
        tabPanes.forEach(pane => {
            pane.classList.add('hidden');
        });

        // Show target tab pane
        const targetPane = document.getElementById('tab-pane-' + tabId);
        if (targetPane) {
            targetPane.classList.remove('hidden');
        }
    }

    // Accordion toggler logic
    function toggleAccordion(id) {
        const content = document.getElementById('content-' + id);
        const arrow = document.getElementById('arrow-' + id);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            if (arrow) arrow.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            if (arrow) arrow.classList.remove('rotate-180');
        }
    }

    // Expand/Collapse all curriculum sections
    let allExpanded = false;
    function toggleAllCurriculum() {
        allExpanded = !allExpanded;
        const sections = ['curr-1', 'curr-2', 'curr-3', 'curr-4'];
        
        sections.forEach(id => {
            const content = document.getElementById('content-' + id);
            const arrow = document.getElementById('arrow-' + id);
            
            if (allExpanded) {
                content.classList.remove('hidden');
                if (arrow) arrow.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                if (arrow) arrow.classList.remove('rotate-180');
            }
        });
        
        const btn = event.currentTarget;
        btn.innerText = allExpanded ? "Collapse All Sections" : "Expand All Sections";
    }
</script>
@endpush
@endsection
