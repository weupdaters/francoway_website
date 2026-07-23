@extends('layouts.master')

@section('title', 'French Courses - Francoway')
@section('description', 'Explore our premium CEFR-aligned French language courses from A1 Beginner to C1 Advanced and DELF/DALF prep.')

@section('content')

    <!-- 1. HERO HEADER WITH WAVE CURVE (INSPIRED BY ATTACHED IMAGE) -->
    <section class="relative bg-[#071530] text-white pt-24 pb-36 lg:pt-32 lg:pb-48 overflow-hidden z-10">
        <!-- Radial gradient background -->
        <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top_right,rgba(227,27,37,0.15),transparent_50%)]"></div>
        <!-- Background image overlay -->
        <div class="absolute inset-0 z-0 select-none pointer-events-none">
            <img src="{{ asset('assets/images/contact_header.jpg') }}" class="w-full h-full object-cover object-center opacity-20" alt="Courses Header">
        </div>
        <!-- Blackboard grid line texture -->
        <div class="absolute inset-0 z-0 opacity-10 bg-[linear-gradient(rgba(255,255,255,0.07)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.07)_1px,transparent_1px)] bg-[size:30px_30px]"></div>
        
        <!-- Slow moving blur orbits -->
        <div class="absolute top-[-20%] left-[-10%] w-96 h-96 bg-[#E31B23]/10 rounded-full blur-[80px] animate-blur-orbit pointer-events-none select-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#F8B803]/10 rounded-full blur-[80px] animate-blur-orbit-reverse pointer-events-none select-none"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 relative z-10 text-center space-y-4">
            <!-- Breadcrumbs in pill shape badge (matching image style) -->
            <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/10 text-white font-semibold text-xs tracking-wider uppercase">
                <a href="{{ route('index') }}" class="hover:text-[#E31B23] transition-colors">Home</a>
                <span class="text-white/40">➔</span>
                <span class="text-[#F8B803]">Courses</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-heading font-black tracking-tight leading-tight max-w-4xl mx-auto">
                Our Courses & Programs
            </h1>
            <p class="text-sm md:text-base text-gray-300 font-medium max-w-xl mx-auto leading-relaxed">
                Choose from our CEFR-aligned modules from Beginner to Advanced levels, taught by expert instructors.
            </p>
        </div>

        <!-- Wave bottom curve transition to white section -->
        <div class="absolute bottom-0 left-0 right-0 h-16 md:h-24 bg-[#FFFDF9] rounded-t-[3rem] lg:rounded-t-[5rem] z-20"></div>
    </section>

    <!-- 2. COURSES MAIN CONTENT SECTION (SIDEBAR + GRID LAYOUT AS SHOWN IN SCREENSHOT) -->
    <section class="py-16 bg-[#FFFDF9] relative z-20 -mt-10 min-h-[500px]">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- LEFT SIDEBAR: COURSE LIST (EXACT LAYOUT MATCH) -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-[2rem] border border-gray-150 shadow-[0_15px_40px_rgba(11,30,67,0.03)] p-6 md:p-8 space-y-6 sticky top-28">
                        <div class="text-left pb-3 border-b border-gray-100">
                            <h3 class="font-heading font-black text-xl text-[#0B1E43] tracking-tight">Our Courses</h3>
                            <div class="w-12 h-1 bg-[#E31B23] mt-2 rounded-full"></div>
                        </div>

                        <!-- Sidebar Navigation Menu -->
                        <div class="flex flex-col gap-2" id="sidebar-filter-list">
                            <!-- All Courses Button -->
                            <button 
                                onclick="filterCourses('all', this)"
                                class="w-full text-left px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-300 bg-[#E31B23] text-white shadow-md shadow-red-600/10 hover:shadow-lg filter-btn"
                            >
                                All Courses
                            </button>

                            @foreach($courses as $course)
                                <!-- Individual Course Button -->
                                <button 
                                    onclick="filterCourses('course-{{ $course->id }}', this)"
                                    class="w-full text-left px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-300 text-gray-600 hover:text-[#E31B23] hover:bg-gray-50 border border-transparent hover:border-gray-100 filter-btn"
                                >
                                    {{ $course->title }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-9">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="courses-grid-container">
                        @forelse($courses as $index => $course)
                            <!-- Redesigned Course Card (Inspired by image) -->
                            <div 
                                data-id="course-{{ $course->id }}"
                                class="course-card-item group relative rounded-[2rem] bg-gradient-to-b from-[#FFFDF9] to-[#FFF5E6] border border-[#F8B803]/40 hover:border-[#E31B23]/50 shadow-[0_12px_35px_rgba(248,184,3,0.06)] hover:shadow-[0_20px_50px_rgba(227,27,35,0.12)] hover:-translate-y-1.5 transition-all duration-500 overflow-hidden flex flex-col justify-between min-h-[400px] reveal-bottom" 
                                style="transition-delay: {{ ($index % 3) * 100 }}ms;"
                            >
                                
                                <!-- Top Corner Decorative Icons (Star patterns matching the image style) -->
                                <div class="absolute top-3.5 left-3.5 text-[#F8B803]/40 group-hover:text-[#E31B23]/40 transition-colors pointer-events-none">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0l3 9 9 3-9 3-3 9-3-9-9-3 9-3z"/>
                                    </svg>
                                </div>
                                <div class="absolute top-3.5 right-3.5 text-[#F8B803]/40 group-hover:text-[#E31B23]/40 transition-colors pointer-events-none">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0l3 9 9 3-9 3-3 9-3-9-9-3 9-3z"/>
                                    </svg>
                                </div>

                                <!-- Card Body & Image -->
                                <div class="p-4 md:p-5 flex flex-col flex-grow space-y-4">
                                    
                                    <!-- Arched Image Container (Visual Idea from the Dome/Arch Frames in the Image!) -->
                                    <div class="relative w-full aspect-[16/11] rounded-t-[2.2rem] rounded-b-[0.75rem] border-[3px] border-white shadow-md overflow-hidden bg-gray-50">
                                        <img 
                                            src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&q=80&w=600' }}" 
                                            alt="{{ $course->title }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                            onerror="this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&q=80&w=600'"
                                        >
                                        <!-- Price Badge floating on image -->
                                        <span class="absolute bottom-3 right-3 bg-[#0B1E43] text-[#F8B803] font-bold text-[10px] px-2.5 py-1 rounded-full border border-[#F8B803]/30 shadow-md">
                                            Price: ₹{{ $course->price }}
                                        </span>
                                    </div>

                                    <!-- Course Info Details -->
                                    <div class="space-y-2 flex-grow text-center">
                                        <!-- Category & Meta -->
                                        <div class="flex items-center justify-center gap-3.5 text-[10px] font-semibold text-gray-555 uppercase tracking-wider">
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-layer-group text-[#E31B23]"></i>
                                                {{ $course->category }}
                                            </span>
                                            <span class="text-gray-300">|</span>
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-book-open text-[#0B1E43]"></i>
                                                {{ count($course->lessons) }} Lessons
                                            </span>
                                        </div>

                                        <!-- Summary Description -->
                                        <p class="text-xs text-gray-500 leading-relaxed font-medium line-clamp-2">
                                            {{ $course->description ?? 'Learn French speaking, listening, grammar, and pronunciation with our native certified experts.' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Bottom Solid Title Banner (Exact Visual Match to the Red Bands at the Bottom of Cards in the Image) -->
                                <a 
                                    href="{{ route('courses.show', $course->id) }}"
                                    class="w-full bg-[#E31B23] group-hover:bg-[#0B1E43] text-white py-3 px-4 md:px-5 flex justify-between items-center transition-all duration-300 shadow-inner mt-auto"
                                >
                                    <span class="font-heading font-bold text-sm md:text-base tracking-wide truncate pr-2">
                                        {{ $course->title }}
                                    </span>
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-white/20 text-white shrink-0 group-hover:translate-x-1 transition-transform duration-300 text-xs">
                                        ➔
                                    </span>
                                </a>

                            </div>
                        @empty
                            <!-- Empty State -->
                            <div class="col-span-full py-16 text-center max-w-md mx-auto space-y-6">
                                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto text-[#0B1E43] opacity-80">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="space-y-2">
                                    <h3 class="font-heading font-black text-2xl text-[#0B1E43]">No Courses Found</h3>
                                    <p class="text-sm text-gray-555 font-medium leading-relaxed">
                                        We are currently preparing premium French courses. Please check back later.
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination Links -->
                    @if ($courses->hasPages())
                        <div class="mt-16 flex justify-center">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>

            </div>
            
        </div>
    </section>

@endsection

@push('js')
<script>
    function filterCourses(courseId, btn) {
        // Update active class on sidebar buttons
        const buttons = document.querySelectorAll('#sidebar-filter-list .filter-btn');
        buttons.forEach(b => {
            b.classList.remove('bg-[#E31B23]', 'text-white', 'shadow-md', 'shadow-red-600/10');
            b.classList.add('text-gray-600', 'hover:text-[#E31B23]', 'hover:bg-gray-50');
        });
        
        btn.classList.add('bg-[#E31B23]', 'text-white', 'shadow-md', 'shadow-red-600/10');
        btn.classList.remove('text-gray-600', 'hover:text-[#E31B23]', 'hover:bg-gray-50');

        // Filter the grid items
        const cards = document.querySelectorAll('#courses-grid-container .course-card-item');
        cards.forEach(card => {
            if (courseId === 'all') {
                card.style.display = '';
            } else {
                if (card.getAttribute('data-id') === courseId) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }
</script>
@endpush
