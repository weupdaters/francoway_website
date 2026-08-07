<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Francoway | Success in French. Success in Canada.')</title>

    <meta name="description" content="@yield('description', 'Learn French from Beginners to Advanced Level')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&family=Cactus+Classical+Serif&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite or Fallback CDN) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            heading: ['Cactus Classical Serif', 'serif'],
                            script: ['Caveat', 'cursive'],
                        },
                        colors: {
                            brandBlue: '#0B1E43',
                            brandRed: '#E31B23',
                            brandGold: '#F8B803',
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Cactus Classical Serif', serif;
        }
        .font-script {
            font-family: 'Caveat', cursive;
        }
        .scroll-smooth {
            scroll-behavior: smooth;
        }

        /* PREMIUM SCROLL REVEAL ANIMATIONS */
        .reveal-item {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000), transform 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000);
            will-change: opacity, transform;
        }
        .reveal-item.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000), transform 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000);
            will-change: opacity, transform;
        }
        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000), transform 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000);
            will-change: opacity, transform;
        }
        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-bottom {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000), transform 0.85s cubic-bezier(0.215, 0.610, 0.355, 1.000);
            will-change: opacity, transform;
        }
        .reveal-bottom.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* TRANSITION DELAYS FOR STAGGERED GRIDS */
        .reveal-delay-100 { transition-delay: 100ms; }
        .reveal-delay-200 { transition-delay: 200ms; }
        .reveal-delay-300 { transition-delay: 300ms; }
        .reveal-delay-400 { transition-delay: 400ms; }
        .reveal-delay-500 { transition-delay: 500ms; }

        /* BUTTON MICRO-PULSE GLOW EFFECT (HOVER) */
        @keyframes subtle-pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(227, 27, 37, 0.2); }
            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(227, 27, 37, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(227, 27, 37, 0); }
        }
        .btn-pulse-red:hover {
            animation: subtle-pulse 1.6s infinite cubic-bezier(0.66, 0, 0, 1);
        }

        @keyframes subtle-pulse-blue {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(11, 30, 67, 0.2); }
            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(11, 30, 67, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(11, 30, 67, 0); }
        }
        .btn-pulse-blue:hover {
            animation: subtle-pulse-blue 1.6s infinite cubic-bezier(0.66, 0, 0, 1);
        }

        /* CUSTOM HOVER SLIDE-LINE */
        .hover-slide-line {
            position: relative;
        }
        .hover-slide-line::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #E31B23;
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }
        .hover-slide-line:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* ================= CONTINUOUS LOOPING ANIMATIONS ================= */
        @keyframes float-slow {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
        .animate-float-slow {
            animation: float-slow 7s infinite ease-in-out;
        }

        @keyframes float-reverse {
            0% { transform: translateY(0px); }
            50% { transform: translateY(12px); }
            100% { transform: translateY(0px); }
        }
        .animate-float-reverse {
            animation: float-reverse 8s infinite ease-in-out;
        }

        @keyframes subtle-pulse-infinite {
            0% { box-shadow: 0 0 0 0 rgba(227, 27, 37, 0.25); }
            70% { box-shadow: 0 0 0 12px rgba(227, 27, 37, 0); }
            100% { box-shadow: 0 0 0 0 rgba(227, 27, 37, 0); }
        }
        .btn-infinite-pulse-red {
            animation: subtle-pulse-infinite 2.2s infinite ease-in-out;
        }

        @keyframes subtle-pulse-infinite-blue {
            0% { box-shadow: 0 0 0 0 rgba(11, 30, 67, 0.25); }
            70% { box-shadow: 0 0 0 12px rgba(11, 30, 67, 0); }
            100% { box-shadow: 0 0 0 0 rgba(11, 30, 67, 0); }
        }
        .btn-infinite-pulse-blue {
            animation: subtle-pulse-infinite-blue 2.2s infinite ease-in-out;
        }

        @keyframes blur-orbit {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.15); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blur-orbit {
            animation: blur-orbit 18s infinite ease-in-out;
        }

        @keyframes blur-orbit-reverse {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(-30px, 50px) scale(0.85); }
            66% { transform: translate(20px, -20px) scale(1.1); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blur-orbit-reverse {
            animation: blur-orbit-reverse 20s infinite ease-in-out;
        }
    </style>
    @stack('css')
</head>
<body class="bg-[#FDFDFC] text-[#1B1B18] antialiased overflow-x-hidden scroll-smooth">

    <!-- ================= HEADER ================= -->
    @include('layouts.header')

    <!-- ================= CONTENT ================= -->
    <main>
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    @include('layouts.footer')

    <!-- Global Scroll Reveal Intersection Observer -->
    <script>
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.08
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.reveal-item, .reveal-left, .reveal-right, .reveal-bottom').forEach(item => {
                observer.observe(item);
            });
        });
    </script>

    @if(isset($locale_not_chosen) && $locale_not_chosen)
        <!-- Language Selection Popup Modal -->
        <div id="language-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md transition-opacity duration-500 ease-out opacity-0 pointer-events-none">
            <div class="relative w-full max-w-md p-8 bg-white border border-gray-100 rounded-3xl shadow-2xl transform translate-y-8 scale-95 transition-all duration-500 ease-out">
                <!-- Decorative French flag stripes at the top -->
                <div class="absolute inset-x-0 top-0 h-1.5 flex rounded-t-3xl overflow-hidden">
                    <div class="w-1/3 bg-blue-600"></div>
                    <div class="w-1/3 bg-white"></div>
                    <div class="w-1/3 bg-red-600"></div>
                </div>

                <!-- Content -->
                <div class="text-center mt-2">
                    <!-- Icon/Globe -->
                    <div class="mx-auto flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-5 animate-pulse">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253"/>
                        </svg>
                    </div>

                    <!-- Headings -->
                    <h3 class="text-2xl font-black text-[#0B1E43] tracking-tight">Choose Your Language</h3>
                    <p class="text-base font-semibold text-gray-500 mt-1 mb-6">Choisissez votre langue</p>

                    <!-- Language Buttons -->
                    <div class="flex flex-col gap-3">
                        <!-- English Option -->
                        <a href="?lang=en" class="flex items-center justify-between px-6 py-4 border-2 border-gray-200 hover:border-[#0B1E43] rounded-2xl font-bold text-gray-800 hover:text-[#0B1E43] bg-gray-50/50 hover:bg-blue-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🇬🇧</span>
                                <span class="text-left font-bold text-base leading-tight">English <span class="block text-xs text-gray-500 font-medium">Continue in English</span></span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#0B1E43] transition-colors" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <!-- French Option -->
                        <a href="?lang=fr" class="flex items-center justify-between px-6 py-4 border-2 border-gray-200 hover:border-[#E31B23] rounded-2xl font-bold text-gray-800 hover:text-[#E31B23] bg-gray-50/50 hover:bg-red-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🇫🇷</span>
                                <span class="text-left font-bold text-base leading-tight">Français <span class="block text-xs text-gray-500 font-medium">Continuer en français</span></span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#E31B23] transition-colors" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script to handle entry animation -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const modal = document.getElementById('language-modal');
                const modalBox = modal.querySelector('div');

                // Trigger smooth show after short delay
                setTimeout(() => {
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modalBox.classList.remove('translate-y-8', 'scale-95');
                    modal.classList.add('opacity-100');
                    modalBox.classList.add('translate-y-0', 'scale-100');
                }, 300);
            });
        </script>
    @endif

    @stack('js')
</body>
</html>