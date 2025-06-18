<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PHS Online System')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen">
    <!-- Background Pattern -->
    <div class="fixed inset-0 bg-[url('/images/grid-pattern.svg')] bg-center opacity-5"></div>
    
    <div class="relative min-h-screen">
        <!-- Top Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-white/10 border-b border-white/10 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                            <img src="/images/pma-logo.png" alt="PMA Logo" class="h-8 w-auto">
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent tracking-wide">
                                PHS Online System
                            </span>
                        </a>
                    </div>

                    <div class="flex items-center">
                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                                <div class="relative">
                                    <img src="/images/profile-placeholder.png" alt="Profile" 
                                        class="h-8 w-8 rounded-full border-2 border-blue-400/50 hover:border-blue-400 transition-colors">
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-slate-900"></div>
                                </div>
                                <span class="text-sm font-medium text-slate-200">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 rounded-lg bg-slate-800/90 backdrop-blur-md border border-white/10 shadow-xl">
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-slate-700/50">
                                        <i class="fas fa-user-circle mr-2"></i>Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-200 hover:bg-slate-700/50">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="fixed top-16 left-0 w-72 h-[calc(100vh-4rem)] bg-slate-900/80 backdrop-blur-md border-r border-white/10 overflow-y-auto">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-white/10">
                <div class="flex flex-col items-center">
                    <div class="relative mb-3">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-blue-400/50 hover:border-blue-400 transition-colors">
                            <img src="/images/profile-placeholder.png" alt="User Photo" 
                                class="w-full h-full object-cover object-center transform scale-110">
                        </div>
                        <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-slate-900"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-base font-semibold text-slate-200">{{ auth()->user()->name }}</h3>
                        <p class="text-xs text-slate-400">Civilian</p>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="px-6 py-4 border-b border-white/10">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-slate-400">Progress</span>
                    <span class="text-sm font-medium text-blue-400">4/10</span>
                </div>
                <div class="w-full bg-slate-800 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 40%"></div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('phs.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">I</span>
                            </span>
                            <span class="text-sm font-medium">Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">II</span>
                            </span>
                            <span class="text-sm font-medium">Personal Characteristics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.marital-status.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">III</span>
                            </span>
                            <span class="text-sm font-medium">Marital Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.family-history.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 bg-blue-500/10 text-blue-400 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-blue-500/20">
                                <span class="text-xs text-blue-400 font-bold">IV</span>
                            </span>
                            <span class="text-sm font-medium">Family History and Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.educational-background.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">V</span>
                            </span>
                            <span class="text-sm font-medium">Educational Background</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">VI</span>
                            </span>
                            <span class="text-sm font-medium">Military History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">VII</span>
                            </span>
                            <span class="text-sm font-medium">Places of Residence Since Birth</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">VIII</span>
                            </span>
                            <span class="text-sm font-medium">Employment History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-slate-800 group-hover:bg-blue-500/20 transition-colors">
                                <span class="text-xs text-slate-400 group-hover:text-blue-400 font-bold">IX</span>
                            </span>
                            <span class="text-sm font-medium">Foreign Countries Visited</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-72 pt-16 min-h-screen">
            <div class="max-w-5xl mx-auto p-8">
                @if (session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500/20 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-400">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-500/10 border border-red-500/20 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-400">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-slate-800/50 backdrop-blur-md rounded-xl shadow-xl border border-white/10 p-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html> 