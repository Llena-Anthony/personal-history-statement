<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Personal History Statement')</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        /* Base Styles */
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        /* Card Styles */
        .glass-card {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Button Styles */
        .btn-primary {
            @apply bg-[#1B365D] text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200;
        }

        .btn-primary:hover {
            @apply bg-[#142a4a] transform -translate-y-0.5 shadow-lg;
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .slide-in {
            animation: slideIn 0.6s ease-out;
        }

        .scale-in {
            animation: scaleIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes scaleIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-[#1B365D] shadow-xl border-b border-[#D4AF37]/30 fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}"
                         alt="PMA Logo"
                         class="h-14 w-14 rounded-full border-2 border-[#D4AF37] shadow-md bg-white object-contain">
                    <span class="ml-2 text-white text-2xl font-extrabold tracking-wide drop-shadow-sm">PHS Online System</span>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        <span class="hidden md:inline text-white font-medium text-lg">
                            Welcome, <span class="font-bold">{{ Auth::user()->username }}</span>
                        </span>
                        <div class="relative group">
                            <button class="flex items-center space-x-2 px-4 py-2 rounded-lg bg-[#D4AF37] text-[#1B365D] font-semibold shadow hover:bg-[#B38F2A] focus:outline-none focus:ring-2 focus:ring-[#D4AF37] transition-all">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span class="hidden sm:inline">Account</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-[#1B365D] hover:bg-gray-50 flex items-center space-x-2">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-20">
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg fade-in">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#1B365D] text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm">© {{ date('Y') }} Philippine Military Academy. All rights reserved.</p>
                <a href="https://www.google.com/maps/place/Philippine+Military+Academy+(PMA)/@16.3595363,120.6175352,17z/data=!4m10!1m2!2m1!1sPMA!3m6!1s0x3391a140001b5169:0x3e6e8c0c41cfb35a!8m2!3d16.360888!4d120.619414!15sCgNQTUGSAQ9taWxpdGFyeV9zY2hvb2yqASoQATIdEAEiGVhxt5fJUUiIqeZ8vr3CUEe_6KFeKT8HghAyBxACIgNwbWHgAQA!16zL20vMDhwbmY1?entry=ttu&g_ep=EgoyMDI1MDYyMy4yIKXMDSoASAFQAw%3D%3D" 
                   target="_blank" 
                   class="text-sm mt-2 hover:text-[#D4AF37] transition-colors duration-200 cursor-pointer">
                    Fort Del Pilar, Baguio City, Philippines 2600
                </a>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
