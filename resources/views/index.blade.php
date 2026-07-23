@extends('layouts.master')

@section('title', 'Francoway - Success in French. Success in Canada.')

@push('css')
<style>
    /* Reset body and inputs to modern sans-serif font */
    body, input, select, textarea, button, p, span, li, a {
        font-family: 'Inter', sans-serif;
    }

    /* Custom styles for section titles and subtitles to match image design */
    .section-title {
        font-family: 'Outfit', 'Inter', sans-serif !important;
        font-weight: 800 !important;
        color: #0B1E43 !important;
        text-transform: uppercase !important;
    }
    
    .section-title span, .section-title .text-highlight {
        font-family: 'Cactus Classical Serif', serif !important;
        font-weight: bold !important;
        color: #E31B23 !important;
        text-transform: uppercase !important;
    }

    .section-subtitle {
        font-family: 'Cactus Classical Serif', serif !important;
        color: #4B5563 !important;
    }

    /* Preserve decorative cursive script font where applied */
    .font-script, .font-script * {
        font-family: 'Caveat', cursive !important;
    }

    @keyframes float-bubble {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(4deg); }
    }
    .animate-float-bubble {
        animation: float-bubble 3.8s infinite ease-in-out;
    }
    
    /* Auto Floating Geometric Shapes */
    @keyframes float-shape-1 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        50% { transform: translateY(-18px) rotate(180deg) scale(1.1); }
    }
    @keyframes float-shape-2 {
        0%, 100% { transform: translate(0px, 0px) rotate(0deg) scale(1); }
        50% { transform: translate(15px, -15px) rotate(-90deg) scale(0.95); }
    }
    @keyframes float-shape-3 {
        0%, 100% { transform: translate(0px, 0px) rotate(0deg); }
        50% { transform: translate(-12px, 12px) rotate(45deg); }
    }
    .animate-float-1 { animation: float-shape-1 8s infinite ease-in-out; }
    .animate-float-2 { animation: float-shape-2 10s infinite ease-in-out; }
    .animate-float-3 { animation: float-shape-3 7s infinite ease-in-out; }

    @keyframes play-pulse {
        0% { box-shadow: 0 0 0 0 rgba(227, 27, 35, 0.45); }
        70% { box-shadow: 0 0 0 14px rgba(227, 27, 35, 0); }
        100% { box-shadow: 0 0 0 0 rgba(227, 27, 35, 0); }
    }
    .animate-play-pulse {
        animation: play-pulse 2s infinite ease-in-out;
    }
    
    /* Video testimonial thumbnails transition */
    .student-thumb {
        border-color: transparent;
        transition: all 0.3s ease;
    }
    .student-thumb.active {
        border-color: #E31B23 !important;
        transform: scale(1.1) !important;
    }
</style>
@endpush

