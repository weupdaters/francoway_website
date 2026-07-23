<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up - Francoway</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@450;500;600;700;850;900&family=Cactus+Classical+Serif&family=Fraunces:ital,opsz,wght@0,9..144,300..900;1,9..144,300..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Fraunces', 'serif'],
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
            font-family: 'Fraunces', serif;
        }
        .font-script {
            font-family: 'Caveat', cursive;
        }

        /* Interactive active states for role cards */
        .role-radio:checked + .role-card-inner {
            border-color: #E31B23;
            background-color: rgba(227, 27, 35, 0.03);
        }
        .role-radio:checked + .role-card-inner .role-icon-bg {
            background-color: #E31B23;
            color: white;
        }
        .role-radio:checked + .role-card-inner .radio-bullet {
            border-color: #E31B23;
        }
        .role-radio:checked + .role-card-inner .radio-bullet::after {
            content: '';
            display: block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #E31B23;
        }
    </style>
</head>
<body class="bg-[#F5F8FC] text-gray-800 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Background Orbits -->
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-[#0B1E43]/5 blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] rounded-full bg-[#E31B23]/5 blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-[960px] bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(11,30,67,0.05)] border border-gray-150 overflow-hidden grid grid-cols-1 lg:grid-cols-12 relative z-10 my-4">
        
        <!-- LEFT SIDE: SIGN UP FORM (7 Columns) -->
        <div class="lg:col-span-7 p-6 sm:p-8 md:p-9 flex flex-col justify-between space-y-4">
            
            <!-- Top Actions: Back to Home & Sign Up Badge -->
            <div class="flex justify-between items-center">
                <a href="/" class="flex items-center gap-1.5 text-xs font-extrabold text-[#0B1E43] hover:text-brandRed transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Back to Home
                </a>
                
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full border border-brandRed text-brandRed font-extrabold text-[10px] tracking-wider uppercase">
                    + SIGN UP
                </span>
            </div>

            <!-- Title Header -->
            <div class="space-y-1 text-left">
                <h1 class="text-2xl sm:text-3.5xl font-heading font-black text-[#0B1E43] tracking-tight">
                    Create <span class="text-brandRed">Your</span> Account
                </h1>
                <p class="text-xs text-gray-500 font-medium">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-brandRed font-extrabold hover:underline">Sign In</a>
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('auth.register') }}" method="POST" class="space-y-3.5">
                @csrf

                <!-- Name & Email side-by-side -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Full Name -->
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-1.5 text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            Full Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            placeholder="John Doe" 
                            required 
                            class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-350 shadow-sm"
                        >
                        @error('name')
                            <p class="text-xs text-brandRed font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-1.5 text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            Email Address
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="admin@gmail.com" 
                            required 
                            class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-350 shadow-sm"
                        >
                        @error('email')
                            <p class="text-xs text-brandRed font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Phone Number (Optional) -->
                <div class="space-y-1.5">
                    <label class="flex items-center gap-1.5 text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.143-5.12-3.439-6.264-6.264l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.11-1.004H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        Phone Number (Optional)
                    </label>
                    <div class="flex gap-2">
                        <!-- Flag dropdown -->
                        <div class="w-28 shrink-0">
                            <select name="country_code" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-300 shadow-sm font-semibold text-gray-600">
                                <option value="+91" selected>🇮🇳 +91</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+44">🇬🇧 +44</option>
                                <option value="+61">🇦🇺 +61</option>
                            </select>
                        </div>
                        <!-- Number field -->
                        <input 
                            type="tel" 
                            name="phone" 
                            value="{{ old('phone') }}" 
                            placeholder="98765 43210" 
                            class="flex-grow px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-350 shadow-sm"
                        >
                    </div>
                </div>

                <!-- Password & Confirm Password side-by-side -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-1.5 text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="•••••••••" 
                                required 
                                class="w-full pl-4 pr-10 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-350 shadow-sm"
                            >
                            <!-- Password visibility eye outline -->
                            <button type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-brandRed font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-1.5 text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                placeholder="•••••••••" 
                                required 
                                class="w-full pl-4 pr-10 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brandRed focus:bg-white transition-all duration-350 shadow-sm"
                            >
                            <button type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- I WANT TO REGISTER AS A: (Student/Teacher side-by-side selection matching screenshot) -->
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-extrabold text-gray-700 uppercase tracking-widest">I want to Register as a:</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        
                        <!-- Student Radio Selection Card -->
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="user" checked class="role-radio hidden">
                            <div class="role-card-inner flex items-center gap-3 p-3 border border-gray-200 rounded-2xl transition-all duration-300 hover:border-brandRed/30 hover:bg-gray-50/20">
                                <!-- Custom Radio Bullet outline -->
                                <div class="radio-bullet w-4.5 h-4.5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0"></div>
                                <!-- Icon in red circle -->
                                <span class="role-icon-bg w-10 h-10 rounded-full bg-red-50 text-brandRed flex items-center justify-center shrink-0 transition-colors">
                                    <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.62 48.62 0 0112 20.9c4.956 0 9.31 1.766 12.23 4.579a48.62 48.62 0 01-8.23-4.58 60.43 60.43 0 00-.492-6.347m-13.018-6.348l13.018-6.348 13.018 6.348M12 2.25v13.5" />
                                    </svg>
                                </span>
                                <div class="text-left leading-normal">
                                    <h4 class="font-bold text-xs text-[#0B1E43]">Student</h4>
                                    <p class="text-[9px] text-gray-400 font-medium leading-tight mt-0.5">Access French courses &<br>practice with AI.</p>
                                </div>
                            </div>
                        </label>

                        <!-- Teacher Radio Selection Card -->
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="teacher" class="role-radio hidden">
                            <div class="role-card-inner flex items-center gap-3 p-3 border border-gray-200 rounded-2xl transition-all duration-300 hover:border-brandRed/30 hover:bg-gray-50/20">
                                <!-- Custom Radio Bullet outline -->
                                <div class="radio-bullet w-4.5 h-4.5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0"></div>
                                <!-- Icon in blue circle -->
                                <span class="role-icon-bg w-10 h-10 rounded-full bg-blue-50 text-[#0B1E43] flex items-center justify-center shrink-0 transition-colors">
                                    <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </span>
                                <div class="text-left leading-normal">
                                    <h4 class="font-bold text-xs text-[#0B1E43]">Teacher</h4>
                                    <p class="text-[9px] text-gray-400 font-medium leading-tight mt-0.5">Manage virtual classrooms &<br>review attempts.</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Consent check -->
                <div class="flex items-start gap-2.5 pt-2">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        id="terms" 
                        required 
                        class="w-4.5 h-4.5 rounded text-brandRed focus:ring-brandRed border-gray-300 cursor-pointer mt-0.5"
                    >
                    <label for="terms" class="text-xs text-gray-500 font-semibold select-none cursor-pointer leading-tight">
                        I agree to the <a href="{{ route('terms.conditions') }}" class="text-brandRed hover:underline">Terms of Service</a> and <a href="{{ route('privacy.policy') }}" class="text-brandRed hover:underline">Privacy Policy</a>.
                    </label>

                </div>

                <!-- Submit Button -->
                <div class="pt-1.5">
                    <button 
                        type="submit" 
                        class="inline-flex items-center justify-center gap-2 w-full py-3 bg-brandRed hover:bg-[#0B1E43] text-white font-extrabold text-xs uppercase tracking-wider rounded-2xl transition-all duration-300 shadow-md btn-pulse-red"
                    >
                        REGISTER NOW ➔
                    </button>
                </div>
            </form>

            <!-- Footer Badge -->
            <div class="flex justify-center items-center gap-2 pt-2 text-[10px] text-gray-400 font-semibold uppercase tracking-wider">
                <svg class="w-4 h-4 text-brandRed shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                Your information is safe and secure with us.
            </div>

        </div>

        <!-- RIGHT SIDE: BRAND BANNER (5 Columns) -->
        <div class="lg:col-span-5 bg-brandBlue relative overflow-hidden flex flex-col justify-between p-8 md:p-10 text-white min-h-[400px]">
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

            <!-- Logo Header -->
            <div class="relative z-10 text-left">
                <span class="font-heading font-bold text-3xl tracking-tight text-white block">
                    Franco<span class="text-brandRed">way</span>
                </span>
                <div class="flex items-center gap-1.5 mt-1.5">
                    <div class="h-[1px] bg-white/20 w-8"></div>
                    <!-- Small Red Maple Leaf icon SVG -->
                    <svg class="w-3.5 h-3.5 text-brandRed" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3s-.18 1.1-.5 1.5c-.32.4-.72.6-1 .6h-.5v.8c0 .2.2.4.5.5h.7c.3 0 .5.2.5.5v.7c0 .3-.2.5-.5.5h-.7c-.3 0-.5.2-.5.5v.8c0 .3.2.5.5.5h1.2c.4 0 .7.3.7.7v1.8c0 .4-.3.7-.7.7H10.5c-.4 0-.7-.3-.7-.7v-.8c0-.3.2-.5.5-.5h.2v-.8c0-.3-.2-.5-.5-.5h-.7c-.3 0-.5-.2-.5-.5V8.5c0-.3.2-.5.5-.5h.7c.3 0 .5-.2.5-.5V6.7c0-.3-.2-.5-.5-.5H8.7c-.4 0-.7-.3-.7-.7V3.7c0-.4.3-.7.7-.7h1.1c.4 0 .7.3.7.7v.8c0 .3-.2.5-.5.5h-.2v.8c0 .3.2.5.5.5h.7c.3 0 .5.2.5.5v.7c0 .3-.2.5-.5.5h-.7c-.3 0-.5.2-.5.5v.8c0 .3.2.5.5.5h.8l.3.5-.5.7-.7-.3c-.3-.1-.5 0-.5.3v1.2c0 .3.2.5.5.5H12z"/>
                    </svg>
                    <div class="h-[1px] bg-white/20 w-8"></div>
                </div>
            </div>

            <!-- Dynamic Slogan in Center -->
            <div class="relative z-10 space-y-4 text-left my-auto">
                <h3 class="font-heading font-black text-3xl md:text-3.5xl leading-tight">
                    Start Your<br>French Journey<br><span class="text-brandRed">Today!</span>
                </h3>
                <p class="text-sm text-white/80 font-medium leading-relaxed max-w-[280px]">
                    Excel in CELPIP, DELF and more with expert guidance and personalized learning.
                </p>
            </div>

            <!-- Footer Badge -->
            <div class="relative z-10 pt-6 border-t border-white/10 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-brandGold">✓</span>
                <span class="text-[10px] text-white/70 font-semibold uppercase tracking-wider">CEFR & DELF Aligned Training</span>
            </div>
        </div>

    </div>

</body>
</html>
