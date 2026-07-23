@extends('layouts.master')

@section('title', 'Learning Resources - Francoway')
@section('description', 'Download free French worksheets, PDF guides, and interactive preparation resources for DELF/DALF and language mastery.')

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
</style>
@endpush

@section('content')

    <!-- 1. HERO HEADER WITH WAVE CURVE -->
    <section class="relative bg-[#071530] text-white pt-24 pb-36 lg:pt-32 lg:pb-48 overflow-hidden z-10">
        <!-- Radial gradient background -->
        <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top_right,rgba(227,27,37,0.15),transparent_50%)]"></div>
        <!-- Background image overlay -->
        <div class="absolute inset-0 z-0 select-none pointer-events-none">
            <img src="{{ asset('assets/images/contact_header.jpg') }}" class="w-full h-full object-cover object-center opacity-25" alt="Learning Resources Banner">
        </div>
        <!-- Blackboard grid line texture -->
        <div class="absolute inset-0 z-0 opacity-10 bg-[linear-gradient(rgba(255,255,255,0.07)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.07)_1px,transparent_1px)] bg-[size:30px_30px]"></div>
        
        <!-- Slow moving blur orbits for premium aesthetic -->
        <div class="absolute top-[-20%] left-[-10%] w-96 h-96 bg-[#E31B23]/10 rounded-full blur-[80px] animate-blur-orbit pointer-events-none select-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#F8B803]/10 rounded-full blur-[80px] animate-blur-orbit-reverse pointer-events-none select-none"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 relative z-10 text-center">
            <!-- Breadcrumbs -->
            <nav class="text-white/60 text-[10px] md:text-xs font-heading font-black tracking-widest uppercase mb-4 flex items-center justify-center gap-2">
                <a href="{{ route('index') }}" class="hover:text-[#E31B23] transition-colors">Home</a>
                <span>/</span>
                <span class="hover:text-white transition-colors">Pages</span>
                <span>/</span>
                <span class="text-white font-bold">Resources</span>
            </nav>
            
            <!-- Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-heading font-black tracking-tight leading-tight max-w-4xl mx-auto">
                Learning Resources
            </h1>
            <p class="text-sm md:text-base text-gray-300 font-medium max-w-xl mx-auto mt-4 leading-relaxed">
                Empower your French learning journey with our free premium worksheets, study guides, exam preparation files, and grammar practice materials.
            </p>
        </div>

        <!-- Curved bottom boundary overlay (upward curve transition) -->
        <div class="absolute bottom-0 left-0 right-0 h-16 md:h-24 bg-[#F5F8FC] rounded-t-[3rem] lg:rounded-t-[5rem] z-20"></div>
    </section>

    <!-- 2. SEARCH & RESOURCES GRID SECTION -->
    <section class="py-16 bg-[#F5F8FC] relative z-20 -mt-10 min-h-[500px]">
        <div class="max-w-6xl mx-auto px-4 md:px-6">
            
            <!-- Section Header & Search Bar Row -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <!-- Heading Block (Left Side) -->
                <div class="space-y-3 text-left reveal-left">
                    <!-- Brand Red Tagline with single line -->
                    <div class="flex items-center gap-3 mb-1">
                        <span class="w-10 h-0.5 bg-[#E31B23]"></span>
                        <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">FREE MATERIALS</span>
                    </div>
                    <h2 class="section-title text-2xl md:text-3xl tracking-wider text-left leading-tight">
                        DOWNLOAD <span class="text-[#E31B23]">STUDY MATERIALS</span>
                    </h2>
                </div>
                
                <!-- Real-time search filter input (Right Side) -->
                <div class="w-full md:max-w-sm reveal-right">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            id="search-input" 
                            placeholder="Search resources..." 
                            class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-150 rounded-2xl text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 shadow-sm transition-all duration-300"
                        >
                    </div>
                </div>
            </div>

            <!-- Resources Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="resources-grid">
                @forelse($resources as $index => $resource)
                    <!-- Resource Card -->
                    <div class="resource-card bg-white rounded-[2.5rem] border border-gray-100 shadow-[0_15px_40px_rgba(11,30,67,0.03)] hover:shadow-[0_20px_50px_rgba(11,30,67,0.06)] hover:-translate-y-2 transition-all duration-500 flex flex-col overflow-hidden group reveal-bottom animate-fade-in" style="transition-delay: {{ ($index % 3) * 100 }}ms;">
                        <!-- Image Container with Zoom Effect -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-gray-50 border-b border-gray-50">
                            <img 
                                src="{{ asset('storage/' . $resource->image) }}" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                alt="{{ $resource->title }}"
                                onerror="this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&q=80&w=600'"
                            >
                            <span class="absolute top-4 left-4 inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-[#E31B23] font-bold text-[9px] uppercase tracking-wider shadow-sm">
                                ✦ Free PDF
                            </span>
                        </div>

                        <!-- Card Content -->
                        <div class="p-8 flex flex-col flex-grow text-left space-y-4">
                            <h3 class="font-heading font-bold text-xl text-[#0B1E43] leading-snug group-hover:text-[#E31B23] transition-colors duration-300">
                                {{ $resource->title }}
                            </h3>
                            <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 font-medium flex-grow">
                                {{ $resource->description }}
                            </p>
                            
                            <!-- Download Button -->
                            <div class="pt-2">
                                <a 
                                    href="{{ asset('storage/' . $resource->pdf) }}" 
                                    download 
                                    class="inline-flex items-center justify-center gap-2 w-full py-3.5 bg-[#0B1E43] hover:bg-[#E31B23] text-white font-extrabold text-xs uppercase tracking-widest rounded-full transition-all duration-300 shadow-md btn-pulse-blue"
                                >
                                    <svg class="w-4 h-4 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                    </svg>
                                    Download Resource
                                </a>
                            </div>
                        </div>
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
                            <h3 class="font-heading font-black text-2xl text-[#0B1E43]">No Resources Found</h3>
                            <p class="text-sm text-gray-500 font-medium leading-relaxed">
                                We are currently preparing top-tier learning resources for you. Check back soon for updates!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- JavaScript Real-time filter empty state helper -->
            <div id="no-search-results" class="hidden py-16 text-center max-w-md mx-auto space-y-4">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="font-heading font-black text-xl text-[#0B1E43]">No Matches Found</h3>
                <p class="text-sm text-gray-400 font-medium">Try checking your spelling or search for something else.</p>
            </div>
            
        </div>
    </section>

@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const searchInput = document.getElementById('search-input');
        const resourcesGrid = document.getElementById('resources-grid');
        const cards = resourcesGrid.getElementsByClassName('resource-card');
        const noResults = document.getElementById('no-search-results');

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                let visibleCount = 0;

                Array.from(cards).forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();

                    if (title.includes(query) || description.includes(query)) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visibleCount === 0 && cards.length > 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush
