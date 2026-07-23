@extends('layouts.master')
@section('title', 'Contact Us - Francoway')
@section('content')

    <!-- 1. HERO BANNER WITH PARIS WATERMARK -->
    <section class="relative bg-[#0B1E43] pt-32 pb-48 overflow-hidden">
        <!-- Background Banner Image with Eiffel Tower & French Flag -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/contact_header.jpg') }}" class="w-full h-full object-cover opacity-95" alt="Paris Banner">
            <!-- Subtle overlay only for text legibility, no heavy color blur -->
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
        <!-- Absolute Decorative Cloud Curve Bottom -->
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-white z-10 pointer-events-none rounded-t-[3rem] md:rounded-t-[4rem]"></div>

        <div class="max-w-6xl mx-auto px-4 md:px-6 relative z-10 text-center text-white space-y-4">
            <!-- Breadcrumbs -->
            <nav class="text-xs md:text-sm font-semibold tracking-wider text-gray-300">
                <a href="{{ route('index') }}" class="hover:text-white transition-colors">Home</a>
                <span class="mx-2">/</span>
                <span class="text-gray-400">Pages</span>
                <span class="mx-2">/</span>
                <span class="text-[#E31B23] font-bold">Contact Us</span>
            </nav>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-heading font-black tracking-tight leading-tight">
                Contact Us
            </h1>
            <div class="w-12 h-1 bg-[#E31B23] mx-auto rounded-full mt-2"></div>
        </div>
    </section>

    <!-- 2. CONTACT US FORM CONTAINER (GET IN TOUCH PANEL) -->
    <section class="relative z-20 -mt-36 max-w-6xl mx-auto px-4 md:px-6 pb-20">
        <!-- Main Form Wrapper Card -->
        <div class="bg-white rounded-[3rem] shadow-[0_15px_50px_rgba(11,30,67,0.05)] border border-gray-100 p-8 md:p-14 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Side: Form Details -->
            <div class="lg:col-span-7 space-y-6 reveal-left">
                <!-- Badge -->
                <div>
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-red-50 border border-red-100 text-[#E31B23] font-bold text-[10px] sm:text-xs uppercase tracking-widest">
                        ✦ CONTACT US
                    </span>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-heading font-black text-[#0B1E43] tracking-tight">
                    Get In <span class="text-[#E31B23]">Touch</span>
                </h2>
                <p class="text-sm text-gray-500 font-medium leading-relaxed max-w-xl">
                    We'd love to hear from you! Fill out the form and our team will get back to you shortly.
                </p>                 <!-- Form Fields -->
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-50 rounded-2xl border border-green-200" role="alert">
                        <span class="font-bold">Success!</span> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5 pt-4">
                    @csrf
                    <!-- 2x2 Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Name Field -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="name" placeholder="Your Name *" required class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all duration-300">
                        </div>

                        <!-- Email Field -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" name="email" placeholder="Email Address *" required class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all duration-300">
                        </div>

                        <!-- Subject Field -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Subject" class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all duration-300">
                        </div>

                        <!-- Phone Field -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Phone Number" class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all duration-300">
                        </div>

                    </div>

                    <!-- Message text area -->
                    <div class="relative">
                        <div class="absolute top-4 left-0 pl-4 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <textarea name="message" placeholder="Your Message *" required rows="5" class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all duration-300 resize-none"></textarea>
                    </div>

                    <!-- Privacy Policy agreement checkbox -->
                    <div class="flex items-center gap-2.5 pt-2">
                        <input type="checkbox" id="privacy-check" required class="w-4 h-4 rounded text-[#E31B23] focus:ring-[#E31B23] border-gray-300">
                        <label for="privacy-check" class="text-xs text-gray-400 font-medium select-none">
                            I accept the privacy and terms.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-[#E31B23] hover:bg-[#0B1E43] text-white font-extrabold text-xs uppercase tracking-widest rounded-full transition-all duration-300 shadow-md btn-pulse-red">
                            <svg class="w-4 h-4 transform rotate-45 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                            Send Message
                        </button>
                    </div>

                </form>
            </div>

            <!-- Right Side: Beautiful generated vector illustration -->
            <div class="lg:col-span-5 flex justify-center reveal-right">
                <div class="relative w-full max-w-sm aspect-square overflow-hidden rounded-3xl group cursor-pointer shadow-[0_15px_40px_rgba(0,0,0,0.03)] hover:shadow-lg transition-all duration-500">
                    <img src="{{ asset('assets/images/contact_illustration.png') }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105" alt="Contact Vector Illustration">
                </div>
            </div>

        </div>
    </section>

    <!-- 3. INTERACTIVE GOOGLE MAP SECTION -->
    <section class="max-w-6xl mx-auto px-4 md:px-6 pb-24 reveal-bottom">
        <div class="bg-white rounded-[3rem] shadow-[0_15px_50px_rgba(11,30,67,0.05)] border border-gray-100 p-4 md:p-8">
            <div class="rounded-[2.5rem] overflow-hidden relative h-[450px] group border border-gray-100 shadow-inner">
                <!-- Google Map Iframe -->
                <iframe 
                    src="https://maps.google.com/maps?q={{ urlencode($settings['address'] ?? 'Education Tree Academy, Patiala, Punjab') }}&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                    class="w-full h-full border-0 grayscale hover:grayscale-0 transition-all duration-700 ease-in-out" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                
                <!-- Floating Info Badge (Premium Overlay) -->
                <div class="absolute bottom-6 left-6 right-6 md:right-auto md:max-w-sm bg-[#0B1E43]/95 backdrop-blur-md text-white p-6 rounded-3xl shadow-2xl border border-white/10 space-y-3 transform transition-all duration-300 group-hover:-translate-y-1">
                    <div class="flex items-center gap-2">
                        <span class="p-2 bg-[#E31B23] rounded-xl text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <h3 class="font-heading font-bold text-lg">Our Location</h3>
                    </div>
                    <p class="text-xs text-gray-300 leading-relaxed font-medium">
                        {{ $settings['address'] ?? 'Education Tree Academy, Patiala, Punjab' }}. Feel free to visit us or reach out via email ({{ $settings['site_email'] ?? 'info@francoway.com' }}) or phone ({{ $settings['site_phone'] ?? '+91 98765-43210' }}) for French course consultations.
                    </p>
                    <div class="h-[1px] bg-white/10 w-full"></div>
                    <div class="flex items-center gap-4 text-xs font-semibold text-gray-300">
                        <a href="https://maps.google.com/?q={{ urlencode($settings['address'] ?? 'Education Tree Academy, Patiala, Punjab') }}" target="_blank" class="text-[#F8B803] hover:underline flex items-center gap-1">
                            Get Directions 
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
