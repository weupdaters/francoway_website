@extends('layouts.master')

@section('title', 'About Us - Francoway')
@section('description', 'Learn about our mission, flexible training modules, and expert French language tutors.')

@section('content')
    <!-- 1. SLATE HERO HEADER (ABOUT US 02 MATCH) -->
    <section class="relative bg-[#071530] text-white pt-24 pb-36 lg:pt-32 lg:pb-48 overflow-hidden z-10">
        <!-- Radial gradient background -->
        <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top_right,rgba(227,27,37,0.15),transparent_50%)]"></div>
        <!-- Background image overlay from user upload (Placed above solid colors to ensure visibility) -->
        <div class="absolute inset-0 z-0 select-none pointer-events-none">
            <img src="{{ asset('assets/images/about_header.png') }}" class="w-full h-full object-cover object-center opacity-35" alt="French Teacher Whiteboard">
        </div>
        <!-- Slate Blackboard grid line texture -->
        <div class="absolute inset-0 z-0 opacity-10 bg-[linear-gradient(rgba(255,255,255,0.07)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.07)_1px,transparent_1px)] bg-[size:30px_30px]"></div>
        
        <!-- Slow moving blur orbits for premium aesthetic -->
        <div class="absolute top-[-20%] left-[-10%] w-96 h-96 bg-[#E31B23]/10 rounded-full blur-[80px] animate-blur-orbit pointer-events-none select-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#F8B803]/10 rounded-full blur-[80px] animate-blur-orbit-reverse pointer-events-none select-none"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 relative z-10 text-center">
            <!-- Breadcrumbs -->
            <nav class="text-white/60 text-[10px] md:text-xs font-heading font-black tracking-widest uppercase mb-4 flex items-center justify-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-[#E31B23] transition-colors">Home</a>
                <span>/</span>
                <span class="hover:text-white transition-colors">Pages</span>
                <span>/</span>
                <span class="text-white font-bold">About Us 02</span>
            </nav>
            
            <!-- Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-heading font-black tracking-tight leading-tight max-w-4xl mx-auto">
                About Us
            </h1>
        </div>

        <!-- Curved bottom boundary overlay (upward curve transition) -->
        <div class="absolute bottom-0 left-0 right-0 h-16 md:h-24 bg-white rounded-t-[3rem] lg:rounded-t-[5rem] z-20"></div>
    </section>

    <!-- 2. INTRODUCTION & 2X2 FEATURES LIST (ABOUT US 02 ROW 1) -->
    <section class="pb-16 bg-white relative z-20 -mt-10">
        <div class="max-w-6xl mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left Column: Content -->
                <div class="lg:col-span-6 space-y-6 text-left reveal-left">
                    <!-- Brand Red Badge with single line -->
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-0.5 bg-[#E31B23]"></span>
                        <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">ABOUT US</span>
                    </div>

                    <!-- Heading -->
                    <h2 class="section-title text-2xl md:text-3xl tracking-wider text-left leading-[1.25]">
                        PROVIDING ONLINE CLASSES FOR <span class="text-[#E31B23]">REMOTE LEARNING</span>
                    </h2>

                    <!-- Description -->
                    <p class="text-sm md:text-base text-gray-555 font-medium leading-relaxed">
                        Online courses have revolutionized the way people learn by offering a wide range of educational resources, custom training tracks, and certification opportunities.
                    </p>

                    <!-- Pill CTA -->
                    <div class="pt-2">
                        <a href="{{ url('/#courses') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#0B1E43] hover:bg-[#E31B23] text-white font-extrabold text-xs uppercase tracking-widest rounded-full transition-all duration-300 shadow-md btn-pulse-blue">
                            More About &gt;
                        </a>
                    </div>
                </div>

                <!-- Right Column: 2x2 Feature Grid -->
                <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6 reveal-right">
                    
                    <!-- Feature 1 -->
                    <div class="flex gap-4 items-start p-6 rounded-2xl bg-[#0B1E43] border border-transparent hover:border-[#E31B23]/30 transition-all duration-300 group feature-box">
                        <div class="p-4 rounded-xl bg-white/10 border border-white/5 text-white shrink-0 transition-all duration-300 feature-icon-box">
                            <!-- Teacher SVG -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-black text-white text-base leading-tight transition-colors duration-300 feature-title">Professional Tutors</h4>
                            <p class="text-xs text-white/70 font-medium leading-relaxed">Free & Premium online courses from the world's best 17 million learners.</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex gap-4 items-start p-6 rounded-2xl bg-[#0B1E43] border border-transparent hover:border-[#E31B23]/30 transition-all duration-300 group feature-box">
                        <div class="p-4 rounded-xl bg-white/10 border border-white/5 text-white shrink-0 transition-all duration-300 feature-icon-box">
                            <!-- Courses Board SVG -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-black text-white text-base leading-tight transition-colors duration-300 feature-title">80+ Online Courses</h4>
                            <p class="text-xs text-white/70 font-medium leading-relaxed">Free & Premium online courses from the world's best 17 million learners.</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex gap-4 items-start p-6 rounded-2xl bg-[#0B1E43] border border-transparent hover:border-[#E31B23]/30 transition-all duration-300 group feature-box">
                        <div class="p-4 rounded-xl bg-white/10 border border-white/5 text-white shrink-0 transition-all duration-300 feature-icon-box">
                            <!-- Shield/badge SVG -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-black text-white text-base leading-tight transition-colors duration-300 feature-title">Top Instructors</h4>
                            <p class="text-xs text-white/70 font-medium leading-relaxed">Free & Premium online courses from the world's best 17 million learners.</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex gap-4 items-start p-6 rounded-2xl bg-[#0B1E43] border border-transparent hover:border-[#E31B23]/30 transition-all duration-300 group feature-box">
                        <div class="p-4 rounded-xl bg-white/10 border border-white/5 text-white shrink-0 transition-all duration-300 feature-icon-box">
                            <!-- Cap/Graduation SVG -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-black text-white text-base leading-tight transition-colors duration-300 feature-title">Educator help</h4>
                            <p class="text-xs text-white/70 font-medium leading-relaxed">Free & Premium online courses from the world's best 17 million learners.</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- 3. THREE CARDS NAVIGATION ROW (ABOUT US 02 ROW 2) -->
    <section class="py-12 bg-[#F5F8FC]">
        <div class="max-w-6xl mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1 -->
                <div class="bg-white rounded-3xl border border-gray-100 flex items-stretch h-36 overflow-hidden shadow-sm group hover:-translate-y-1.5 hover:shadow-md transition-all duration-300 reveal-bottom reveal-delay-100">
                    <div class="w-[55%] p-6 flex flex-col justify-between items-start text-left">
                        <h3 class="text-base sm:text-lg font-black text-[#0B1E43] leading-tight">Our expertise</h3>
                        <a href="{{ url('/#courses') }}" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-red-50 text-gray-400 hover:text-[#E31B23] transition-all duration-300 transform group-hover:translate-x-1 group-hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                            </svg>
                        </a>
                    </div>
                    <div class="w-[45%] h-full relative overflow-hidden shrink-0">
                        <img src="{{ asset('assets/images/choose_teachers.png') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="Teachers">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-3xl border border-gray-100 flex items-stretch h-36 overflow-hidden shadow-sm group hover:-translate-y-1.5 hover:shadow-md transition-all duration-300 reveal-bottom reveal-delay-200">
                    <div class="w-[55%] p-6 flex flex-col justify-between items-start text-left">
                        <h3 class="text-base sm:text-lg font-black text-[#0B1E43] leading-tight">Know more About us</h3>
                        <a href="{{ url('/#about') }}" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-red-50 text-gray-400 hover:text-[#E31B23] transition-all duration-300 transform group-hover:translate-x-1 group-hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                            </svg>
                        </a>
                    </div>
                    <div class="w-[45%] h-full relative overflow-hidden shrink-0">
                        <img src="{{ asset('assets/images/choose_experienced.png') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="Experience">
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-3xl border border-gray-100 flex items-stretch h-36 overflow-hidden shadow-sm group hover:-translate-y-1.5 hover:shadow-md transition-all duration-300 reveal-bottom reveal-delay-300">
                    <div class="w-[55%] p-6 flex flex-col justify-between items-start text-left">
                        <h3 class="text-base sm:text-lg font-black text-[#0B1E43] leading-tight">How can we help?</h3>
                        <a href="{{ url('/#enquire') }}" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-red-50 text-gray-400 hover:text-[#E31B23] transition-all duration-300 transform group-hover:translate-x-1 group-hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                            </svg>
                        </a>
                    </div>
                    <div class="w-[45%] h-full relative overflow-hidden shrink-0">
                        <img src="{{ asset('assets/images/choose_community.png') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="Community">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. SKILLS DEVELOPMENT (ABOUT US 02 CAPSULE CARDS GRID) -->
    <section class="py-16 md:py-24 bg-white relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 md:px-6 relative z-10 text-center">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="flex items-center justify-center gap-4 mb-2.5">
                    <span class="w-[60px] h-0.5 bg-gradient-to-r from-transparent to-[#E31B23] shrink-0"></span>
                    <h2 class="section-title text-2xl md:text-3xl shrink-0 tracking-wider">
                        BUILD BETTER <span class="text-[#E31B23]">SKILLS, FASTER</span>
                    </h2>
                    <span class="w-[60px] h-0.5 bg-gradient-to-l from-transparent to-[#E31B23] shrink-0"></span>
                </div>
                <p class="section-subtitle text-xs md:text-sm font-medium tracking-wide leading-relaxed text-center">
                    Explore new skills, deepen existing passions, and get lost in creativity. What you find just might surprise and inspire you.
                </p>
            </div>

            <!-- 4 Capsule Steps Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                
                <!-- Step 1 -->
                <div class="border border-gray-150 rounded-[7.5rem] p-8 flex flex-col items-center justify-start gap-6 text-center bg-white shadow-[0_8px_30px_rgba(0,0,0,0.015)] min-h-[350px] transition-all duration-400 group hover:-translate-y-2 hover:shadow-lg reveal-bottom reveal-delay-100">
                    <div class="relative w-24 h-24 rounded-full bg-[#E8EBFC] flex items-center justify-center shrink-0">
                        <!-- Step Badge with white border outline from screenshot -->
                        <span class="absolute top-0.5 left-0.5 w-7 h-7 rounded-full bg-[#3D5EE1] text-white font-extrabold text-xs flex items-center justify-center border-2 border-white z-20">01</span>
                        <!-- Target/Dart Icon -->
                        <svg class="w-10 h-10 text-[#0B1E43]/70 group-hover:text-[#3D5EE1] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="2" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="space-y-3">
                        <h4 class="font-black text-[#0B1E43] text-lg sm:text-xl leading-tight">Learn the latest skills</h4>
                        <p class="text-xs sm:text-sm text-gray-400 font-medium leading-relaxed max-w-[180px] mx-auto">Holds in these matters principles all selection right rejects.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="border border-gray-150 rounded-[7.5rem] p-8 flex flex-col items-center justify-start gap-6 text-center bg-white shadow-[0_8px_30px_rgba(0,0,0,0.015)] min-h-[350px] transition-all duration-400 group hover:-translate-y-2 hover:shadow-lg reveal-bottom reveal-delay-200">
                    <div class="relative w-24 h-24 rounded-full bg-[#E8EBFC] flex items-center justify-center shrink-0">
                        <!-- Step Badge -->
                        <span class="absolute top-0.5 left-0.5 w-7 h-7 rounded-full bg-[#3D5EE1] text-white font-extrabold text-xs flex items-center justify-center border-2 border-white z-20">02</span>
                        <!-- Users Icon -->
                        <svg class="w-10 h-10 text-[#0B1E43]/70 group-hover:text-[#3D5EE1] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        <h4 class="font-black text-[#0B1E43] text-lg sm:text-xl leading-tight">Get ready for a career</h4>
                        <p class="text-xs sm:text-sm text-gray-400 font-medium leading-relaxed max-w-[180px] mx-auto">Frequently occur that's pleasures in have to repudiated.</p>
                    </div>
                </div>

                <!-- Step 3 (Highlighted/Active Card matching screenshot border style) -->
                <div class="border-2 border-[#3D5EE1] rounded-[7.5rem] p-8 flex flex-col items-center justify-start gap-6 text-center bg-white shadow-[0_12px_35px_rgba(61,94,225,0.08)] min-h-[350px] transition-all duration-400 group hover:-translate-y-2 reveal-bottom reveal-delay-300">
                    <div class="relative w-24 h-24 rounded-full bg-[#E8EBFC] flex items-center justify-center shrink-0">
                        <!-- Step Badge -->
                        <span class="absolute top-0.5 left-0.5 w-7 h-7 rounded-full bg-[#3D5EE1] text-white font-extrabold text-xs flex items-center justify-center border-2 border-white z-20">03</span>
                        <!-- Graduation cap Icon -->
                        <svg class="w-10 h-10 text-[#3D5EE1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        <h4 class="font-black text-[#0B1E43] text-lg sm:text-xl leading-tight">Earn a Certificate</h4>
                        <p class="text-xs sm:text-sm text-gray-400 font-medium leading-relaxed max-w-[180px] mx-auto">Fault with man who choose enjoy a annoying consequences.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="border border-gray-150 rounded-[7.5rem] p-8 flex flex-col items-center justify-start gap-6 text-center bg-white shadow-[0_8px_30px_rgba(0,0,0,0.015)] min-h-[350px] transition-all duration-400 group hover:-translate-y-2 hover:shadow-lg reveal-bottom reveal-delay-400">
                    <div class="relative w-24 h-24 rounded-full bg-[#E8EBFC] flex items-center justify-center shrink-0">
                        <!-- Step Badge -->
                        <span class="absolute top-0.5 left-0.5 w-7 h-7 rounded-full bg-[#3D5EE1] text-white font-extrabold text-xs flex items-center justify-center border-2 border-white z-20">04</span>
                        <!-- Building/Briefcase Icon -->
                        <svg class="w-10 h-10 text-[#0B1E43]/70 group-hover:text-[#3D5EE1] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        <h4 class="font-black text-[#0B1E43] text-lg sm:text-xl leading-tight">Upskill organization</h4>
                        <p class="text-xs sm:text-sm text-gray-400 font-medium leading-relaxed max-w-[180px] mx-auto">Holds in these matters principles all selection right rejects.</p>
                    </div>
                </div>

            </div>

            <!-- Pill CTA -->
            <div class="pt-4">
                <a href="{{ url('/#courses') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#E31B23] hover:bg-[#0B1E43] text-white font-extrabold text-xs uppercase tracking-widest rounded-full transition-all duration-300 shadow-md btn-pulse-red">
                    Browse More Courses &gt;
                </a>
            </div>

        </div>
    </section>

    <!-- 5. PORTRAIT TEACHERS GRID (ABOUT US 02 ROW 3) -->
    <section class="py-20 md:py-28 bg-[#F5F8FC] overflow-hidden relative">
        <!-- Sparkle decoration from screenshot -->
        <div class="absolute top-12 left-10 md:left-24 opacity-20 hidden sm:block pointer-events-none">
            <svg class="w-16 h-16 text-[#3D5EE1]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0l3.09 8.91L24 12l-8.91 3.09L12 24l-3.09-8.91L0 12l8.91-3.09z"/>
            </svg>
        </div>
        <div class="absolute top-28 left-20 opacity-10 hidden sm:block pointer-events-none">
            <svg class="w-8 h-8 text-[#3D5EE1]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0l3.09 8.91L24 12l-8.91 3.09L12 24l-3.09-8.91L0 12l8.91-3.09z"/>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-4 md:px-6 relative z-10 text-center">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="flex items-center justify-center gap-4 mb-2.5">
                    <span class="w-[60px] h-0.5 bg-gradient-to-r from-transparent to-[#E31B23] shrink-0"></span>
                    <h2 class="section-title text-2xl md:text-3xl shrink-0 tracking-wider">
                        MEET OUR <span class="text-[#E31B23]">QUALIFIED TEACHERS</span>
                    </h2>
                    <span class="w-[60px] h-0.5 bg-gradient-to-l from-transparent to-[#E31B23] shrink-0"></span>
                </div>
                <p class="section-subtitle text-xs md:text-sm font-medium tracking-wide leading-relaxed text-center">
                    Choose the best contents out of greatest instructors available online. Choose from the elites.
                </p>
            </div>

            <!-- 4 Column Teacher Grid with Staggered Alignment -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:pb-12 text-center items-start">
                
                <!-- Teacher 1: Richard Divas -->
                <div class="group relative rounded-tl-[4.5rem] rounded-br-[4.5rem] rounded-tr-[1.5rem] rounded-bl-[1.5rem] overflow-hidden aspect-[3/4] shadow-[0_10px_30px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-500 hover:-translate-y-2 reveal-bottom reveal-delay-100">
                    <img src="{{ asset('assets/images/student1.png') }}" alt="Richard Divas" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <!-- Glassmorphic Inset overlay -->
                    <div class="absolute bottom-4 left-4 right-4 bg-white/20 backdrop-blur-md rounded-2xl p-4 text-left border border-white/20 shadow-sm transition-all duration-300 group-hover:bg-white/35">
                        <h4 class="font-extrabold text-white text-base leading-tight">Richard Divas</h4>
                        <p class="text-xs text-white/80 font-medium mt-0.5">Business Advisor</p>
                    </div>
                </div>

                <!-- Teacher 2: Alex Jason (Staggered Column - md:mt-8) -->
                <div class="group relative rounded-tr-[4.5rem] rounded-bl-[4.5rem] rounded-tl-[1.5rem] rounded-br-[1.5rem] overflow-hidden aspect-[3/4] shadow-[0_10px_30px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-500 hover:-translate-y-2 md:mt-8 reveal-bottom reveal-delay-200">
                    <img src="{{ asset('assets/images/student2.png') }}" alt="Alex Jason" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/20 backdrop-blur-md rounded-2xl p-4 text-left border border-white/20 shadow-sm transition-all duration-300 group-hover:bg-white/35">
                        <h4 class="font-extrabold text-white text-base leading-tight">Alex Jason</h4>
                        <p class="text-xs text-white/80 font-medium mt-0.5">Finance Consultant</p>
                    </div>
                </div>

                <!-- Teacher 3: Jin Steven -->
                <div class="group relative rounded-tl-[4.5rem] rounded-br-[4.5rem] rounded-tr-[1.5rem] rounded-bl-[1.5rem] overflow-hidden aspect-[3/4] shadow-[0_10px_30px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-500 hover:-translate-y-2 reveal-bottom reveal-delay-300">
                    <img src="{{ asset('assets/images/student3.png') }}" alt="Jin Steven" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/20 backdrop-blur-md rounded-2xl p-4 text-left border border-white/20 shadow-sm transition-all duration-300 group-hover:bg-white/35">
                        <h4 class="font-extrabold text-white text-base leading-tight">Jin Steven</h4>
                        <p class="text-xs text-white/80 font-medium mt-0.5">Product Manager</p>
                    </div>
                </div>

                <!-- Teacher 4: Mona Zaghloul (Staggered Column - md:mt-8) -->
                <div class="group relative rounded-tr-[4.5rem] rounded-bl-[4.5rem] rounded-tl-[1.5rem] rounded-br-[1.5rem] overflow-hidden aspect-[3/4] shadow-[0_10px_30px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-500 hover:-translate-y-2 md:mt-8 reveal-bottom reveal-delay-400">
                    <img src="{{ asset('assets/images/student4.png') }}" alt="Mona Zaghloul" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/20 backdrop-blur-md rounded-2xl p-4 text-left border border-white/20 shadow-sm transition-all duration-300 group-hover:bg-white/35">
                        <h4 class="font-extrabold text-white text-base leading-tight">Mona Zaghloul</h4>
                        <p class="text-xs text-white/80 font-medium mt-0.5">Assistant Director</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. PARTNER LOGOS ROW (ABOUT US 02 BOTTOM ROW) -->
    <section class="py-12 bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-4 md:px-6 text-center space-y-6">
            <!-- Grid of 6 client logos (grayscale transparent badges) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-8 items-center justify-center opacity-65">
                
                <!-- Logo 1 -->
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer">
                    <span class="font-black text-lg md:text-xl text-[#0B1E43] tracking-widest font-heading">SMART <span class="text-[#E31B23]">EDU</span></span>
                </div>

                <!-- Logo 2 -->
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer">
                    <span class="font-black text-lg md:text-xl text-[#0B1E43] tracking-widest font-heading">TECH <span class="text-[#E31B23]">LEARN</span></span>
                </div>

                <!-- Logo 3 -->
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer">
                    <span class="font-black text-lg md:text-xl text-[#0B1E43] tracking-widest font-heading">DIGITAL <span class="text-[#E31B23]">HUB</span></span>
                </div>

                <!-- Logo 4 -->
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer">
                    <span class="font-black text-lg md:text-xl text-[#0B1E43] tracking-widest font-heading">MET <span class="text-[#E31B23]">LIFE</span></span>
                </div>

                <!-- Logo 5 -->
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer">
                    <span class="font-black text-lg md:text-xl text-[#0B1E43] tracking-widest font-heading">EDU <span class="text-[#E31B23]">ZONE</span></span>
                </div>

                <!-- Logo 6 -->
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer">
                    <span class="font-black text-lg md:text-xl text-[#0B1E43] tracking-widest font-heading">GLOBAL <span class="text-[#E31B23]">NET</span></span>
                </div>

            </div>

            <!-- Subtitle -->
            <p class="text-xs font-semibold text-gray-400 tracking-wider pt-2">
                We are worked with over 10+ projects with global clients
            </p>
        </div>
    </section>
@push('css')
<style>
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

    /* 1. FEATURES LIST GROUP HOVERS */
    .feature-box {
        border-left: 3px solid transparent !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background-color: #0B1E43 !important;
    }
    .feature-box:hover {
        border-left-color: #E31B23 !important;
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(11, 30, 67, 0.25);
    }
    .feature-box .feature-icon-box {
        background-color: rgba(255, 255, 255, 0.1) !important;
        border-color: rgba(255, 255, 255, 0.05) !important;
        color: #ffffff !important;
    }
    .feature-box:hover .feature-icon-box {
        background-color: #E31B23 !important;
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(227, 27, 35, 0.25);
    }
    .feature-box:hover .feature-title {
        color: #E31B23 !important;
    }
    
    /* 2. THREE CARDS NAVIGATION ROW HOVERS */
    .group:hover img {
        transform: scale(1.1) rotate(1deg);
    }
    .group:hover a {
        color: #E31B23 !important;
        transform: translateX(4px);
    }
    .group a {
        transition: all 0.3s ease-in-out;
    }

    /* 3. PROCESS CIRCLES STEPS DYNAMIC HOVERS */
    .group:hover .w-24 {
        box-shadow: 0 10px 25px rgba(61, 94, 225, 0.15);
        border-color: rgba(61, 94, 225, 0.3) !important;
        transform: scale(1.05);
    }
    .group:hover .absolute.top-0.5 {
        transform: translateY(-3px) scale(1.08);
    }
    .group .w-24, .group .absolute.top-0.5 {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }



    /* 5. BRAND LOGOS EXPANSION */
    .grayscale {
        transition: all 0.35s ease-in-out;
    }
    .grayscale:hover {
        transform: scale(1.08);
    }
</style>
@endpush
@endsection
