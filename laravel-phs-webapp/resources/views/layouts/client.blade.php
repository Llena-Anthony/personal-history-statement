<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Personal History Statement</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/pma_logo.svg') }}">
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
                border-radius: 1rem;
            }
            .content-scroll {
                padding: 1rem;
            }
            .header-title {
                font-size: 1rem;
            }
            .pma-crest {
                width: 2.5rem;
                height: 2.5rem;
            }
        }

        @media (max-width: 640px) {
            .content-scroll {
                padding: 0.75rem;
            }
            .header-title {
                font-size: 0.875rem;
            }
        }

        /* Enhanced Responsive Design */
        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Smooth Transitions */
        .content-area {
            transition: all 0.3s ease-in-out;
        }

        .content-scroll {
            transition: padding 0.3s ease-in-out;
        }

        /* Enhanced Typography */
        .header-title {
            line-height: 1.2;
            letter-spacing: -0.025em;
        }

        /* Better Focus States */
        button:focus, a:focus {
            outline: 2px solid #D4AF37;
            outline-offset: 2px;
        }

        /* Improved Hover Effects */
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(27, 54, 93, 0.15);
        }

        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                            <a href="{{ route('client.dashboard') }}" class="hover:opacity-80 transition-opacity">
                                <img src="{{ asset('images/pma_logo.svg') }}" alt="PMA Logo" class="pma-crest select-none" draggable="false">
                            </a>
                            <div class="hidden sm:block">
                                <h1 class="header-title text-white font-bold text-lg">Personal History Statement Online System</h1>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <a href="https://oras.pagasa.dost.gov.ph/index.shtml" target="_blank" rel="noopener noreferrer" class="hidden md:block text-white text-xs hover:underline focus:underline outline-none">
                            <div id="ph-time-header-client" class="text-right">
                                <div style="font-weight:bold;">Philippine Standard Time:</div>
                                <div id="ph-time-value-client"></div>
                            </div>
                        </a>
                        <!-- User Avatar and Name (no dropdown) -->
                        <!-- Removed user avatar/profile picture and name from header -->
                        <div class="hidden lg:block text-white text-xs flex items-center gap-2">
                            <span class="text-[#D4AF37]">Client</span>
                            <span class="mx-2">/</span>
                            <span>@yield('header', 'Dashboard')</span>
                            @if(session('admin_switched_to_client'))
                            <span class="ml-2 px-2 py-1 bg-blue-600 text-white text-xs rounded-full font-medium flex items-center">
                                <i class="fas fa-user-shield mr-1"></i>Admin PHS
                            </span>
                            @endif
                        </div>
                        
                        <!-- Return to Admin Button (only show if admin switched to client) -->
                        @if(session('admin_switched_to_client'))
                        <a href="{{ route('return.to.admin') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-sm font-medium rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Return to Admin
                        </a>
                        @endif
                        
                        <!-- Logout Icon Button -->
                        <button onclick="showLogoutConfirmation()" title="Logout" class="text-white hover:text-[#D4AF37] p-2 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-[#D4AF37] ml-4">
                            <i class="fas fa-power-off text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Content Area -->
            <div class="content-area w-full">
                <div class="content-scroll">
                    <!-- Success Messages -->
                    @if(session('success'))
                    <div id="success-message" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg transition-opacity duration-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            var msg = document.getElementById('success-message');
                            if (msg) {
                                msg.style.opacity = '0';
                                setTimeout(function() { msg.style.display = 'none'; }, 500);
                            }
                        }, 3000);
                    </script>
                    @endif
                    
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
                            <a href="https://www.google.com/maps/place/Philippine+Military+Academy+(PMA)/@16.3595363,120.6175352,17z/data=!4m10!1m2!2m1!1sPMA!3m6!1s0x3391a140001b5169:0x3e6e8c0c41cfb35a!8m2!3d16.360888!4d120.619414!15sCgNQTUGSAQ9taWxpdGFyeV9zY2hvb2yqASoQATIdEAEiGVhxt5fJUUiIqeZ8vr3CUEe_6KFeKT8HghAyBxACIgNwbWHgAQA!16zL20vMDhwbmY1?entry=ttu&g_ep=EgoyMDI1MDYyMy4yIKXMDSoASAFQAw%3D%3D" 
                               target="_blank" 
                               class="mt-1 hover:text-[#D4AF37] transition-colors duration-200 cursor-pointer">
                                Fort Del Pilar, Baguio City, Philippines
                            </a>
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
    
    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="logoutModalContent">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mx-auto mb-4">
                    <i class="fas fa-power-off text-2xl text-red-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Confirm Logout</h3>
                <p class="text-gray-600 text-center mb-6">Are you sure you want to log out of your account?</p>
                <div class="flex space-x-3">
                    <button onclick="hideLogoutConfirmation()" class="flex-1 px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
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

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }

        // Logout confirmation functions
        function showLogoutConfirmation() {
            const modal = document.getElementById('logoutModal');
            const modalContent = document.getElementById('logoutModalContent');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Trigger animation
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideLogoutConfirmation() {
            const modal = document.getElementById('logoutModal');
            const modalContent = document.getElementById('logoutModalContent');
            
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('logoutModal').addEventListener('click', function(event) {
            if (event.target === this) {
                hideLogoutConfirmation();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideLogoutConfirmation();
            }
        });

        // Update date and time every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        function updatePHTimeHeaderClient() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
                timeZone: 'Asia/Manila'
            };
            const dateTime = now.toLocaleString('en-US', options);
            const el = document.getElementById('ph-time-value-client');
            if (el) el.textContent = dateTime;
        }
        setInterval(updatePHTimeHeaderClient, 1000);
        updatePHTimeHeaderClient();
    </script>
</body>
</html> 