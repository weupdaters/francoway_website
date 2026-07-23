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

    @stack('js')
</body>
</html>