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
        <aside class="fixed top-16 left-0 w-72 h-[calc(100vh-4rem)] bg-gradient-to-b from-[#1B365D] via-[#2B4B7D] to-[#1B365D] backdrop-blur-md border-r-4 border-[#D4AF37] shadow-xl overflow-y-auto">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-[#D4AF37]/40 flex flex-col items-center">
                <div class="relative mb-3">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-[#D4AF37] shadow-lg">
                        <img src="/images/profile-placeholder.png" alt="User Photo" class="w-full h-full object-cover object-center transform scale-110">
                    </div>
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-[#1B365D]"></div>
                </div>
                <div class="text-center">
                    <h3 class="text-base font-semibold text-white">{{ auth()->user()->name }}</h3>
                    <p class="text-xs text-[#D4AF37] font-medium tracking-wide">Civilian</p>
                </div>
            </div>
            <!-- Navigation -->
            <nav class="p-6" x-data="phsSidebar()">
                <ul class="space-y-2">
                    <template x-for="section in sections" :key="section.route">
                        <li>
                            <a :href="section.url" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 group"
                               :class="{
                                   'bg-[#D4AF37]/90 text-[#1B365D] font-bold shadow': section.status === 'complete',
                                   'bg-yellow-100 text-yellow-800 font-bold': section.status === 'incomplete',
                                   'text-white hover:text-[#D4AF37] hover:bg-[#1B365D]/80': section.status === 'default'
                               }">
                                <span class="w-7 h-7 flex items-center justify-center rounded-full border-2 border-[#D4AF37] bg-[#1B365D] group-hover:bg-[#D4AF37] group-hover:text-[#1B365D] transition-all"
                                      :class="{
                                          'bg-[#D4AF37] text-[#1B365D]': section.status === 'complete',
                                          'bg-yellow-400 text-white': section.status === 'incomplete',
                                          'bg-[#1B365D] text-white': section.status === 'default'
                                      }">
                                    <span class="text-xs font-bold" x-text="section.label"></span>
                                </span>
                                <span class="text-sm font-medium" x-text="section.name"></span>
                            </a>
                        </li>
                    </template>
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
                                <i class="fas fa-times-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-400">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
        function phsSidebar() {
            return {
                sections: [
                    { label: 'I', name: 'Personal Details', url: '{{ route('phs.create') }}', status: '{{ session('phs_section_status.I', 'default') }}', route: 'phs.create' },
                    { label: 'II', name: 'Personal Characteristics', url: '{{ route('phs.personal-characteristics.create') }}', status: '{{ session('phs_section_status.II', 'default') }}', route: 'phs.personal-characteristics.create' },
                    { label: 'III', name: 'Marital Status', url: '{{ route('phs.marital-status.create') }}', status: '{{ session('phs_section_status.III', 'default') }}', route: 'phs.marital-status.create' },
                    { label: 'IV', name: 'Family History and Information', url: '{{ route('phs.family-background.create') }}', status: '{{ session('phs_section_status.IV', 'default') }}', route: 'phs.family-background.create' },
                    { label: 'V', name: 'Educational Background', url: '{{ route('phs.educational-background.create') }}', status: '{{ session('phs_section_status.V', 'default') }}', route: 'phs.educational-background.create' },
                    { label: 'VI', name: 'Military History', url: '{{ route('phs.military-history.create') }}', status: '{{ session('phs_section_status.VI', 'default') }}', route: 'phs.military-history.create' },
                    { label: 'VII', name: 'Places of Residence Since Birth', url: '{{ route('phs.places-of-residence.create') }}', status: '{{ session('phs_section_status.VII', 'default') }}', route: 'phs.places-of-residence.create' },
                    { label: 'VIII', name: 'Employment History', url: '{{ route('phs.employment-history.create') }}', status: '{{ session('phs_section_status.VIII', 'default') }}', route: 'phs.employment-history.create' },
                    { label: 'IX', name: 'Foreign Countries Visited', url: '{{ route('phs.foreign-countries.create') }}', status: '{{ session('phs_section_status.IX', 'default') }}', route: 'phs.foreign-countries.create' },
                    { label: 'X', name: 'Credit Reputation', url: '{{ route('phs.credit-reputation.create') }}', status: '{{ session('phs_section_status.X', 'default') }}', route: 'phs.credit-reputation.create' },
                    { label: 'XI', name: 'Arrest Record and Conduct', url: '{{ route('phs.arrest-record.create') }}', status: '{{ session('phs_section_status.XI', 'default') }}', route: 'phs.arrest-record.create' },
                ]
            }
        }
        </script>
    </div>
</body>
</html> 