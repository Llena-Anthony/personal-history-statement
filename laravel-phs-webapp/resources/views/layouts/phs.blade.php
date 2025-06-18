<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PHS System') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased h-full bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-full">
        <!-- Progress Bar -->
        <div class="fixed top-0 left-0 right-0 z-50">
            <div class="h-1 bg-gray-200">
                <div class="h-full bg-[#1B365D] transition-all duration-300" style="width: {{ $progress ?? 0 }}%"></div>
            </div>
        </div>

        <div class="flex h-full">
            <!-- Sidebar -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div class="flex flex-col w-64">
                    <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto glass-card border-r border-gray-200">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <img class="h-8 w-auto" src="{{ asset('images/pma_logo.svg') }}" alt="PHS System">
                        </div>
                        <nav class="mt-5 flex-1 px-2 space-y-1">
                            @include('phs.components.sidebar-nav')
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <div class="glass-card p-6 fade-in">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html> 