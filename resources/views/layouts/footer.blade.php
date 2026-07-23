@php
    $footerCourses = \App\Models\Course::where('status', 'published')->latest()->limit(6)->get();
@endphp
<!-- 9. FOOTER -->
<footer class="bg-[#040E20] text-white pt-16 pb-8 border-t border-white/5 relative overflow-hidden">
    <!-- Footer Content Grid -->
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12 relative z-20">
        
        <!-- Col 1: About/Branding -->
        <div class="space-y-4">
            <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('assets/images/logo.png') }}" alt="{{ $settings['site_name'] ?? 'Francoway' }} Logo" class="h-20 w-auto object-contain bg-white rounded-xl px-4 py-2 shadow-md">
            <p class="text-sm text-gray-400 leading-relaxed pt-2">
                {{ $settings['footer_text'] ?? 'Empowering dreams through quality education & language skills for a better tomorrow.' }}
            </p>
            <div class="flex gap-4 pt-2 text-gray-400">
                @if(isset($settings['facebook']) && $settings['facebook'])
                    <a href="{{ $settings['facebook'] }}" target="_blank" class="hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                @endif
                @if(isset($settings['instagram']) && $settings['instagram'])
                    <a href="{{ $settings['instagram'] }}" target="_blank" class="hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                @endif
                @if(isset($settings['twitter']) && $settings['twitter'])
                    <a href="{{ $settings['twitter'] }}" target="_blank" class="hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                @endif
                @if(isset($settings['linkedin']) && $settings['linkedin'])
                    <a href="{{ $settings['linkedin'] }}" target="_blank" class="hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Col 2: Courses links -->
        <div class="space-y-4">
            <h3 class="font-bold text-lg border-l-2 border-red-500 pl-3">Explore Courses</h3>
            <ul class="space-y-2 text-sm text-gray-400">
                @forelse($footerCourses as $fc)
                    <li><a href="{{ route('courses.show', $fc->id) }}" class="hover:text-red-500 hover:underline transition-all">{{ $fc->title }}</a></li>
                @empty
                    <li><a href="{{ route('courses.index') }}" class="hover:text-red-500 hover:underline transition-all">French A1 - Beginner</a></li>
                    <li><a href="{{ route('courses.index') }}" class="hover:text-red-500 hover:underline transition-all">French A2 - Elementary</a></li>
                    <li><a href="{{ route('courses.index') }}" class="hover:text-red-500 hover:underline transition-all">French B1 - Intermediate</a></li>
                @endforelse
            </ul>
        </div>

        <!-- Col 3: Quick Links -->
        <div class="space-y-4">
            <h3 class="font-bold text-lg border-l-2 border-red-500 pl-3">Quick Links</h3>
            <ul class="space-y-2 text-sm text-gray-400">
                <li><a href="{{ route('index') }}" class="hover:text-red-500 hover:underline transition-all">Home</a></li>
                <li><a href="{{ route('about.index') }}" class="hover:text-red-500 hover:underline transition-all">About Us</a></li>
                <li><a href="{{ route('courses.index') }}" class="hover:text-red-500 hover:underline transition-all">Courses</a></li>
                <li><a href="{{ route('resources') }}" class="hover:text-red-500 hover:underline transition-all">Resources</a></li>
                <li><a href="{{ route('contactUs') }}" class="hover:text-red-500 hover:underline transition-all">Contact Us</a></li>
            </ul>
        </div>

        <!-- Col 4: Contact Us -->
        <div class="space-y-4 relative z-30">
            <h3 class="font-bold text-lg border-l-2 border-red-500 pl-3">Contact Us</h3>
            <ul class="space-y-3 text-sm text-gray-400">
                <li class="flex items-start gap-2.5">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>{{ $settings['site_phone'] ?? '+91 98765-43210' }}</span>
                </li>
                <li class="flex items-start gap-2.5">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <a href="mailto:{{ $settings['site_email'] ?? 'info@francoway.com' }}" class="hover:text-red-500 hover:underline">{{ $settings['site_email'] ?? 'info@francoway.com' }}</a>
                </li>
                <li class="flex items-start gap-2.5">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $settings['address'] ?? 'Education Tree Academy, Patiala, Punjab' }}</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Faint Eiffel Tower/Skyline sketch in footer -->
    <div class="absolute bottom-0 right-0 h-64 md:h-80 opacity-15 pointer-events-none z-10">
        <img src="{{ asset('assets/images/footer_sketch.png') }}" alt="Paris Skyline Sketch" class="h-full w-auto object-contain object-right-bottom">
    </div>

    <!-- Bottom Line -->
    <div class="max-w-7xl mx-auto px-4 mt-16 pt-8 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500 gap-4 relative z-20">
        <span>© {{ date('Y') }} {{ $settings['site_name'] ?? 'Francoway' }} (Education Tree Academy). All Rights Reserved.</span>
        <div class="flex gap-4">
            <a href="{{ route('privacy.policy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
            <span>|</span>
            <a href="{{ route('terms.conditions') }}" class="hover:text-white transition-colors">Terms & Conditions</a>
        </div>
    </div>
</footer>