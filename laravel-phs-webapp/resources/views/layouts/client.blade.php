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
        
        .fade-in { animation: fadeIn 0.6s ease-out; }
        .slide-in { animation: slideIn 0.6s ease-out; }
        .scale-in { animation: scaleIn 0.6s ease-out; }
        
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
        
        .main-content-wrapper { 
            flex: 1; 
            display: flex; 
            overflow: hidden; 
            position: relative; 
            margin: 0.25rem; 
        }
        
        .content-area { 
            flex: 1; 
            background: white; 
            border-radius: 1.5rem; 
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); 
            overflow: hidden; 
            display: flex; 
            flex-direction: column; 
            border: 1px solid rgba(212, 175, 55, 0.1); 
        }
        
        .content-scroll { 
            flex: 1; 
            overflow-y: auto; 
            padding: 1.25rem; 
        }
        
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
        }
        
        /* Profile Dropdown Styles */
        .profile-dropdown {
            position: relative;
        }
        
        .profile-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(212, 175, 55, 0.1);
            min-width: 200px;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }
        
        .profile-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .profile-menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .profile-menu-item:last-child {
            border-bottom: none;
        }
        
        .profile-menu-item:hover {
            background-color: #f9fafb;
            color: #1B365D;
        }
        
        .profile-menu-item.logout {
            color: #dc2626;
        }
        
        .profile-menu-item.logout:hover {
            background-color: #fef2f2;
            color: #b91c1c;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar { 
                transform: translateX(-100%); 
                transition: transform 0.3s ease; 
            }
            .sidebar.open { 
                transform: translateX(0); 
            }
            .content-area { 
                max-width: 100vw; 
                margin-left: 0; 
            }
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
                        <button class="mobile-menu-btn lg:hidden text-white hover:text-[#D4AF37] transition-colors" onclick="toggleSidebar()">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/pma_logo.svg') }}" alt="PMA Logo" class="pma-crest">
                            <div class="hidden sm:block">
                                <h1 class="header-title text-white font-bold text-lg">Personal History Statement Online System</h1>
                                <p class="text-[#D4AF37] text-xs font-medium">Client Portal</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <div class="hidden md:block text-white text-xs">
                            <div class="font-medium" id="current-time"></div>
                            <div class="text-[#D4AF37] text-xs" id="current-date"></div>
                        </div>
                        
                        <!-- Profile Dropdown -->
                        <div class="profile-dropdown">
                            <button onclick="toggleProfileMenu()" class="flex items-center space-x-2 text-white hover:text-[#D4AF37] transition-colors">
                                <div class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center overflow-hidden">
                                    @if(auth()->user()->profile_picture)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                                             alt="Profile" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user text-[#1B365D] text-sm"></i>
                                    @endif
                                </div>
                                <span class="hidden sm:block text-sm font-medium">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="profile-menu" id="profileMenu">
                                <a href="{{ route('profile.edit') }}" class="profile-menu-item">
                                    <i class="fas fa-user-edit mr-3 text-[#1B365D]"></i>
                                    Edit Profile
                                </a>
                                <a href="{{ route('client.dashboard') }}" class="profile-menu-item">
                                    <i class="fas fa-tachometer-alt mr-3 text-[#1B365D]"></i>
                                    Dashboard
                                </a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="profile-menu-item logout w-full text-left">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="hidden lg:block text-white text-xs">
                            <span class="text-[#D4AF37]">Client</span>
                            <span class="mx-2">/</span>
                            <span>@yield('header', 'Dashboard')</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Content Area -->
            <div class="content-area w-full">
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
                            <img src="{{ asset('images/pma_logo.svg') }}" alt="PMA Logo" class="w-8 h-8 opacity-80">
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
        
        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            menu.classList.toggle('show');
        }
        
        // Close profile menu when clicking outside
        document.addEventListener('click', function(event) {
            const profileDropdown = document.querySelector('.profile-dropdown');
            const profileMenu = document.getElementById('profileMenu');
            
            if (!profileDropdown.contains(event.target)) {
                profileMenu.classList.remove('show');
            }
        });
        
        setInterval(updateDateTime, 1000); 
        updateDateTime();
        
        function toggleSidebar() { 
            const sidebar = document.querySelector('.sidebar'); 
            sidebar.classList.toggle('open'); 
        }
        
        document.addEventListener('click', function(event) { 
            const sidebar = document.querySelector('.sidebar'); 
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn'); 
            if (window.innerWidth <= 768) { 
                if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) { 
                    sidebar.classList.remove('open'); 
                } 
            } 
        });
    </script>
</body>
</html> 