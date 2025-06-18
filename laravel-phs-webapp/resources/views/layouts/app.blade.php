<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal History Statement')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .glass-card {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .btn-primary {
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(27, 54, 93, 0.15);
        }

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
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-[#1B365D] shadow-xl border-b border-[#D4AF37]/30" style="position: fixed; top: 0; left: 0; right: 0; z-index: 50;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" alt="PMA Logo" class="h-14 w-14 rounded-full border-2 border-[#D4AF37] shadow-md bg-white">
                    <span class="ml-2 text-white text-2xl font-extrabold tracking-wide drop-shadow-sm">PHS Online System</span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="hidden md:inline text-white font-medium text-lg">Welcome, <span class="font-bold">{{ Auth::user()->username }}</span></span>
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-lg bg-[#D4AF37] text-[#1B365D] font-semibold shadow hover:bg-[#B38F2A] focus:outline-none focus:ring-2 focus:ring-[#D4AF37] transition-all">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span class="hidden sm:inline">Account</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 group-hover:opacity-100 group-focus:opacity-100 pointer-events-none group-hover:pointer-events-auto group-focus:pointer-events-auto transition-all duration-200 z-50">
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
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style="padding-top:6rem;">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-[#1B365D] text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm">© {{ date('Y') }} Philippine Military Academy. All rights reserved.</p>
                <p class="text-sm mt-2">Fort Del Pilar, Baguio City, Philippines 2600</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
