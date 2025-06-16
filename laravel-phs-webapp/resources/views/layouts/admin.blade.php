<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Personal History Statement</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .nav-section {
            @apply bg-[#2B4B7D] rounded-lg p-3 mb-4;
        }

        .nav-section-title {
            @apply text-xs font-semibold text-gray-300 uppercase tracking-wider px-2 mb-2;
        }

        .nav-link {
            @apply flex items-center px-3 py-2.5 text-gray-300 hover:text-white transition-all duration-200 rounded-md mb-1;
        }

        .nav-link:hover {
            @apply bg-[#1B365D] transform translate-x-1;
        }

        .nav-link.active {
            @apply bg-[#1B365D] text-white border-l-4 border-[#D4AF37];
        }

        .nav-link i {
            @apply w-6 text-lg;
        }

        .nav-link span {
            @apply text-sm font-medium;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1B365D] text-white flex flex-col">
            <!-- Logo and Title -->
            <div class="p-4 border-b border-[#2B4B7D]">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" alt="PMA Logo" class="h-10 w-auto">
                    <div>
                        <span class="text-lg font-semibold">PHS Admin</span>
                        <p class="text-xs text-gray-400">Philippine Military Academy</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <!-- Main Navigation -->
                <div class="nav-section">
                    <h3 class="nav-section-title">Main Menu</h3>
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span class="ml-3">User Management</span>
                        </a>
                    </div>
                </div>

                <!-- System Navigation -->
                <div class="nav-section">
                    <h3 class="nav-section-title">System</h3>
                    <div class="space-y-1">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span class="ml-3">Settings</span>
                        </a>
                        <a href="#" class="nav-link">
                            <i class="fas fa-history"></i>
                            <span class="ml-3">Activity Log</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- User Info and Logout -->
            <div class="p-4 border-t border-[#2B4B7D]">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="h-10 w-10 rounded-full bg-[#2B4B7D] flex items-center justify-center">
                        <i class="fas fa-user text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ Auth::user()->username }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full btn-primary inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#D4AF37] hover:bg-[#B38F2A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37]">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <h1 class="text-2xl font-bold text-[#1B365D]">@yield('header')</h1>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html> 