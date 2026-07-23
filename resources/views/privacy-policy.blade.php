@extends('layouts.master')

@section('title', 'Privacy Policy - Francoway')
@section('description', 'Learn how Francoway collects, uses, and protects your personal information and data.')

@section('content')
    <!-- 1. SLATE HERO HEADER -->
    <section class="relative bg-[#071530] text-white pt-24 pb-36 lg:pt-32 lg:pb-48 overflow-hidden z-10">
        <!-- Radial gradient background -->
        <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top_right,rgba(227,27,37,0.15),transparent_50%)]"></div>
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
                <span class="text-white font-bold">Privacy Policy</span>
            </nav>
            
            <!-- Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-heading font-black tracking-tight leading-tight max-w-4xl mx-auto">
                Privacy Policy
            </h1>
        </div>

        <!-- Curved bottom boundary overlay (upward curve transition) -->
        <div class="absolute bottom-0 left-0 right-0 h-16 md:h-24 bg-white rounded-t-[3rem] lg:rounded-t-[5rem] z-20"></div>
    </section>

    <!-- 2. CONTENT SECTION WITH STICKY SIDEBAR -->
    <section class="pb-24 bg-white relative z-20 -mt-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Sticky Sidebar navigation -->
                <div class="lg:col-span-4 lg:block">
                    <div class="sticky top-28 bg-[#F5F8FC] border border-gray-100 rounded-3xl p-8 space-y-6">
                        <h3 class="font-heading font-black text-xl text-[#0B1E43] tracking-wide border-b border-gray-200 pb-3">Table of Contents</h3>
                        <nav class="flex flex-col space-y-3.5">
                            <a href="#introduction" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                Introduction
                            </a>
                            <a href="#info-we-collect" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                Information We Collect
                            </a>
                            <a href="#how-we-use-info" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                How We Use Your Info
                            </a>
                            <a href="#data-protection" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                Data Protection
                            </a>
                            <a href="#cookies-tracking" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                Cookies & Tracking
                            </a>
                            <a href="#your-rights" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                Your Rights
                            </a>
                            <a href="#contact-us" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                Contact Us
                            </a>
                        </nav>
                        <div class="bg-[#0B1E43] text-white rounded-2xl p-6 relative overflow-hidden mt-6">
                            <div class="relative z-10 space-y-4">
                                <h4 class="font-heading font-bold text-lg leading-snug">Have privacy questions?</h4>
                                <p class="text-xs text-white/70 leading-relaxed font-medium">If you need clarification regarding your personal data, feel free to email our compliance team.</p>
                                <a href="mailto:{{ $settings['site_email'] ?? 'privacy@francoway.com' }}" class="inline-block px-5 py-2.5 bg-[#E31B23] hover:bg-white hover:text-[#0B1E43] text-white text-[11px] font-black uppercase tracking-widest rounded-full transition-all duration-300 text-center">
                                    Email Support
                                </a>
                            </div>
                            <div class="absolute bottom-0 right-0 h-24 opacity-10 pointer-events-none z-0">
                                <img src="{{ asset('assets/images/footer_sketch.png') }}" class="h-full w-auto object-contain object-bottom-right">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-12 text-left">
                    
                    <!-- Section: Introduction -->
                    <div id="introduction" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">01 . INTRODUCTION</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">Welcome to Francoway</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            At **Francoway** (Education Tree Academy), accessible from [{{ request()->getHost() }}]({{ url('/') }}), one of our main priorities is the privacy of our visitors and students. This Privacy Policy document contains types of information that is collected and recorded by Francoway and how we use it.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us. This Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Francoway. This policy is not applicable to any information collected offline or via channels other than this website.
                        </p>
                    </div>

                    <!-- Section: Info We Collect -->
                    <div id="info-we-collect" class="scroll-mt-28 space-y-6 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">02 . DATA COLLECTION</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">Information We Collect</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div class="border border-gray-100 rounded-2xl p-6 bg-[#F5F8FC] hover:shadow-md transition-all duration-300">
                                <h4 class="font-heading font-black text-[#0B1E43] text-lg mb-2">Direct Information</h4>
                                <ul class="space-y-2 text-xs md:text-sm text-gray-500 font-medium list-disc list-inside">
                                    <li>Account registration data: name, email address, phone number.</li>
                                    <li>Profile information: billing details and course enrollment status.</li>
                                    <li>Direct messages: name, email, and content of messages sent through contact forms.</li>
                                </ul>
                            </div>
                            <div class="border border-gray-100 rounded-2xl p-6 bg-[#F5F8FC] hover:shadow-md transition-all duration-300">
                                <h4 class="font-heading font-black text-[#0B1E43] text-lg mb-2">Indirect/Tech Data</h4>
                                <ul class="space-y-2 text-xs md:text-sm text-gray-500 font-medium list-disc list-inside">
                                    <li>Usage analytics: page visits, duration, and search parameters.</li>
                                    <li>AI practice transcripts: inputs and speaking answers submitted to the AI practice partner.</li>
                                    <li>Log files: internet protocol (IP) addresses, browser type, ISP, and date/time stamps.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section: How We Use Info -->
                    <div id="how-we-use-info" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">03 . USE OF DATA</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">How We Use Your Information</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            We use the information we collect in various ways, including to:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div class="flex gap-3 items-start p-4 rounded-xl border border-gray-100 hover:border-[#E31B23]/30 transition-all duration-300">
                                <span class="p-2 rounded-lg bg-[#E8EBFC] text-[#3D5EE1]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                </span>
                                <div>
                                    <h5 class="font-extrabold text-[#0B1E43] text-sm">Operate the Platform</h5>
                                    <p class="text-xs text-gray-400 mt-0.5">Provide, operate, maintain, and secure our online course portal and database.</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-4 rounded-xl border border-gray-100 hover:border-[#E31B23]/30 transition-all duration-300">
                                <span class="p-2 rounded-lg bg-[#E8EBFC] text-[#3D5EE1]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </span>
                                <div>
                                    <h5 class="font-extrabold text-[#0B1E43] text-sm">Enhance AI Assistant</h5>
                                    <p class="text-xs text-gray-400 mt-0.5">Evaluate and save AI practice responses to grade speaking, reading, listening, and writing tasks.</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-4 rounded-xl border border-gray-100 hover:border-[#E31B23]/30 transition-all duration-300">
                                <span class="p-2 rounded-lg bg-[#E8EBFC] text-[#3D5EE1]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                </span>
                                <div>
                                    <h5 class="font-extrabold text-[#0B1E43] text-sm">Send Updates & Promos</h5>
                                    <p class="text-xs text-gray-400 mt-0.5">Communicate with you regarding course enrollment, payments, and promotional newsletters.</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-4 rounded-xl border border-gray-100 hover:border-[#E31B23]/30 transition-all duration-300">
                                <span class="p-2 rounded-lg bg-[#E8EBFC] text-[#3D5EE1]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </span>
                                <div>
                                    <h5 class="font-extrabold text-[#0B1E43] text-sm">Security & Auditing</h5>
                                    <p class="text-xs text-gray-400 mt-0.5">Detect, prevent, and address technical issues, system misuse, or fraudulent transactions.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Data Protection -->
                    <div id="data-protection" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">04 . DATA PROTECTION</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">Data Security and Retention</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            We retain personal data only for as long as necessary to provide the services you requested, fulfill transactions, or comply with statutory requirements (like auditing or tax compliance).
                        </p>
                    </div>

                    <!-- Section: Cookies & Tracking -->
                    <div id="cookies-tracking" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">05 . COOKIES</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">Cookies and Web Beacons</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            Like any other website, Francoway uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.
                        </p>
                    </div>

                    <!-- Section: Your Rights -->
                    <div id="your-rights" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">06 . USER RIGHTS</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">Your Data Protection Rights</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            We want to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:
                        </p>
                        <div class="space-y-4 pl-4 pt-2">
                            <div class="flex gap-3 items-start text-left">
                                <span class="text-[#E31B23] font-bold">✓</span>
                                <p class="text-xs md:text-sm text-gray-600 font-medium"><strong>The right to access</strong> – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
                            </div>
                            <div class="flex gap-3 items-start text-left">
                                <span class="text-[#E31B23] font-bold">✓</span>
                                <p class="text-xs md:text-sm text-gray-600 font-medium"><strong>The right to rectification</strong> – You have the right to request that we correct any information you believe is inaccurate or complete information you believe is incomplete.</p>
                            </div>
                            <div class="flex gap-3 items-start text-left">
                                <span class="text-[#E31B23] font-bold">✓</span>
                                <p class="text-xs md:text-sm text-gray-600 font-medium"><strong>The right to erasure</strong> – You have the right to request that we erase your personal data, under certain conditions.</p>
                            </div>
                            <div class="flex gap-3 items-start text-left">
                                <span class="text-[#E31B23] font-bold">✓</span>
                                <p class="text-xs md:text-sm text-gray-600 font-medium"><strong>The right to restrict processing</strong> – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Contact Us -->
                    <div id="contact-us" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">07 . CONTACT</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">Contact Our Compliance Officer</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            If you have questions about this policy, want to query your data, or exercise your rights, please reach out to us at:
                        </p>
                        <div class="bg-[#F5F8FC] border border-gray-100 rounded-2xl p-6 space-y-3 font-semibold text-[#0B1E43] text-sm">
                            <p class="flex items-center gap-3 text-gray-600 font-medium">
                                <strong class="text-[#0B1E43] min-w-[80px]">Organization:</strong> Francoway (Education Tree Academy)
                            </p>
                            <p class="flex items-center gap-3 text-gray-600 font-medium">
                                <strong class="text-[#0B1E43] min-w-[80px]">Email:</strong> {{ $settings['site_email'] ?? 'info@francoway.com' }}
                            </p>
                            <p class="flex items-center gap-3 text-gray-600 font-medium">
                                <strong class="text-[#0B1E43] min-w-[80px]">Address:</strong> {{ $settings['address'] ?? 'Education Tree Academy, Patiala, Punjab' }}
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@push('css')
<style>
    .toc-link.active-link {
        color: #E31B23 !important;
    }
    .toc-link.active-link span {
        opacity: 1;
    }
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sections = document.querySelectorAll(".scroll-mt-28");
        const navLinks = document.querySelectorAll(".toc-link");

        function makeActive() {
            let fromTop = window.scrollY + 150;
            let currentActiveSection = null;

            sections.forEach(section => {
                if (section.offsetTop <= fromTop) {
                    currentActiveSection = section;
                }
            });

            if (currentActiveSection) {
                navLinks.forEach(link => {
                    link.classList.remove("active-link");
                    if (link.getAttribute("href") === "#" + currentActiveSection.id) {
                        link.classList.add("active-link");
                    }
                });
            }
        }

        window.addEventListener("scroll", makeActive);
        makeActive();
    });
</script>
@endpush
@endsection
