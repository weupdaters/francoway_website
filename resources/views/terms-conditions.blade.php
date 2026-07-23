@extends('layouts.master')

@section('title', 'Terms & Conditions - Francoway')
@section('description', 'Review the terms and conditions for using Francoway platforms, courses, and AI tools.')

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
                <span class="text-white font-bold">Terms & Conditions</span>
            </nav>
            
            <!-- Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-heading font-black tracking-tight leading-tight max-w-4xl mx-auto">
                Terms & Conditions
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
                            <a href="#acceptance" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                1. Acceptance of Terms
                            </a>
                            <a href="#accounts" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                2. Account Registration
                            </a>
                            <a href="#payments-refunds" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                3. Payments & Refunds
                            </a>
                            <a href="#user-conduct" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                4. User Conduct & Rules
                            </a>
                            <a href="#intellectual-prop" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                5. Intellectual Property
                            </a>
                            <a href="#liability-disclaimer" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                6. Limitation of Liability
                            </a>
                            <a href="#governing-law" class="toc-link text-sm font-semibold text-gray-500 hover:text-[#E31B23] transition-colors duration-300 flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23] opacity-0 transition-opacity"></span>
                                7. Governing Law
                            </a>
                        </nav>
                        <div class="bg-[#0B1E43] text-white rounded-2xl p-6 relative overflow-hidden mt-6">
                            <div class="relative z-10 space-y-4">
                                <h4 class="font-heading font-bold text-lg leading-snug">Need more details?</h4>
                                <p class="text-xs text-white/70 leading-relaxed font-medium">For billing, enterprise licenses, or corporate inquiries, reach out directly to our admin panel.</p>
                                <a href="{{ route('contactUs') }}" class="inline-block px-5 py-2.5 bg-[#E31B23] hover:bg-white hover:text-[#0B1E43] text-white text-[11px] font-black uppercase tracking-widest rounded-full transition-all duration-300 text-center">
                                    Contact Support
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
                    
                    <!-- Section: Acceptance of Terms -->
                    <div id="acceptance" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">01 . AGREEMENT</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">1. Acceptance of Terms</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            Welcome to **Francoway** (Education Tree Academy). By accessing our website, purchasing our courses, interacting with the AI Practice Assistant, or using any of our learning services, you agree to comply with and be bound by the following Terms & Conditions.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            These Terms apply to all users, visitors, teachers, and students of our platform. If you disagree with any part of these terms, you may not access or use our services.
                        </p>
                    </div>

                    <!-- Section: Account Registration -->
                    <div id="accounts" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">02 . ACCOUNTS</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">2. Account Registration and Security</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            To enroll in courses or access advanced learning tools like the AI practice module, you must register for an account. You agree to provide accurate, current, and complete details during registration.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            You are responsible for safeguarding the password that you use to access the service and for any activities or actions under your password. You agree not to disclose your password to any third party. Sharing student accounts is strictly prohibited and may result in immediate suspension without refund.
                        </p>
                    </div>

                    <!-- Section: Payments & Refunds -->
                    <div id="payments-refunds" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">03 . FINANCIALS</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">3. Payments, Billing, and Refund Policy</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            Some courses and study features on Francoway require payment. By purchasing a course or subscription, you agree to pay the specified fees.
                        </p>
                        <div class="my-6 p-6 border-l-4 border-[#E31B23] bg-[#F5F8FC] rounded-r-2xl">
                            <h4 class="font-heading font-black text-[#0B1E43] text-lg mb-1">Refund Guidelines</h4>
                            <p class="text-xs md:text-sm text-gray-650 font-medium leading-relaxed">
                                Due to the digital nature of our course materials, videos, download guides, and AI tokens, refunds are processed only under specific conditions (e.g., duplicate charges or technical error preventing course access within 7 days of purchase). Please contact our support team at info@francoway.com to request reviews for refund claims.
                            </p>
                        </div>
                    </div>

                    <!-- Section: User Conduct -->
                    <div id="user-conduct" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">04 . ETIQUETTE</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">4. User Conduct & Acceptable Use</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            You agree not to use the service to:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div class="flex gap-2.5 items-start">
                                <span class="text-[#E31B23] text-base shrink-0 mt-0.5">✖</span>
                                <p class="text-xs md:text-sm text-gray-500 font-medium">Upload or transmit viruses, malwares, or standard injection scripts.</p>
                            </div>
                            <div class="flex gap-2.5 items-start">
                                <span class="text-[#E31B23] text-base shrink-0 mt-0.5">✖</span>
                                <p class="text-xs md:text-sm text-gray-500 font-medium">Harass, abuse, insult, harm, defame, or intimidate other students or instructors.</p>
                            </div>
                            <div class="flex gap-2.5 items-start">
                                <span class="text-[#E31B23] text-base shrink-0 mt-0.5">✖</span>
                                <p class="text-xs md:text-sm text-gray-500 font-medium">Scrape or copy code, AI models, course curriculum details, or PDFs without written consent.</p>
                            </div>
                            <div class="flex gap-2.5 items-start">
                                <span class="text-[#E31B23] text-base shrink-0 mt-0.5">✖</span>
                                <p class="text-xs md:text-sm text-gray-500 font-medium">Use the AI Practice interface to generate inappropriate, toxic, or spam conversation material.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Intellectual Property -->
                    <div id="intellectual-prop" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">05 . IP RIGHTS</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">5. Intellectual Property Rights</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            The service and its original content, features, layout design, branding logo, videos, worksheets, code elements, databases, and AI configurations are and will remain the exclusive property of Francoway (Education Tree Academy) and its licensors.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            Our trademarks and designs may not be used in connection with any product or service without the prior written consent of Francoway. Accessing courses does not grant you ownership rights over any content accessed.
                        </p>
                    </div>

                    <!-- Section: Limitation of Liability -->
                    <div id="liability-disclaimer" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">06 . DISCLAIMER</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">6. Limitation of Liability and Warranties</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            Our services are provided on an "AS IS" and "AS AVAILABLE" basis. Francoway makes no representations or warranties of any kind, express or implied, as to the operation of their services, or the information, content, or materials included therein.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            In no event shall Francoway, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the service.
                        </p>
                    </div>

                    <!-- Section: Governing Law -->
                    <div id="governing-law" class="scroll-mt-28 space-y-4 reveal-bottom">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-0.5 bg-[#E31B23]"></span>
                            <span class="text-[#E31B23] text-[10px] md:text-[11px] font-black uppercase tracking-[0.25em]">07 . LAW</span>
                        </div>
                        <h2 class="font-heading font-black text-2xl md:text-3xl text-[#0B1E43]">7. Governing Law and Disputes</h2>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            These Terms shall be governed and construed in accordance with the laws of India, without regard to its conflict of law provisions.
                        </p>
                        <p class="text-sm md:text-base text-gray-600 font-medium leading-relaxed">
                            Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect.
                        </p>
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
