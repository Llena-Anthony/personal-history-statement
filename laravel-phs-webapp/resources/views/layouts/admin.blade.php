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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-section-title {
            @apply text-xs font-semibold text-gray-300 uppercase tracking-wider px-2 mb-2;
        }

        .nav-link {
            @apply flex items-center px-3 py-2.5 text-gray-300 hover:text-white transition-all duration-200 rounded-md mb-1;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: rgba(212, 175, 55, 0.1);
            transition: width 0.3s ease;
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .nav-link.active {
            @apply bg-[#1B365D] text-white border-l-4 border-[#D4AF37];
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-link i {
            @apply w-6 text-lg;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: translateX(2px);
        }

        .nav-link span {
            @apply text-sm font-medium;
        }
        li::marker{
            content: none
        }
        .profile-container {
            text-align: left;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: linear-gradient(to bottom, rgba(43, 75, 125, 0.2), rgba(27, 54, 93, 0.1));
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .profile-container .profile-picture {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #D4AF37;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }
        .profile-container .profile-picture:hover {
            transform: scale(1.05);
        }
        .profile-container .user-info {
            flex-grow: 1;
        }
        .profile-container .user-name {
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.25rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .profile-container .user-role {
            font-size: 0.75rem;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }
        .pma-logo {
            width: 140px;
            height: auto;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1B365D] text-white flex flex-col">
            <!-- Profile Section -->
            <div class="profile-container">
                <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="Profile Picture" class="profile-picture">
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <div class="nav-section">
                    <div class="space-y-1">
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="ml-3">Dashboard</span>
                        </a></li>
                        <li><a href="#" class="nav-link">
                            <i class="fa-regular fa-folder"></i>
                            <span class="ml-3">PHS Submissions</span>
                        </a></li>
                        <li><a href="#" class="nav-link">
                            <i class="fa-regular fa-folder"></i>
                            <span class="ml-3">PDS Submissions</span>
                        </a></li>
                        <li><a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fa-regular fa-address-book"></i>
                            <span class="ml-3">User Management</span>
                        </a></li>
                        <li><a href="#" class="nav-link">
                            <i class="fas fa-history"></i>
                            <span class="ml-3">Activity Logs</span>
                        </a></li>
                        <li><a href="#" class="nav-link">
                            <i class="fa-regular fa-file-lines"></i>
                            <span class="ml-3">Reports</span>
                        </a></li>
                    </div>
                </div>
            </nav>

            <!-- Logout Section -->
            <div class="p-4 border-t border-[#2B4B7D]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full btn-primary inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-[#D4AF37] hover:bg-[#B38F2A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37] transition-all duration-200 shadow-md hover:shadow-lg">
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