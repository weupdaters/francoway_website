<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password - Francoway</title>

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

    <div class="w-full max-w-[960px] bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(11,30,67,0.06)] border border-gray-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12 relative z-10">
        
        <!-- Left Side: OTP Verification & Reset Form (7 Columns) -->
        <div class="lg:col-span-7 p-6 sm:p-8 md:p-10 flex flex-col justify-between space-y-6">
            
            <!-- Logo & Back Links -->
            <div class="flex justify-between items-center">
                <a href="/" class="flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-brandRed transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Back to Home
                </a>
                <a href="{{ route('login') }}" class="text-xs font-bold text-brandRed hover:underline">
                    Back to Sign In
                </a>
            </div>

            <!-- Main Heading & Form -->
            <div class="space-y-6">
                <div class="space-y-2 text-left">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-brandRed font-bold text-[10px] uppercase tracking-widest">
                        ✦ OTP Verification
                    </span>
                    <h2 class="text-2xl sm:text-3.5xl font-heading font-black text-brandBlue tracking-tight leading-none">
                        Reset Password
                    </h2>
                    <p class="text-sm text-gray-550 font-medium leading-relaxed">
                        Enter the 6-digit OTP sent to your email along with your new password.
                    </p>
                </div>

                <!-- Session Status Alert -->
                @if (session('status'))
                    <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 text-xs font-semibold">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- General Error Alert -->
                @if ($errors->has('otp'))
                    <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-brandRed text-xs font-semibold">
                        {{ $errors->first('otp') }}
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Email field -->
                    <div class="space-y-1.5">
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
                                value="{{ old('email', $email) }}" 
                                placeholder="name@example.com" 
                                required 
                                class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-150 rounded-2xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-300 shadow-sm"
                            >
                        </div>
                        @error('email')
                            <p class="text-xs text-brandRed font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 6-Digit OTP field -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">6-Digit OTP Code</label>
                            <a href="{{ route('auth.password.request') }}" class="text-xs font-bold text-brandRed hover:underline">Resend OTP?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                </svg>
                            </span>
                            <input 
                                type="text" 
                                name="otp" 
                                maxlength="6"
                                placeholder="123456" 
                                required 
                                class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-150 rounded-2xl text-sm tracking-widest font-mono font-bold text-brandBlue focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-300 shadow-sm"
                            >
                        </div>
                    </div>

                    <!-- New Password field -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">New Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required 
                                class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-150 rounded-2xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-300 shadow-sm"
                            >
                        </div>
                        @error('password')
                            <p class="text-xs text-brandRed font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm New Password field -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Confirm New Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                placeholder="••••••••" 
                                required 
                                class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-150 rounded-2xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-300 shadow-sm"
                            >
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="inline-flex items-center justify-center gap-2 w-full py-3 bg-brandRed hover:bg-brandBlue text-white font-extrabold text-xs uppercase tracking-widest rounded-2xl transition-all duration-300 shadow-md btn-pulse-red"
                        >
                            Reset Password & Sign In
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Meta -->
            <p class="text-[10px] text-gray-400 font-medium text-center leading-normal">
                Remembered your password? <a href="{{ route('login') }}" class="underline font-bold text-brandRed">Sign In Here</a>.
            </p>

        </div>

        <!-- Right Side: Graphic Banner (5 Columns) -->
        <div class="lg:col-span-5 bg-brandBlue relative overflow-hidden flex flex-col justify-between p-8 md:p-10 text-white">
            <!-- Background Image Illustration -->
            <img 
                src="{{ asset('assets/images/form_illustration_new.jpg') }}" 
                class="absolute inset-0 w-full h-full object-cover z-0 select-none pointer-events-none"
                alt="France Canada Slogan Banner"
            >

            <!-- Decorative Dot Grid in Top Right -->
            <div class="absolute top-10 right-10 grid grid-cols-6 gap-1.5 opacity-25 select-none pointer-events-none z-10">
                @for ($i = 0; $i < 24; $i++)
                    <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                @endfor
            </div>

            <!-- Brand Header -->
            <div class="relative z-10">
                <span class="font-heading font-bold text-2xl tracking-tight text-white block">
                    Franco<span class="text-brandRed font-black">way</span>
                </span>
            </div>

            <!-- Dynamic Slogan -->
            <div class="relative z-10 space-y-4">
                <h3 class="font-heading font-black text-3xl sm:text-4xl leading-tight">
                    Success in French.<br>Success in Canada.
                </h3>
                <p class="font-script text-2xl text-brandGold">
                    Learn from the native experts.
                </p>
            </div>

            <!-- Footer Badge -->
            <div class="relative z-10 pt-8 border-t border-white/10 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-brandGold">✓</span>
                <span class="text-xs text-white/80 font-semibold uppercase tracking-wider">CEFR & DELF Aligned Training</span>
            </div>
        </div>

    </div>

</body>
</html>