@section('content')
    <!-- Background Floating Glow Orbs (Continuous looping animations in background) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-20 -left-20 w-96 h-96 rounded-full bg-[#0B1E43]/5 blur-3xl animate-blur-orbit"></div>
        <div class="absolute top-1/2 -right-20 w-96 h-96 rounded-full bg-[#0B1E43]/5 blur-3xl animate-blur-orbit-reverse"></div>
    </div>

    <!-- 3. HERO SECTION (FULL WIDTH BRANDED HERO) -->
    <section id="hero-section" class="relative bg-white overflow-hidden border-b border-gray-100 z-10 w-full flex items-center min-h-[500px] lg:min-h-[560px]">
        
        <!-- Background Image (Right side Eiffel Tower) -->
        <div class="absolute right-0 top-0 bottom-0 w-full lg:w-[58%] h-full z-0 select-none pointer-events-none">
            <!-- Gradient overlay for desktop to fade smoothly into the text area -->
            <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white via-white/80 to-transparent z-10 hidden lg:block"></div>
            <img src="{{ asset('assets/images/hero_banner.png') }}" class="w-full h-full object-cover object-center lg:object-right opacity-35 lg:opacity-100" alt="Paris Banner">
        </div>
        
        <!-- Max-w Container to align text content with page margins -->
        <div class="max-w-7xl mx-auto px-4 md:px-6 w-full relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left Column: Content -->
                <div class="lg:col-span-7 flex flex-col justify-center space-y-4 text-left py-12 md:py-16">
                    <!-- Cursive Script Tagline -->
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-0.5 bg-[#E31B23]"></span>
                        <span class="font-script text-2xl md:text-3xl text-gray-700 leading-none">Learn. Speak. Success.</span>
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-5xl lg:text-[58px] font-heading font-black text-[#0B1E43] uppercase leading-[1.08] tracking-tight">
                        FRENCH <span class="text-[#E31B23]">COURSES</span>
                    </h1>
                    
                    <!-- Subheading -->
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 tracking-tight leading-snug">
                        For Every Goal & Every Level
                    </h2>
                    
                    <!-- Checklist -->
                    <ul class="space-y-3 pt-2">
                        <li class="flex items-start gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0B1E43] text-white shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span class="text-sm md:text-base font-bold text-gray-700">Beginner to Advanced Levels (A1 to C2)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0B1E43] text-white shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span class="text-sm md:text-base font-bold text-gray-700">Expert Trainers | Interactive Classes</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0B1E43] text-white shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span class="text-sm md:text-base font-bold text-gray-700">DELF / DALF Exam Preparation</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0B1E43] text-white shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span class="text-sm md:text-base font-bold text-gray-750">100% Practical & Communication Based</span>
                        </li>
                    </ul>
                    
                    <!-- Action Buttons -->
                    <div class="pt-4 flex flex-wrap gap-4 items-center">
                        <a href="#courses" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#0B1E43] hover:bg-[#E31B23] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 shadow-md shadow-blue-950/15">
                            Explore Courses <span class="text-sm">➔</span>
                        </a>
                        <a href="#enquire" class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-white border border-gray-300 text-gray-800 hover:border-[#0B1E43] font-extrabold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 shadow-sm">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0B1E43]/5 text-[#E31B23] shrink-0">
                                <svg class="w-3 h-3 fill-current ml-0.5" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </span>
                            Watch Intro
                        </a>
                    </div>
                </div>
                
                <!-- Right Column spacer for desktop layout so content doesn't overlay Paris image -->
                <div class="hidden lg:block lg:col-span-5 h-full"></div>
                
            </div>
        </div>
        
    </section>

    <!-- 4. KEY HIGHLIGHTS BAR (EXACT MATCH TO ATTACHED IMAGE - FLOATING GENTLY) -->
    <section class="px-4 relative z-30 animate-float-slow bg-[#F5F8FC]">
        <div class="max-w-7xl mx-auto mt-6 md:mt-10 bg-white border border-gray-200 shadow-[0_15px_40px_rgba(8,29,71,0.05)] rounded-2xl p-6 lg:py-7 lg:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-6 md:gap-0 md:divide-x divide-gray-100">
                
                <!-- Highlight 1 (Slides in from Left) -->
                <div class="flex flex-col items-center text-center px-4 group reveal-left reveal-delay-100">
                    <div class="text-[#0b2447] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 ease-out">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight">Expert Mentorship</h3>
                    <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider text-[#E31B23]">Native & DELF Certified</p>
                </div>

                <!-- Highlight 2 (Slides in from Bottom) -->
                <div class="flex flex-col items-center text-center px-4 group reveal-bottom reveal-delay-200">
                    <div class="text-[#0b2447] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 ease-out">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight">Conversational Focus</h3>
                    <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider text-[#0B1E43]">Speak from Day One</p>
                </div>

                <!-- Highlight 3 (Slides in from Bottom) -->
                <div class="flex flex-col items-center text-center px-4 group reveal-bottom reveal-delay-300">
                    <div class="text-[#0b2447] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 ease-out">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight">98% Success Rate</h3>
                    <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider text-[#E31B23]">Proven DELF/DALF Results</p>
                </div>

                <!-- Highlight 4 (Slides in from Bottom) -->
                <div class="flex flex-col items-center text-center px-4 group reveal-bottom reveal-delay-400">
                    <div class="text-[#0b2447] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 ease-out">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight">Canada PR Boost</h3>
                    <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider text-[#0B1E43]">+50 Express Entry Points</p>
                </div>

                <!-- Highlight 5 (Slides in from Right) -->
                <div class="flex flex-col items-center text-center px-4 group reveal-right reveal-delay-500">
                    <div class="text-[#0b2447] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 ease-out">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 11h5" />
                            <circle cx="15" cy="15" r="2.5" />
                            <path d="M13.5 17l-1 2 2-1 2 1-1-2" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight">Global Validation</h3>
                    <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider text-[#E31B23]">Govt. & Corporate Aligned</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. OUR FRENCH COURSES SECTION (MIRROR COPY HIGH-FIDELITY DESIGN) -->
    <section id="courses" class="py-16 md:py-20 bg-white overflow-hidden relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <div class="flex items-center justify-center gap-4 mb-2.5">
                    <span class="w-[60px] h-0.5 bg-gradient-to-r from-transparent to-[#E31B23] shrink-0"></span>
                    <h2 class="section-title text-2xl md:text-3xl shrink-0 tracking-wider">
                        OUR <span class="text-[#E31B23]">FRENCH COURSES</span>
                    </h2>
                    <span class="w-[60px] h-0.5 bg-gradient-to-l from-transparent to-[#E31B23] shrink-0"></span>
                </div>
                <p class="section-subtitle text-xs md:text-sm font-medium tracking-wide leading-relaxed">Choose from our CEFR-aligned modules from Beginner to Advanced levels</p>
            </div>            <!-- Cards Grid (3 columns desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                @forelse($courses as $course)
                    @php
                        $bgImage = 'assets/images/course_bg_a1.png';
                        $textColor = '#E31B23';
                        $btnBg = 'bg-[#E31B23]';
                        $btnHover = 'hover:bg-red-700';
                        
                        $titleLower = strtolower($course->title);
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
                            // Fallback based on loop index
                            $index = $loop->index % 6;
                            $images = [
                                'assets/images/course_bg_a1.png',
                                'assets/images/course_bg_a2.png',
                                'assets/images/course_bg_b1.png',
                                'assets/images/course_bg_b2.png',
                                'assets/images/course_bg_c1.png',
                                'assets/images/course_bg_delf.png'
                            ];
                            $bgImage = $images[$index];
                            $textColor = ($index % 2 === 0) ? '#E31B23' : '#0B1E43';
                            $btnBg = ($index % 2 === 0) ? 'bg-[#E31B23]' : 'bg-[#0B1E43]';
                            $btnHover = ($index % 2 === 0) ? 'hover:bg-red-700' : 'hover:bg-blue-900';
                        }
                    @endphp

                    <!-- Dynamic Course Card -->
                    <div class="bg-white rounded-3xl border border-gray-100 hover:shadow-[0_12px_35px_rgba(8,29,71,0.06)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col justify-between p-6 md:p-8 min-h-[220px] group">
                        <div class="absolute inset-0 z-0 select-none pointer-events-none">
                            <img src="{{ asset($bgImage) }}" class="w-full h-full object-cover object-right group-hover:scale-105 transition-transform duration-700 ease-out">
                        </div>
                        <div class="relative z-10 max-w-[65%] flex flex-col justify-between h-full space-y-4">
                            <div>
                                <span class="text-sm md:text-base font-black tracking-wider uppercase block mb-1" style="color: {{ $textColor }};">
                                    {{ $course->title }}
                                </span>
                                <p class="text-[13px] md:text-sm text-gray-550 font-medium leading-relaxed line-clamp-3">
                                    {{ $course->description }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('courses.show', $course->id) }}" class="inline-flex items-center justify-center gap-1 px-4 py-2 {{ $btnBg }} text-white text-[11px] font-bold uppercase rounded-lg {{ $btnHover }} transition-colors duration-300">
                                    Learn More
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State Fallback -->
                    <div class="col-span-3 text-center py-12 text-gray-400">
                        No courses available at the moment.
                    </div>
                @endforelse      </div>

            </div>

            <!-- View All Courses Button -->
            <div class="flex justify-center mt-12">
                <a href="{{ route('courses.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-[#0B1E43] hover:bg-blue-900 text-white font-extrabold text-sm uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md shadow-[#0B1E43]/10">
                    View All Courses
                </a>
            </div>

        </div>
    </section>
    <!-- 6. WHY LEARN FRENCH SECTION -->
    <section id="why-french" class="py-20 md:py-28 bg-[#F5F8FC] overflow-hidden relative reveal-item z-10 border-y border-gray-100/50">
        <!-- Background Skyline Landscape Banner (Constrained on desktop to prevent overlap) -->
        <div class="absolute right-0 bottom-0 w-full lg:w-[45%] xl:w-[40%] h-[200px] sm:h-[260px] lg:h-full z-0 select-none pointer-events-none">
            <!-- Left-side fade mask to seamlessly blend the image edge with the background -->
            <div class="absolute inset-y-0 left-0 w-64 bg-gradient-to-r from-[#F5F8FC] via-[#F5F8FC]/60 to-transparent z-10 hidden lg:block"></div>
            <!-- Top-side fade mask to seamlessly blend the top edge of the image with the background -->
            <div class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-[#F5F8FC] to-transparent z-10 hidden lg:block"></div>
            <img src="{{ asset('assets/images/why_learn_french_new_bg.png') }}" alt="Paris Skyline Banner" class="w-full h-full object-cover mix-blend-multiply" style="object-position: right bottom;">
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left Content: 5 Columns -->
                <div class="lg:col-span-8 space-y-10">
                    <!-- Section Header -->
                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <div class="flex items-center justify-center gap-4 mb-2.5">
                            <span class="w-[60px] h-0.5 bg-gradient-to-r from-transparent to-[#E31B23] shrink-0"></span>
                            <h2 class="section-title text-2xl md:text-3xl shrink-0 tracking-wider">
                                WHY LEARN <span class="text-[#E31B23]">FRENCH?</span>
                            </h2>
                            <span class="w-[60px] h-0.5 bg-gradient-to-l from-transparent to-[#E31B23] shrink-0"></span>
                        </div>
                        <p class="section-subtitle text-xs md:text-sm font-medium tracking-wide leading-relaxed text-center">Unlock global career opportunities, ease your immigration path to Canada, and learn a beautiful romance language.</p>
                    </div>
                    
                    <!-- 5 Columns Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-6 md:gap-8 lg:gap-10 text-center">
                        
                        <!-- Item 1 -->
                        <div class="flex flex-col items-center group">
                            <div class="mb-5 p-5 bg-white/95 rounded-[24px] shadow-sm border border-gray-100/60 group-hover:scale-110 group-hover:bg-white group-hover:shadow-md transition-all duration-300">
                                <img src="{{ asset('assets/images/icon_globe.png') }}" class="w-[52px] h-[52px] md:w-[58px] md:h-[58px] object-contain" alt="Globe Icon">
                            </div>
                            <h4 class="text-sm md:text-base font-bold text-[#0B1E43] leading-snug">Spoken in<br>29+ Countries</h4>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex flex-col items-center group">
                            <div class="mb-5 p-5 bg-white/95 rounded-[24px] shadow-sm border border-gray-100/60 group-hover:scale-110 group-hover:bg-white group-hover:shadow-md transition-all duration-300">
                                <img src="{{ asset('assets/images/icon_briefcase.png') }}" class="w-[52px] h-[52px] md:w-[58px] md:h-[58px] object-contain" alt="Career Icon">
                            </div>
                            <h4 class="text-sm md:text-base font-bold text-[#0B1E43] leading-snug">Enhance Career<br>Opportunities</h4>
                        </div>

                        <!-- Item 3 -->
                        <div class="flex flex-col items-center group">
                            <div class="mb-5 p-5 bg-white/95 rounded-[24px] shadow-sm border border-gray-100/60 group-hover:scale-110 group-hover:bg-white group-hover:shadow-md transition-all duration-300">
                                <img src="{{ asset('assets/images/icon_university.png') }}" class="w-[52px] h-[52px] md:w-[58px] md:h-[58px] object-contain" alt="University Icon">
                            </div>
                            <h4 class="text-sm md:text-base font-bold text-[#0B1E43] leading-snug">Study in Top<br>French Universities</h4>
                        </div>

                        <!-- Item 4 -->
                        <div class="flex flex-col items-center group">
                            <div class="mb-5 p-5 bg-white/95 rounded-[24px] shadow-sm border border-gray-100/60 group-hover:scale-110 group-hover:bg-white group-hover:shadow-md transition-all duration-300">
                                <img src="{{ asset('assets/images/icon_maple.png') }}" class="w-[52px] h-[52px] md:w-[58px] md:h-[58px] object-contain" alt="Canada Icon">
                            </div>
                            <h4 class="text-sm md:text-base font-bold text-[#0B1E43] leading-snug">Gateway to<br>Canada & Europe</h4>
                        </div>

                        <!-- Item 5 -->
                        <div class="flex flex-col items-center group">
                            <div class="mb-5 p-5 bg-white/95 rounded-[24px] shadow-sm border border-gray-100/60 group-hover:scale-110 group-hover:bg-white group-hover:shadow-md transition-all duration-300 flex items-center justify-center w-[92px] h-[92px] md:w-[98px] md:h-[98px] mx-auto">
                                <svg class="w-[52px] h-[52px] md:w-[58px] md:h-[58px] text-[#0B1E43]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h4 class="text-sm md:text-base font-bold text-[#0B1E43] leading-snug">Rich Culture,<br>Language & Lifestyle</h4>
                        </div>

                    </div>
                </div>
                
                <!-- Right Side Empty Spacer / Spacing Buffer (Allows clean backdrop & prevents overlapping) -->
                <div class="lg:col-span-4 h-28 sm:h-36 lg:h-64"></div>

            </div>
        </div>
    </section>

    <!-- 7. FORM SECTION (LEAD CAPTURE) -->
    <section id="enquire" class="py-10 md:py-12 px-4 bg-white reveal-item z-10">
        <div class="max-w-7xl mx-auto bg-white border border-gray-100 rounded-3xl shadow-[0_15px_50px_rgba(8,29,71,0.06)] overflow-hidden relative z-10">
            
            <!-- Background Banner Image (No crop / No cut) -->
            <div class="absolute inset-0 z-0 select-none pointer-events-none">
                <img src="{{ asset('assets/images/enquiry_banner_canada.png') }}" alt="Canada Banner" class="w-full h-full object-cover lg:object-fill">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 relative z-20">
                <!-- Left Side Form -->
                <div class="lg:col-span-7 py-5 px-6 md:py-6 md:px-10">
                    <div>
                        <h2 class="section-title text-xl md:text-2xl mb-1 text-left tracking-wider">
                            BEGIN YOUR <span class="text-[#E31B23]">FRENCH JOURNEY TODAY!</span>
                        </h2>
                        <p class="section-subtitle text-xs md:text-sm mb-4 text-left leading-relaxed">Fill out the form below to receive a call back and schedule a free trial lesson.</p>
                    </div>

                    <form id="lead-form" class="space-y-3.5" action="#" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">First Name*</label>
                                <input type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-[#E31B23] focus:outline-none bg-white transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Last Name*</label>
                                <input type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-[#E31B23] focus:outline-none bg-white transition-colors">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Your Email*</label>
                                <input type="email" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-[#E31B23] focus:outline-none bg-white transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Your Phone*</label>
                                <input type="tel" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-[#E31B23] focus:outline-none bg-white transition-colors">
                            </div>
                        </div>

                        <!-- Checkboxes -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">What are you interested in?</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="interest[]" value="A1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    A1 Beginner
                                </label>
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="interest[]" value="A2" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    A2 Elementary
                                </label>
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="interest[]" value="B1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    B1 Intermediate
                                </label>
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="interest[]" value="B2" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    B2 Upper Intermediate
                                </label>
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="interest[]" value="C1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    C1 Advanced
                                </label>
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="interest[]" value="delf" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    DELF / DALF
                                </label>
                                <label class="flex items-center text-sm font-medium text-gray-700 cursor-pointer col-span-2 sm:col-span-1">
                                    <input type="checkbox" name="interest[]" value="other" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                    Other
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-[#E31B23] hover:bg-red-700 text-white py-3 rounded-lg font-black text-sm uppercase tracking-wider flex items-center justify-center gap-2 transition-all duration-300 shadow-md shadow-red-600/10">
                            Submit & Get Free Counselling
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>

                        <!-- Privacy Shield Statement -->
                        <div class="flex items-start gap-2 text-[10px] text-gray-400 mt-3 justify-start">
                            <svg class="w-4 h-4 text-[#0B1E43] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="leading-normal">By submitting this form, you agree to our <a href="{{ route('privacy.policy') }}" class="underline hover:text-red-500">Privacy Policy</a> and <a href="{{ route('terms.conditions') }}" class="underline hover:text-red-500">Terms & Conditions</a>.</span>
                        </div>

                    </form>
                </div>

                <!-- Right Side Empty Spacer (Lets background image show through) -->
                <div class="hidden lg:block lg:col-span-5 h-full"></div>
            </div>
        </div>
    </section>

    <!-- 7.5 WHY CHOOSE US SECTION (MIRROR COPY PREMIUM DESIGN) -->
    <section class="py-8 md:py-10 lg:pt-12 lg:pb-16 bg-[#F5F8FC] overflow-hidden px-4 relative z-10 border-b border-gray-100/50">
        
        <!-- Organic 4-pointed hand-drawn star shapes in background (Top Left - matching brand colors) -->
        <div class="absolute -top-4 -left-4 md:-top-6 md:-left-6 opacity-[0.06] pointer-events-none select-none text-[#E31B23]">
            <svg class="w-28 h-28 md:w-36 md:h-36 rotate-[12deg]" fill="currentColor" viewBox="0 0 100 100">
                <path d="M50 0 C53 35 65 47 100 50 C65 53 53 65 50 100 C47 65 35 53 0 50 C35 47 47 35 50 0 Z" />
            </svg>
        </div>
        <div class="absolute top-10 left-16 md:left-24 opacity-[0.05] pointer-events-none select-none text-[#E31B23]">
            <svg class="w-16 h-16 md:w-20 md:h-20 -rotate-[15deg]" fill="currentColor" viewBox="0 0 100 100">
                <path d="M50 0 C53 35 65 47 100 50 C65 53 53 65 50 100 C47 65 35 53 0 50 C35 47 47 35 50 0 Z" />
            </svg>
        </div>

        <!-- Organic brush stroke/leaf shape in bottom right corner (brand color) -->
        <div class="absolute bottom-0 right-0 opacity-[0.10] pointer-events-none select-none text-[#0B1E43]">
            <svg class="w-20 h-20 md:w-24 md:h-24" fill="currentColor" viewBox="0 0 100 100">
                <path d="M100 100 C75 100 50 90 35 75 C20 60 15 45 15 15 C20 40 40 60 70 75 C85 82 95 90 100 100 Z" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto relative z-10 px-4 md:px-6">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <div class="flex items-center justify-center gap-4 mb-2.5">
                    <span class="w-[60px] h-0.5 bg-gradient-to-r from-transparent to-[#E31B23] shrink-0"></span>
                    <h2 class="section-title text-2xl md:text-3xl shrink-0 tracking-wider">
                        WHY CHOOSE <span class="text-[#E31B23]">US</span>
                    </h2>
                    <span class="w-[60px] h-0.5 bg-gradient-to-l from-transparent to-[#E31B23] shrink-0"></span>
                </div>
                <p class="section-subtitle text-xs md:text-sm font-medium tracking-wide leading-relaxed">
                    Expert educators and customized curriculum to guarantee your success in French.
                </p>
            </div>
            
            <!-- Cards Grid with Alternating Staggered Offset Layout (Tight gap to match screenshot) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 max-w-6xl mx-auto lg:pb-10">
                
                <!-- Card 1: World Class Teachers -->
                <div class="group relative rounded-[2.5rem] overflow-hidden aspect-[4/5] sm:aspect-auto h-[290px] sm:h-[320px] md:h-[360px] lg:h-[400px] shadow-[0_15px_40px_rgba(0,0,0,0.06)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 lg:translate-y-0">
                    <img src="{{ asset('assets/images/choose_teachers.png') }}" alt="World Class Teachers" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent flex flex-col justify-end p-6 md:p-8">
                        <h3 class="text-white text-lg md:text-xl font-heading font-bold tracking-wide leading-snug text-center">
                            World Class<br>Teachers
                        </h3>
                    </div>
                </div>

                <!-- Card 2: Experienced and Caring Teachers (Shifted Down to match screenshot) -->
                <div class="group relative rounded-[2.5rem] overflow-hidden aspect-[4/5] sm:aspect-auto h-[290px] sm:h-[320px] md:h-[360px] lg:h-[400px] shadow-[0_15px_40px_rgba(0,0,0,0.06)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 lg:translate-y-12">
                    <img src="{{ asset('assets/images/choose_experienced.png') }}" alt="Experienced and Caring Teachers" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent flex flex-col justify-end p-6 md:p-8">
                        <h3 class="text-white text-lg md:text-xl font-heading font-bold tracking-wide leading-snug text-center">
                            Experienced and<br>Caring Teachers
                        </h3>
                    </div>
                </div>

                <!-- Card 3: Global Community -->
                <div class="group relative rounded-[2.5rem] overflow-hidden aspect-[4/5] sm:aspect-auto h-[290px] sm:h-[320px] md:h-[360px] lg:h-[400px] shadow-[0_15px_40px_rgba(0,0,0,0.06)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 lg:translate-y-0">
                    <img src="{{ asset('assets/images/choose_community.png') }}" alt="Global Community" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent flex flex-col justify-end p-6 md:p-8">
                        <h3 class="text-white text-lg md:text-xl font-heading font-bold tracking-wide leading-snug text-center">
                            Global Community
                        </h3>
                    </div>
                </div>

                <!-- Card 4: Top Notch Courses (Shifted Down to match screenshot) -->
                <div class="group relative rounded-[2.5rem] overflow-hidden aspect-[4/5] sm:aspect-auto h-[290px] sm:h-[320px] md:h-[360px] lg:h-[400px] shadow-[0_15px_40px_rgba(0,0,0,0.06)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 lg:translate-y-12">
                    <img src="{{ asset('assets/images/choose_courses.png') }}" alt="Top Notch Courses" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent flex flex-col justify-end p-6 md:p-8">
                        <h3 class="text-white text-lg md:text-xl font-heading font-bold tracking-wide leading-snug text-center">
                            Top Notch Courses
                        </h3>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- 8. WHAT OUR STUDENTS SAY (TESTIMONIALS) -->
    <section class="py-16 md:py-24 bg-white overflow-hidden px-4 reveal-item z-10">
        <!-- Title -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#E31B23] block mb-2">
                <span class="inline-block w-8 h-px bg-[#E31B23] mr-2 align-middle"></span>
                TESTIMONIALS
                <span class="inline-block w-8 h-px bg-[#E31B23] ml-2 align-middle"></span>
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0B1E43] font-sans tracking-tight mb-4">
                What Our <span class="text-[#E31B23]">Students</span> Say
            </h2>
            <p class="text-gray-500 text-sm md:text-base font-medium max-w-2xl mx-auto leading-relaxed">
                Real stories. Real results. From students who achieved their French goals with Francoway.
            </p>
        </div>

        <!-- Main Testimonial Card -->
        <div class="max-w-6xl mx-auto bg-[#0B1E43] rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5 relative p-6 md:p-10 text-white mb-16">
            <!-- Decorative blur shapes inside the dark card -->
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-[#E31B23]/25 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-blue-500/15 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch relative z-10">
                
                <!-- Left Column: Video Review Card (lg:col-span-5) -->
                <div class="lg:col-span-5 flex justify-center items-center">
                    <div class="relative w-full max-w-[340px] aspect-[3/4] bg-[#071530] border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl group cursor-pointer" onclick="playActiveStudentVideo()">
                        <!-- Student Image Background -->
                        <img id="active-student-video-poster" src="{{ asset('assets/images/student1.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" alt="Student Review Video">
                        
                        <!-- Video Element (Hidden initially, plays inline on click) -->
                        <video id="active-student-video" class="absolute inset-0 w-full h-full object-cover hidden" loop playsinline controls></video>
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        
                        <!-- Play Button Overlay -->
                        <div id="active-student-video-play-btn" class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-md text-white rounded-full flex items-center justify-center border border-white/40 shadow-lg group-hover:scale-110 transition-transform duration-300 relative z-10 animate-play-pulse">
                                <svg class="w-6 h-6 fill-current ml-0.5" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Top Info Badge -->
                        <span class="absolute top-4 left-4 bg-[#E31B23] text-white text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-md border border-white/10 flex items-center gap-1.5">
                            <span class="text-xs">★</span> <span id="active-student-video-badge">Cleared DELF B2</span>
                        </span>
                        
                        <!-- Bottom Student Info Tag -->
                        <div class="absolute bottom-6 left-6 text-left">
                            <h4 id="active-student-video-name" class="text-white text-base font-extrabold uppercase tracking-wider mb-0.5">Simran Kaur</h4>
                            <p id="active-student-video-role" class="text-white/60 text-[10px] font-bold uppercase tracking-widest">Francoway Student</p>
                        </div>

                        <!-- Verified Checkmark Badge at bottom-right -->
                        <div class="absolute bottom-6 right-6 w-6 h-6 rounded-full bg-[#3897F0] text-white flex items-center justify-center shadow-md">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Details & Score Card (lg:col-span-7) -->
                <div class="lg:col-span-7 flex flex-col justify-between space-y-6 text-left">
                    
                    <!-- Score and Rating Area -->
                    <div class="flex items-center gap-5">
                        <!-- Boxed Score -->
                        <div class="border border-white/15 rounded-2xl bg-white/5 py-2.5 px-5 text-center flex flex-col justify-center min-w-[105px] shadow-lg shrink-0">
                            <span id="active-student-score-num" class="text-3xl md:text-4xl font-extrabold font-sans leading-none text-white tracking-tight">92</span>
                            <span id="active-student-score-den" class="text-[8px] text-[#A0AEC0] uppercase tracking-widest font-black mt-1">OUT OF 100</span>
                        </div>

                        <!-- Rating Badge Text -->
                        <div class="space-y-1">
                            <div class="flex gap-0.5 text-[#F8B803]" id="active-student-stars">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            </div>
                            <h4 id="active-student-badge-text" class="text-base font-extrabold text-white uppercase tracking-wider leading-none">CLEARED DELF B2</h4>
                            <div class="flex items-center gap-1 mt-0.5 text-[10px] text-white/50 font-semibold">
                                <span>Verified by Francoway Academy</span>
                                <svg class="w-3.5 h-3.5 fill-[#3897F0] shrink-0" viewBox="0 0 24 24">
                                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-2 15l-5-5 1.4-1.4 3.6 3.6 7.6-7.6 1.4 1.4-9 9z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Review Text (Card Layout) -->
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-5 md:p-6 relative">
                        <!-- Quotation Icons -->
                        <span class="absolute top-2 left-3 text-5xl text-[#E31B23] font-serif select-none pointer-events-none">“</span>
                        
                        <p id="active-student-text" class="text-xs md:text-sm text-gray-200 leading-relaxed font-medium px-4 py-2">
                            "Francoway's live classes and AI practice tool helped me clear my DELF B2 exam on my first attempt. The structure and personal attention were exceptional!"
                        </p>
                        
                        <span class="absolute bottom-2 right-3 text-5xl text-[#E31B23] font-serif select-none pointer-events-none">”</span>
                    </div>

                    <!-- Features Row -->
                    <div class="border-t border-white/10 pt-5">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center md:divide-x divide-white/10">
                            <!-- Feature 1 -->
                            <div class="flex flex-col items-center md:px-1">
                                <div class="text-[#E31B23] mb-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-gray-250">Expert Trainers</span>
                            </div>
                            <!-- Feature 2 -->
                            <div class="flex flex-col items-center md:px-1">
                                <div class="text-[#E31B23] mb-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-gray-250">Live Classes</span>
                            </div>
                            <!-- Feature 3 -->
                            <div class="flex flex-col items-center md:px-1">
                                <div class="text-[#E31B23] mb-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 .364l-.707 .707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-gray-250">AI Practice</span>
                            </div>
                            <!-- Feature 4 -->
                            <div class="flex flex-col items-center md:px-1">
                                <div class="text-[#E31B23] mb-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-gray-250">Personalized Feedback</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slider Thumbnails / Selectors & Arrow Controls -->
                    <div class="flex items-center gap-3 pt-5 border-t border-white/10">
                        <div class="flex gap-2.5 overflow-x-auto py-1" id="student-selectors">
                            <!-- Student 1 Thumbnail -->
                            <div onclick="selectStudentReview(0)" class="student-thumb active w-11 h-11 rounded-full overflow-hidden border-2 border-[#E31B23] cursor-pointer transition-all duration-300 transform scale-105 shrink-0">
                                <img src="{{ asset('assets/images/student1.png') }}" class="w-full h-full object-cover" alt="Simran Kaur">
                            </div>
                            <!-- Student 2 Thumbnail -->
                            <div onclick="selectStudentReview(1)" class="student-thumb w-11 h-11 rounded-full overflow-hidden border-2 border-transparent hover:border-white/50 cursor-pointer transition-all duration-300 shrink-0">
                                <img src="{{ asset('assets/images/student2.png') }}" class="w-full h-full object-cover" alt="Rohit Verma">
                            </div>
                            <!-- Student 3 Thumbnail -->
                            <div onclick="selectStudentReview(2)" class="student-thumb w-11 h-11 rounded-full overflow-hidden border-2 border-transparent hover:border-white/50 cursor-pointer transition-all duration-300 shrink-0">
                                <img src="{{ asset('assets/images/student3.png') }}" class="w-full h-full object-cover" alt="Amandeep Singh">
                            </div>
                            <!-- Student 4 Thumbnail -->
                            <div onclick="selectStudentReview(3)" class="student-thumb w-11 h-11 rounded-full overflow-hidden border-2 border-transparent hover:border-white/50 cursor-pointer transition-all duration-300 shrink-0">
                                <img src="{{ asset('assets/images/student4.png') }}" class="w-full h-full object-cover" alt="Neha Sharma">
                            </div>
                        </div>

                        <div class="flex gap-2 ms-auto shrink-0">
                            <!-- Prev Button -->
                            <button type="button" onclick="prevStudentReview()" class="w-10 h-10 rounded-full border border-white/10 hover:border-[#E31B23] flex items-center justify-center transition-all bg-white/5 hover:bg-[#E31B23] text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <!-- Next Button -->
                            <button type="button" onclick="nextStudentReview()" class="w-10 h-10 rounded-full border border-white/10 hover:border-[#E31B23] flex items-center justify-center transition-all bg-white/5 hover:bg-[#E31B23] text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM: Student Video Reviews Grid -->
        <div class="max-w-6xl mx-auto px-2">
            <div class="flex items-center gap-3.5 mb-8">
                <!-- Red Rounded Icon -->
                <div class="w-10 h-10 rounded-xl bg-[#E31B23]/10 text-[#E31B23] flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="text-left">
                    <h3 class="text-xl font-extrabold text-[#0B1E43] font-sans">Student Video Reviews</h3>
                    <p class="text-xs text-gray-500 font-semibold mt-0.5">See how our students achieved their success</p>
                </div>
            </div>
            
            <!-- Video Cards Grid -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-5">
                <!-- Card 1: Arjun Mehta -->
                <div onclick="openVideoModal('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4')" class="relative rounded-[2rem] overflow-hidden shadow-md group cursor-pointer aspect-[3/4] border border-gray-100/60 bg-slate-900">
                    <img src="{{ asset('assets/images/arjun_mehta.jpg') }}" class="w-full h-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105" alt="Arjun Mehta">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                    
                    <!-- Red Quote Bubble at top-right -->
                    <div class="absolute top-4 right-4 w-7 h-7 rounded-full bg-[#E31B23] text-white flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold font-serif leading-none mt-0.5">“</span>
                    </div>
                    
                    <!-- Play Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center border border-white/30 shadow-md transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Bottom Info tags -->
                    <div class="absolute bottom-4 left-4 right-4 text-left">
                        <!-- Stars -->
                        <div class="flex gap-0.5 text-[#F8B803] mb-1">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                        <h4 class="text-white text-xs font-black tracking-wide leading-tight">Arjun Mehta</h4>
                        <p class="text-white/60 text-[9px] font-bold mt-0.5">Cleared DELF B1</p>
                    </div>
                </div>

                <!-- Card 2: Kritika Sharma -->
                <div onclick="openVideoModal('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4')" class="relative rounded-[2rem] overflow-hidden shadow-md group cursor-pointer aspect-[3/4] border border-gray-100/60 bg-slate-900">
                    <img src="{{ asset('assets/images/kritika_sharma.jpg') }}" class="w-full h-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105" alt="Kritika Sharma">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                    
                    <div class="absolute top-4 right-4 w-7 h-7 rounded-full bg-[#E31B23] text-white flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold font-serif leading-none mt-0.5">“</span>
                    </div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center border border-white/30 shadow-md transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4 text-left">
                        <div class="flex gap-0.5 text-[#F8B803] mb-1">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                        <h4 class="text-white text-xs font-black tracking-wide leading-tight">Kritika Sharma</h4>
                        <p class="text-white/60 text-[9px] font-bold mt-0.5">Cleared DELF A2</p>
                    </div>
                </div>

                <!-- Card 3: Rohan Verma -->
                <div onclick="openVideoModal('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4')" class="relative rounded-[2rem] overflow-hidden shadow-md group cursor-pointer aspect-[3/4] border border-gray-100/60 bg-slate-900">
                    <img src="{{ asset('assets/images/rohan_verma.jpg') }}" class="w-full h-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105" alt="Rohan Verma">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                    
                    <div class="absolute top-4 right-4 w-7 h-7 rounded-full bg-[#E31B23] text-white flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold font-serif leading-none mt-0.5">“</span>
                    </div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center border border-white/30 shadow-md transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4 text-left">
                        <div class="flex gap-0.5 text-[#F8B803] mb-1">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                        <h4 class="text-white text-xs font-black tracking-wide leading-tight">Rohan Verma</h4>
                        <p class="text-white/60 text-[9px] font-bold mt-0.5">Cleared DELF C1</p>
                    </div>
                </div>

                <!-- Card 4: Mehak Bedi -->
                <div onclick="openVideoModal('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4')" class="relative rounded-[2rem] overflow-hidden shadow-md group cursor-pointer aspect-[3/4] border border-gray-100/60 bg-slate-900">
                    <img src="{{ asset('assets/images/mehak_bedi.jpg') }}" class="w-full h-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105" alt="Mehak Bedi">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                    
                    <div class="absolute top-4 right-4 w-7 h-7 rounded-full bg-[#E31B23] text-white flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold font-serif leading-none mt-0.5">“</span>
                    </div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center border border-white/30 shadow-md transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4 text-left">
                        <div class="flex gap-0.5 text-[#F8B803] mb-1">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                        <h4 class="text-white text-xs font-black tracking-wide leading-tight">Mehak Bedi</h4>
                        <p class="text-white/60 text-[9px] font-bold mt-0.5">Cleared DELF B2</p>
                    </div>
                </div>

                <!-- Card 5: Gurpreet Singh -->
                <div onclick="openVideoModal('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4')" class="relative rounded-[2rem] overflow-hidden shadow-md group cursor-pointer aspect-[3/4] border border-gray-100/60 bg-slate-900">
                    <img src="{{ asset('assets/images/gurpreet_singh.jpg') }}" class="w-full h-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105" alt="Gurpreet Singh">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                    
                    <div class="absolute top-4 right-4 w-7 h-7 rounded-full bg-[#E31B23] text-white flex items-center justify-center shadow-md">
                        <span class="text-sm font-bold font-serif leading-none mt-0.5">“</span>
                    </div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center border border-white/30 shadow-md transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4 text-left">
                        <div class="flex gap-0.5 text-[#F8B803] mb-1">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </div>
                        <h4 class="text-white text-xs font-black tracking-wide leading-tight">Gurpreet Singh</h4>
                        <p class="text-white/60 text-[9px] font-bold mt-0.5">Cleared DELF B1</p>
                    </div>
                </div>
            </div>
            
            <!-- Dots Pagination -->
            <div class="flex justify-center gap-2 mt-8">
                <span class="w-2.5 h-2.5 rounded-full bg-[#E31B23]"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#D1D5DB] hover:bg-[#E31B23]/50 cursor-pointer"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#D1D5DB] hover:bg-[#E31B23]/50 cursor-pointer"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-[#D1D5DB] hover:bg-[#E31B23]/50 cursor-pointer"></span>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div id="videoModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 hidden opacity-0 transition-opacity duration-300 pointer-events-none" onclick="closeVideoModal()">
        <div class="relative w-full max-w-4xl mx-4 aspect-video bg-black rounded-3xl overflow-hidden shadow-2xl border border-white/10" onclick="event.stopPropagation()">
            <button onclick="closeVideoModal()" class="absolute top-4 right-4 z-50 text-white/70 hover:text-white transition-colors bg-black/40 rounded-full p-2.5 hover:bg-black/60">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <video id="modalVideo" class="w-full h-full object-cover" controls playsinline src=""></video>
        </div>
    </div>

    <!-- Success Submit & Intro Video Script -->
    <script>
        function openVideoModal(videoUrl) {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('modalVideo');
            if (modal && video) {
                video.src = videoUrl;
                modal.classList.remove('hidden', 'pointer-events-none');
                setTimeout(() => modal.classList.remove('opacity-0'), 10);
                video.play();
            }
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('modalVideo');
            if (modal && video) {
                modal.classList.add('opacity-0');
                video.pause();
                setTimeout(() => {
                    modal.classList.add('hidden', 'pointer-events-none');
                    video.src = '';
                }, 300);
            }
        }

        const leadForm = document.getElementById('lead-form');
        leadForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Merci! Your request has been submitted successfully. A Francoway consultant will contact you shortly.');
            leadForm.reset();
        });

        // Testimonial Reviews Split Layout Logic
        const studentsData = [
            {
                name: "Simran Kaur",
                role: "Francoway Student",
                badge: "Cleared DELF B2",
                scoreNum: 92,
                scoreDen: "out of 100",
                offset: 12.1, // (150.8 * (1 - 92/100))
                text: '"Francoway\'s live classes and AI practice tool helped me clear my DELF B2 exam on my first attempt. The structure and personal attention were exceptional!"',
                videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4",
                image: "{{ asset('assets/images/student1.png') }}"
            },
            {
                name: "Rohit Verma",
                role: "Canada PR Applicant",
                badge: "Canada Express Entry",
                scoreNum: 9,
                scoreDen: "out of 10",
                offset: 15.1, // (150.8 * (1 - 9/10))
                text: '"I needed CLB 7+ for my Canada PR Express Entry. Thanks to the rigorous training at Francoway, I achieved a CLB 9 in my TEF Canada exam. Highly recommended!"',
                videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
                image: "{{ asset('assets/images/student2.png') }}"
            },
            {
                name: "Amandeep Singh",
                role: "Francoway Student",
                badge: "Cleared DELF A2",
                scoreNum: 96,
                scoreDen: "out of 100",
                offset: 6.0, // (150.8 * (1 - 96/100))
                text: '"Learning French from scratch seemed impossible, but the teachers at Francoway made it fun and simple. I cleared my DELF A2 exam with 96/100 in just 2 months!"',
                videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4",
                image: "{{ asset('assets/images/student3.png') }}"
            },
            {
                name: "Neha Sharma",
                role: "Francoway Student",
                badge: "Cleared DELF B1",
                scoreNum: 88,
                scoreDen: "out of 100",
                offset: 18.1, // (150.8 * (1 - 88/100))
                text: '"The curriculum is perfectly aligned with the CEFR standards. I moved from A1 to B1 level in French in just 6 months. The worksheets and mocks were key to my success."',
                videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4",
                image: "{{ asset('assets/images/student4.png') }}"
            }
        ];

        let activeStudentIndex = 0;
        let testimonialAutoPlayInterval = null;

        function selectStudentReview(index) {
            activeStudentIndex = index;
            const student = studentsData[index];

            // Reset video element
            const video = document.getElementById('active-student-video');
            const poster = document.getElementById('active-student-video-poster');
            const playBtn = document.getElementById('active-student-video-play-btn');
            
            if (video) {
                video.pause();
                video.classList.add('hidden');
            }
            if (poster) poster.classList.remove('hidden');
            if (playBtn) playBtn.classList.remove('hidden');

            // Update Video Card poster, badge, name
            if (poster) poster.src = student.image;
            if (video) video.src = student.videoUrl;
            
            const vBadge = document.getElementById('active-student-video-badge');
            const vName = document.getElementById('active-student-video-name');
            const vRole = document.getElementById('active-student-video-role');
            
            if (vBadge) vBadge.textContent = student.badge;
            if (vName) vName.textContent = student.name;
            if (vRole) vRole.textContent = student.role;

            // Update Details
            const scoreNum = document.getElementById('active-student-score-num');
            const scoreDen = document.getElementById('active-student-score-den');
            const scoreCircle = document.getElementById('active-student-score-circle');
            const badgeText = document.getElementById('active-student-badge-text');
            const activeText = document.getElementById('active-student-text');
            
            if (scoreNum) scoreNum.textContent = student.scoreNum;
            if (scoreDen) scoreDen.textContent = student.scoreDen;
            if (scoreCircle) scoreCircle.style.strokeDashoffset = student.offset;
            if (badgeText) badgeText.textContent = student.badge;
            if (activeText) activeText.textContent = student.text;

            // Update Thumbnails
            const thumbs = document.querySelectorAll('.student-thumb');
            thumbs.forEach((thumb, idx) => {
                if (idx === index) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }

        function playActiveStudentVideo() {
            const video = document.getElementById('active-student-video');
            const poster = document.getElementById('active-student-video-poster');
            const playBtn = document.getElementById('active-student-video-play-btn');

            stopTestimonialAutoPlay();

            if (video) {
                if (video.classList.contains('hidden')) {
                    video.classList.remove('hidden');
                    if (poster) poster.classList.add('hidden');
                    if (playBtn) playBtn.classList.add('hidden');
                    video.play();
                } else {
                    if (video.paused) {
                        video.play();
                    } else {
                        video.pause();
                    }
                }
            }
        }

        function prevStudentReview() {
            let newIndex = activeStudentIndex - 1;
            if (newIndex < 0) newIndex = studentsData.length - 1;
            selectStudentReview(newIndex);
            stopTestimonialAutoPlay();
        }

        function nextStudentReview() {
            let newIndex = activeStudentIndex + 1;
            if (newIndex >= studentsData.length) newIndex = 0;
            selectStudentReview(newIndex);
            stopTestimonialAutoPlay();
        }

        function startTestimonialAutoPlay() {
            stopTestimonialAutoPlay();
            testimonialAutoPlayInterval = setInterval(() => {
                // Only autoplay if video is not actively playing
                const video = document.getElementById('active-student-video');
                if (video && (video.classList.contains('hidden') || video.paused)) {
                    let nextIndex = (activeStudentIndex + 1) % studentsData.length;
                    selectStudentReview(nextIndex);
                }
            }, 6000);
        }

        function stopTestimonialAutoPlay() {
            if (testimonialAutoPlayInterval) {
                clearInterval(testimonialAutoPlayInterval);
            }
        }

        // Initialize review
        document.addEventListener("DOMContentLoaded", () => {
            selectStudentReview(0);
            startTestimonialAutoPlay();
            
            // Pause autoplay on mouse enter
            const wrapper = document.getElementById('student-selectors');
            if (wrapper) {
                const container = wrapper.parentElement.parentElement;
                container.addEventListener('mouseenter', stopTestimonialAutoPlay);
                container.addEventListener('mouseleave', startTestimonialAutoPlay);
            }
        });



        // Elisa Hero Image Parallax (Mouse Move & Scroll effect)
        (function() {
            const hero = document.getElementById('hero-section');
            const elisa = document.getElementById('elisa-container');
            const elisaMobile = document.getElementById('elisa-container-mobile');
            
            if (!hero) return;
            
            let mouseX = 0, mouseY = 0;
            let targetX = 0, targetY = 0;
            let scrollY = window.scrollY;
            
            // Mousemove parallax for desktop
            hero.addEventListener('mousemove', (e) => {
                const rect = hero.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5; // -0.5 to 0.5
                const y = (e.clientY - rect.top) / rect.height - 0.5; // -0.5 to 0.5
                
                targetX = x * 35; // shift up to 35px left/right
                targetY = y * 15; // shift up to 15px up/down
            });
            
            hero.addEventListener('mouseleave', () => {
                targetX = 0;
                targetY = 0;
            });
            
            // Scroll tracking
            window.addEventListener('scroll', () => {
                scrollY = window.scrollY;
            }, { passive: true });
            
            // Smoothened Render Loop (Lerp)
            function render() {
                // Lerp for smooth pointer physics
                mouseX += (targetX - mouseX) * 0.08;
                mouseY += (targetY - mouseY) * 0.08;
                
                // Shift left/right with scroll (max shift 70px)
                const scrollOffset = Math.min(scrollY * 0.12, 70);
                
                // Desktop image shift: combine mousemove and scroll parallax
                if (elisa) {
                    elisa.style.transform = `translate3d(${mouseX - scrollOffset}px, ${mouseY}px, 0)`;
                }
                
                // Mobile image shift: scroll parallax only
                if (elisaMobile) {
                    elisaMobile.style.transform = `translate3d(${-scrollOffset}px, 0, 0)`;
                }
                
                requestAnimationFrame(render);
            }
            
            requestAnimationFrame(render);
        })();
    </script>
@endsection
