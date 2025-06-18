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
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
            font-size: 14px;
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

        /* Main Layout Structure */
        .admin-layout {
            display: flex;
            flex-direction: column;
            height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
        }

        .admin-layout::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(27, 54, 93, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.02) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Header Styles - Modern Design */
        .admin-header {
            background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%);
            border-bottom: 3px solid transparent;
            background-clip: padding-box;
            position: relative;
            flex-shrink: 0;
            z-index: 40;
            box-shadow: 0 8px 32px rgba(27, 54, 93, 0.15);
        }

        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, transparent 50%, rgba(212, 175, 55, 0.05) 100%);
            border-radius: 0 0 2rem 2rem;
        }

        .admin-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #D4AF37, #B38F2A, #D4AF37);
            border-radius: 0 0 2rem 2rem;
        }

        .header-content {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            border-radius: 0 0 2rem 2rem;
            position: relative;
            z-index: 1;
        }

        .pma-crest {
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3));
            transition: all 0.3s ease;
            position: relative;
            width: 3.5rem;
            height: 3.5rem;
        }

        .pma-crest::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pma-crest:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .pma-crest:hover::after {
            opacity: 1;
        }

        /* Main Content Area */
        .main-content-wrapper {
            flex: 1;
            display: flex;
            overflow: hidden;
            position: relative;
            margin: 0.25rem;
        }

        /* Sidebar Enhancements - Modern Design */
        .sidebar {
            background: linear-gradient(180deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            overflow: hidden;
            width: 260px;
            flex-shrink: 0;
            z-index: 30;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(27, 54, 93, 0.15);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 20%, rgba(212, 175, 55, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(212, 175, 55, 0.05) 0%, transparent 50%);
            pointer-events: none;
            border-radius: 1.5rem;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid;
            border-image: linear-gradient(135deg, #D4AF37, #B38F2A, #D4AF37) 1;
            border-radius: 1.5rem;
            pointer-events: none;
        }

        .profile-container {
            text-align: left;
            padding: 1.5rem 1.25rem;
            background: linear-gradient(135deg, rgba(43, 75, 125, 0.4) 0%, rgba(27, 54, 93, 0.3) 100%);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0.75rem;
            border-radius: 1.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .profile-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, transparent 100%);
            pointer-events: none;
            border-radius: 1.5rem;
        }

        .profile-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px solid;
            border-image: linear-gradient(135deg, rgba(212, 175, 55, 0.3), transparent) 1;
            border-radius: 1.5rem;
            pointer-events: none;
        }
        
        .profile-container .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid transparent;
            background: linear-gradient(45deg, #D4AF37, #B38F2A) padding-box,
                        linear-gradient(45deg, #D4AF37, #B38F2A) border-box;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }
        
        .profile-container .profile-picture:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }
        
        .profile-container .user-info {
            flex-grow: 1;
            position: relative;
            z-index: 1;
        }
        
        .profile-container .user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            text-decoration: none;
        }
        
        .profile-container .user-name:hover {
            color: #D4AF37;
            transform: translateX(4px);
        }
        
        .profile-container .user-name::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #D4AF37, #B38F2A);
            transition: width 0.3s ease;
            border-radius: 1px;
        }
        
        .profile-container .user-name:hover::after {
            width: 100%;
        }
        
        .profile-container .user-role {
            font-size: 0.6875rem;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }
        
        .tab-container {
            list-style: none;
            padding: 0 0.75rem;
            margin: 0;
            position: relative;
            z-index: 1;
            flex: 1;
            overflow-y: auto;
        }

        .tab-container::-webkit-scrollbar {
            width: 4px;
        }

        .tab-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }

        .tab-container::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #D4AF37, #B38F2A);
            border-radius: 2px;
        }

        .tab-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #B38F2A, #D4AF37);
        }

        .tab-container li a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #cfd8dc;
            text-decoration: none;
            font-size: 14px;
            padding: 12px 16px;
            border-radius: 1rem;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
        }

        .tab-container li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.15), transparent);
            transition: left 0.5s ease;
        }

        .tab-container li a:hover::before {
            left: 100%;
        }

        .tab-container li a:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.15) 0%, rgba(212, 175, 55, 0.05) 100%);
            color: white;
            transform: translateX(6px);
            box-shadow: 0 4px 16px rgba(212, 175, 55, 0.2);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .tab-container li a i {
            font-size: 16px;
            transition: all 0.3s ease;
            width: 18px;
            text-align: center;
        }

        .tab-container li a:hover i {
            transform: scale(1.2) rotate(10deg);
            color: #D4AF37;
        }
        
        .tab-container li a.active {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.1) 100%);
            color: white;
            font-weight: bold;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.25);
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 1rem;
            position: relative;
        }

        .tab-container li a.active::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid #D4AF37;
            border-top: 4px solid transparent;
            border-bottom: 4px solid transparent;
        }

        .tab-container li a.active i {
            color: #D4AF37;
        }
        
        .space-y-1 li a.active{
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.1) 100%);
        }

        /* Content Area */
        .content-area {
            flex: 1;
            background: white;
            border-radius: 1.5rem;
            margin-left: 0.25rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(212, 175, 55, 0.1);
            max-width: calc(100vw - 280px - 1rem);
        }

        .content-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem;
        }

        .content-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .content-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .content-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #D4AF37, #B38F2A);
            border-radius: 4px;
        }

        .content-scroll::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #B38F2A, #D4AF37);
        }

        /* Footer Styles - Modern Design */
        .admin-footer {
            background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%);
            border-top: 3px solid transparent;
            background-clip: padding-box;
            position: relative;
            flex-shrink: 0;
            z-index: 40;
            box-shadow: 0 -8px 32px rgba(27, 54, 93, 0.15);
        }

        .admin-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, transparent 50%, rgba(212, 175, 55, 0.1) 100%);
            border-radius: 2rem 2rem 0 0;
        }

        .admin-footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #D4AF37, #B38F2A, #D4AF37);
            border-radius: 2rem 2rem 0 0;
        }

        .footer-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
            border-radius: 2rem 2rem 0 0;
            position: relative;
            z-index: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100vh;
                transition: left 0.3s ease;
                border-radius: 0 1.5rem 1.5rem 0;
                z-index: 50;
            }
            
            .sidebar.open {
                left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .header-title {
                font-size: 1.125rem;
            }

            .content-area {
                margin: 0.25rem;
                border-radius: 1rem;
                max-width: calc(100vw - 0.5rem);
            }

            .content-scroll {
                padding: 1rem;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* PMA Theme Enhancements */
        .pma-gold {
            color: #D4AF37;
        }

        .pma-navy {
            background-color: #1B365D;
        }

        .pma-gradient {
            background: linear-gradient(135deg, #1B365D 0%, #1B365D 100%);
        }

        .pma-border {
            border-color: #D4AF37;
        }

        .pma-shadow {
            box-shadow: 0 4px 12px rgba(27, 54, 93, 0.15);
        }

        /* Notification Button */
        .notification-btn {
            position: relative;
            padding: 0.75rem;
            border-radius: 50%;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .notification-btn:hover {
            background: rgba(212, 175, 55, 0.2);
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
            border-radius: 50%;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-content">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Left Section -->
                    <div class="flex items-center space-x-4">
                        <!-- Mobile Menu Button -->
                        <button class="mobile-menu-btn lg:hidden text-white hover:text-[#D4AF37] transition-colors" onclick="toggleSidebar()">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        
                        <!-- PMA Logo/Crest -->
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/pma_logo.svg') }}" 
                                 alt="PMA Logo" 
                                 class="pma-crest">
                            <div class="hidden sm:block">
                                <h1 class="header-title text-white font-bold text-lg">Personal History Statement Online System</h1>
                                <p class="text-[#D4AF37] text-xs font-medium">Administrative Portal</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="notification-btn text-white hover:text-[#D4AF37] transition-colors">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <!-- Current Time -->
                        <div class="hidden md:block text-white text-xs">
                            <div class="font-medium" id="current-time"></div>
                            <div class="text-[#D4AF37] text-xs" id="current-date"></div>
                        </div>
                        
                        <!-- Breadcrumb -->
                        <div class="hidden lg:block text-white text-xs">
                            <span class="text-[#D4AF37]">Admin</span>
                            <span class="mx-2">/</span>
                            <span>@yield('header', 'Dashboard')</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
        <!-- Sidebar -->
            <aside class="sidebar text-white flex flex-col">
            <!-- Profile Section -->
            <div class="profile-container">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Picture" class="profile-picture">
                <div class="user-info">
                        <a href="{{ route('admin.profile.edit') }}" 
                           class="user-name"
                           title="Manage Profile">
                            {{ Auth::user()->name }}
                        </a>
                    <div class="user-role">Administrator</div>
                    </div>
                </div>
                
            <!-- Navigation -->
                <div class="tab-container">
                    <div class="space-y-1">
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-line"></i>
                            <span class="ml-3">Dashboard</span>
                        </a></li>
                        <li><a href="{{ route('admin.phs.index') }}" class="nav-link {{ request()->routeIs('admin.phs.*') ? 'active' : '' }}">
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
                        <li><a href="{{ route('admin.activity-logs.index') }}" class="nav-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ml-3">Activity Logs</span>
                        </a></li>
                        <li><a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="fa-regular fa-file-lines"></i>
                            <span class="ml-3">Reports</span>
                        </a></li>
                    </div>
                </div>

            <!-- Logout Section -->
                <div class="p-6 border-t border-[#2B4B7D] mt-auto relative z-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 border border-[#D4AF37] text-sm font-medium rounded-xl text-[#D4AF37] bg-transparent hover:bg-gradient-to-r hover:from-[#D4AF37] hover:to-[#B38F2A] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37] transition-all duration-300 shadow-sm hover:shadow-lg transform hover:scale-[1.02]">
                            <i class="fas fa-sign-out-alt mr-2 transition-transform duration-300"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

            <!-- Content Area -->
            <div class="content-area">
                <div class="content-scroll">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="admin-footer">
            <div class="footer-pattern">
                <div class="px-6 py-4">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <!-- Left Section -->
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/pma_logo.svg') }}" 
                                 alt="PMA Logo" 
                                 class="w-8 h-8 opacity-80">
                            <div class="text-white text-xs">
                                <p class="font-medium">Philippine Military Academy</p>
                                <p class="text-[#D4AF37] text-xs">Personal History Statement System</p>
                            </div>
                        </div>

                        <!-- Center Section -->
                        <div class="text-center text-white text-xs">
                            <p class="text-[#D4AF37] font-medium">"Character, Excellence, Service"</p>
                            <p class="mt-1">Fort Del Pilar, Baguio City, Philippines</p>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center space-x-4 text-white text-xs">
                            <div class="text-center">
                                <p class="text-[#D4AF37] font-medium">System Status</p>
                                <div class="flex items-center space-x-1 mt-1">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <span>Online</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-[#D4AF37] font-medium">Version</p>
                                <p>v1.0.0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Update current time and date
        function updateDateTime() {
            const now = new Date();
            const timeElement = document.getElementById('current-time');
            const dateElement = document.getElementById('current-date');
            
            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('en-US', { 
                    hour12: true, 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });
            }
            
            if (dateElement) {
                dateElement.textContent = now.toLocaleDateString('en-US', { 
                    weekday: 'short', 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
            }
        }

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Update time every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    </script>
</body>
</html> 