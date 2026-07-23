<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password - Francoway</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@450;500;600;700;850;900&family=Cactus+Classical+Serif&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN) -->
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
        
        @keyframes float-slow {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
        .animate-float-slow {
            animation: float-slow 7s infinite ease-in-out;
        }

        @keyframes subtle-pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(227, 27, 37, 0.2); }
            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(227, 27, 37, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(227, 27, 37, 0); }
        }
        .btn-pulse-red:hover {
            animation: subtle-pulse 1.6s infinite cubic-bezier(0.66, 0, 0, 1);
        }
    </style>
</head>
<body class="bg-[#F5F8FC] text-gray-800 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Decorative Blurry Gradient Orbits -->
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-[#0B1E43]/5 blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] rounded-full bg-[#E31B23]/5 blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-[520px] bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(11,30,67,0.06)] border border-gray-100 p-6 sm:p-10 relative z-10 space-y-6">
        
        <!-- Header / Back Navigation -->
        <div class="flex justify-between items-center">
            <a href="/" class="flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-brandRed transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Back to Home
            </a>
            <a href="{{ route('login') }}" class="text-xs font-bold text-brandRed hover:underline">
                Back to Login
            </a>
        </div>

        <!-- Main Title & Description -->
        <div class="space-y-2 text-left">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-brandRed font-bold text-[10px] uppercase tracking-widest">
                ✦ Password Recovery
            </span>
            <h2 class="text-2xl sm:text-3xl font-heading font-black text-brandBlue tracking-tight leading-none">
                Forgot Password
            </h2>
            <p class="text-sm text-gray-500 font-medium leading-relaxed">
                Enter your email address and we will send you a password reset link to recover your account.
            </p>
        </div>

        <!-- Session Status Alert -->
        @if (session('status'))
            <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 text-xs font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
            
            <!-- Email Input -->
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="email@example.com" 
                        required 
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-300 shadow-sm"
                    >
                </div>
                @error('email')
                    <p class="text-xs text-brandRed font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-6 bg-brandRed hover:bg-[#c9141b] text-white font-extrabold text-xs uppercase tracking-wider rounded-2xl transition-all duration-300 shadow-lg shadow-red-500/20 btn-pulse-red flex items-center justify-center gap-2"
            >
                <span>Send Password Reset Link</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </form>

        <!-- Footer Info -->
        <div class="pt-4 border-t border-gray-100 text-center">
            <p class="text-[11px] text-gray-400 font-medium">
                Need extra assistance? Contact <a href="/contact" class="text-brandBlue font-bold hover:underline">Francoway Support</a>
            </p>
        </div>
    </div>

</body>
</html>
