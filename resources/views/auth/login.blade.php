<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Archtech</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('homepage/file/assets/faviconlogo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --archtech-primary: #084433;
            --archtech-secondary: #5DB996;
            --archtech-light: #118B50;
            --archtech-dark: #063325;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(93, 185, 150, 0.2);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(93, 185, 150, 0.15);
            box-shadow: 0 20px 40px -15px rgba(6, 51, 37, 0.5);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -15px var(--archtech-dark);
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(93, 185, 150, 0.2);
            transition: all 0.3s ease;
            color: white;
        }

        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--archtech-secondary);
            box-shadow: 0 0 0 3px rgba(93, 185, 150, 0.2);
            outline: none;
        }

        .input-glass:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--archtech-light);
        }

        .input-glass::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .animated-bg {
            background: linear-gradient(135deg, var(--archtech-dark) 0%, var(--archtech-primary) 50%, var(--archtech-light) 100%);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .primary-btn {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-light) 100%);
            transition: all 0.3s ease;
            border: 1px solid rgba(93, 185, 150, 0.3);
        }

        .primary-btn:hover {
            background: linear-gradient(135deg, var(--archtech-light) 0%, var(--archtech-secondary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px var(--archtech-dark);
        }

        .social-btn {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(93, 185, 150, 0.2);
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: rgba(93, 185, 150, 0.15);
            border-color: var(--archtech-secondary);
            transform: translateY(-2px);
        }

        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            animation: float 20s infinite;
        }

        .orb-1 {
            background: var(--archtech-secondary);
            width: 400px;
            height: 400px;
            top: -200px;
            right: -200px;
        }

        .orb-2 {
            background: var(--archtech-light);
            width: 300px;
            height: 300px;
            bottom: -150px;
            left: -150px;
            animation-delay: -5s;
        }

        .orb-3 {
            background: var(--archtech-primary);
            width: 350px;
            height: 350px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(50px, -50px) scale(1.1); }
            66% { transform: translate(-50px, 50px) scale(0.9); }
        }

        .brand-text-gradient {
            background: linear-gradient(135deg, #fff 0%, var(--archtech-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .accent-border {
            border-color: var(--archtech-secondary);
        }

        .accent-text {
            color: var(--archtech-secondary);
        }

        .accent-bg {
            background-color: var(--archtech-secondary);
        }

        .accent-hover:hover {
            color: var(--archtech-secondary);
        }

        /* Page layout */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 10;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.875rem;
            padding: 1.5rem;
            position: relative;
            z-index: 10;
            width: 100%;
        }
    </style>
</head>
<body class="animated-bg min-h-screen relative overflow-hidden">
    <!-- Floating Orbs with brand colors -->
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>

    <!-- Subtle pattern overlay -->
    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>

    <!-- Page Wrapper for proper footer positioning -->
    <div class="page-wrapper">
        <!-- Centered Content -->
        <div class="content-wrapper">
            <!-- Main Container -->
            <div class="w-full max-w-5xl">
                <div class="glass-card rounded-3xl overflow-hidden hover-lift">
                    <div class="grid md:grid-cols-2">
                        <!-- Left Side - Branding & Logo -->
                        <div class="relative p-12 flex flex-col items-center justify-center min-h-[600px]"
                             style="background: linear-gradient(145deg, rgba(8, 68, 51, 0.7) 0%, rgba(17, 139, 80, 0.5) 100%);">

                            <!-- Decorative Elements -->
                            <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
                                <div class="absolute top-10 left-10 w-20 h-20 border border-white/10 rounded-full"></div>
                                <div class="absolute bottom-10 right-10 w-32 h-32 border border-white/10 rounded-full"></div>
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 border border-white/5 rounded-full"></div>
                            </div>

                            <!-- Logo Section -->
                            <div class="text-center relative z-10">
                                <div class="relative inline-block">
                                    <!-- Glow effect behind logo -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-[#5DB996] to-[#118B50] rounded-3xl blur-2xl opacity-50"></div>

                                    <!-- Logo Container with your actual logo -->
                                    <div class="relative w-32 h-32 mx-auto mb-6 rounded-2xl bg-white/10 backdrop-blur-xl flex items-center justify-center border border-white/20 shadow-2xl transform hover:scale-110 transition-all duration-300 group">
                                        <!-- Inner glow -->
                                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-[#5DB996] to-[#118B50] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>

                                        <!-- Your Actual Logo -->
                                        <img src="{{ asset('homepage/file/assets/faviconlogo.png') }}"
                                             alt="Archtech Logo"
                                             class="w-16 h-16 object-contain"
                                        />
                                    </div>
                                </div>

                                <h1 class="text-5xl font-bold mb-3 brand-text-gradient">ARCHTECH</h1>
                                <p class="text-white/70 text-lg max-w-xs mx-auto">Design your future with precision and elegance</p>
                            </div>
                        </div>

                        <!-- Right Side - Login Form -->
                        <div class="p-12 bg-[#084433]/30 backdrop-blur-xl flex items-center">
                            <div class="w-full">
                                <!-- Header -->
                                <div class="mb-8">
                                    <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
                                    <p class="text-white/60">Please enter your credentials to continue</p>
                                </div>

                                <!-- Session Status -->
                                <div class="mb-8 p-4 glass-effect rounded-xl border border-[#5DB996]/30">
                                    <p class="text-sm text-white/90 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-[#5DB996]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Secure login portal
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="space-y-1">
                                        <label for="email" class="block text-sm font-medium text-white/80">
                                            Email Address
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-[#5DB996]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <input
                                                id="email"
                                                type="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autofocus
                                                autocomplete="username"
                                                class="input-glass block w-full pl-10 pr-3 py-3.5 rounded-xl focus:outline-none"
                                                placeholder="your@email.com"
                                            />
                                        </div>
                                        @error('email')
                                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="space-y-1">
                                        <label for="password" class="block text-sm font-medium text-white/80">
                                            Password
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-[#5DB996]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            </div>
                                            <input
                                                id="password"
                                                type="password"
                                                name="password"
                                                required
                                                autocomplete="current-password"
                                                class="input-glass block w-full pl-10 pr-3 py-3.5 rounded-xl focus:outline-none"
                                                placeholder="••••••••"
                                            />
                                        </div>
                                        @error('password')
                                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>




                                    <!-- Login Button -->
                                    <button type="submit" class="primary-btn relative w-full py-3.5 px-4 rounded-xl text-white font-medium focus:outline-none focus:ring-2 focus:ring-[#5DB996] focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 group overflow-hidden">
                                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                                        <span class="relative flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                            </svg>
                                            Sign In
                                        </span>
                                    </button>



        <!-- Footer - Outside the form, at the bottom -->
        <div class="footer">
            <p>© 2026 Archtech. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
