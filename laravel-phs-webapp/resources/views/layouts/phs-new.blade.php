<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Personal History Statement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; margin: 0; padding: 0; overflow: hidden; height: 100vh; font-size: 14px; }
        .glass-card { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); background-color: rgba(255, 255, 255, 0.8); }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            background-color: #1B365D;
            color: white;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
            border: 1px solid transparent;
        }
        .btn-primary:hover {
            background-color: #2B4B7D;
            transform: translateY(-2px);
        }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            background-color: #f3f4f6;
            color: #1f2937;
            font-weight: 500;
            border: 1px solid #d1d5db;
            transition: background-color 0.2s, transform 0.2s;
        }
        .btn-secondary:hover {
            background-color: #e5e7eb;
            transform: translateY(-2px);
        }
        .btn-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-circle-sm {
            width: 1.75rem;
            height: 1.75rem;
            font-size: 1rem;
        }
        .btn-blue { background-color: #1B365D; color: white; }
        .btn-blue:hover { background-color: #2B4B7D; }
        .btn-red { background-color: #ef4444; color: white; font-weight: bold; }
        .btn-red:hover { background-color: #dc2626; }
        .fade-in { animation: fadeIn 0.6s ease-out; }
        .slide-in { animation: slideIn 0.6s ease-out; }
        .scale-in { animation: scaleIn 0.6s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { transform: translateX(-20px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes scaleIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .phs-layout { 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%); 
            position: relative; 
            overflow: hidden;
            opacity: 0;
            animation: fadeInLayout 0.5s ease-out forwards;
        }

        @keyframes fadeInLayout {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .phs-header { 
            background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 30%, #1B365D 70%, #2B4B7D 100%); 
            border-bottom: 3px solid transparent; 
            background-clip: padding-box; 
            position: relative; 
            flex-shrink: 0; 
            z-index: 40; 
            box-shadow: 0 8px 32px rgba(27, 54, 93, 0.2);
            animation: slideInHeader 0.4s ease-out 0.1s both;
        }

        @keyframes slideInHeader {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .phs-sidebar { 
            background: linear-gradient(180deg, #1B365D 0%, #2B4B7D 30%, #1B365D 70%, #2B4B7D 100%); 
            border: 2px solid transparent; 
            background-clip: padding-box; 
            position: relative; 
            overflow: hidden; 
            width: 320px; 
            flex-shrink: 0; 
            z-index: 30; 
            border-radius: 1.5rem; 
            box-shadow: 0 8px 32px rgba(27, 54, 93, 0.2);
            animation: slideInSidebar 0.4s ease-out 0.2s both;
        }

        @keyframes slideInSidebar {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .phs-content { 
            flex: 1; 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px); 
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08); 
            margin-left: 0.25rem; 
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); 
            overflow: hidden; 
            display: flex; 
            flex-direction: column; 
            border: 1px solid rgba(212, 175, 55, 0.1);
            animation: fadeInContent 0.4s ease-out 0.3s both;
        }

        @keyframes fadeInContent {
            from {
                opacity: 0;
                transform: scale(0.98);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .phs-layout::before { 
            content: ''; 
            position: absolute; 
            top: 0; 
            left: 0; 
            right: 0; 
            bottom: 0; 
            background: radial-gradient(circle at 20% 20%, rgba(27, 54, 93, 0.05) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.03) 0%, transparent 50%), radial-gradient(circle at 40% 60%, rgba(27, 54, 93, 0.02) 0%, transparent 50%); 
            pointer-events: none; 
        }

        .phs-header::before { 
            content: ''; 
            position: absolute; 
            top: 0; 
            left: 0; 
            right: 0; 
            bottom: 0; 
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, transparent 50%, rgba(212, 175, 55, 0.05) 100%); 
        }

        .phs-header::after { 
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

        .phs-main { 
            flex: 1; 
            display: flex; 
            overflow: hidden; 
            position: relative; 
            margin: 0.25rem; 
        }

        .phs-scroll { 
            flex: 1; 
            overflow-y: auto; 
            padding: 1.25rem 1.5rem; 
        }

        .phs-footer { 
            background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%); 
            border-top: 3px solid transparent; 
            background-clip: padding-box; 
            position: relative; 
            flex-shrink: 0; 
            z-index: 40; 
            box-shadow: 0 -8px 32px rgba(27, 54, 93, 0.15);
            animation: slideInFooter 0.4s ease-out 0.4s both;
        }

        @keyframes slideInFooter {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .phs-footer::before { 
            content: ''; 
            position: absolute; 
            top: 0; 
            left: 0; 
            right: 0; 
            bottom: 0; 
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, transparent 50%, rgba(212, 175, 55, 0.1) 100%); 
        }
        
        /* Section Navigation Styles */
        .section-nav-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            position: relative;
            overflow: hidden;
        }
        .section-nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .section-nav-item:hover::before {
            opacity: 1;
        }
        .section-nav-item.active {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.1) 100%);
            border-left: 4px solid #D4AF37;
            transform: translateX(4px);
        }
        .section-nav-item.completed {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%);
            border-left: 4px solid #22c55e;
        }
        .section-nav-item.visited {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(249, 115, 22, 0.05) 100%);
            border-left: 4px solid #f97316;
        }
        
        /* Progress Bar */
        .progress-bar {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .progress-fill {
            background: linear-gradient(90deg, #D4AF37, #B38F2A, #D4AF37);
            background-size: 200% 100%;
            animation: shimmer 2s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .phs-sidebar { 
                transform: translateX(-100%); 
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            }
            .phs-sidebar.open { 
                transform: translateX(0); 
            }
            .phs-content { 
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-scroll {
            transition: padding 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Typography */
        .header-title {
            line-height: 1.2;
            letter-spacing: -0.025em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        /* Enhanced Form Styling */
        .form-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #1B365D, #D4AF37) border-box;
        }

        .form-input:focus {
            border-color: #1B365D;
            box-shadow: 0 0 0 3px rgba(27, 54, 93, 0.1);
            transform: translateY(-1px);
        }

        /* Enhanced Card Styling */
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        /* Enhanced Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #1B365D, #2B4B7D);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #D4AF37, #B38F2A);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Section Icons */
        .section-icon {
            background: linear-gradient(135deg, #1B365D, #2B4B7D);
            color: white;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(27, 54, 93, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .section-nav-item:hover .section-icon {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(27, 54, 93, 0.3);
        }

        .section-nav-item.active .section-icon {
            background: linear-gradient(135deg, #D4AF37, #B38F2A);
            transform: scale(1.1);
        }

        /* Enhanced Profile Section */
        .profile-section {
            background: linear-gradient(135deg, rgba(27, 54, 93, 0.1), rgba(212, 175, 55, 0.05));
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .profile-avatar {
            border: 3px solid #D4AF37;
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 32px rgba(212, 175, 55, 0.4);
        }

        /* Enhanced Status Indicators */
        .status-indicator {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .status-indicator.completed {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.4);
        }

        .status-indicator.visited {
            background: linear-gradient(135deg, #f97316, #ea580c);
            box-shadow: 0 0 8px rgba(249, 115, 22, 0.4);
        }

        .status-indicator.active {
            background: linear-gradient(135deg, #D4AF37, #B38F2A);
            box-shadow: 0 0 8px rgba(212, 175, 55, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Enhanced Scrollbar */
        .phs-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .phs-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }

        .phs-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #1B365D, #D4AF37);
            border-radius: 4px;
        }

        .phs-scroll::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2B4B7D, #B38F2A);
        }

        /* Custom Scrollbar for Sidebar */
        .phs-sidebar nav::-webkit-scrollbar {
            width: 8px;
            background: #1B365D;
        }
        .phs-sidebar nav::-webkit-scrollbar-thumb {
            background: #D4AF37;
            border-radius: 4px;
        }
        .phs-sidebar nav::-webkit-scrollbar-thumb:hover {
            background: #B38F2A;
        }
        .phs-sidebar nav {
            scrollbar-width: thin;
            scrollbar-color: #D4AF37 #1B365D;
        }

        /* Enhanced Mobile Menu Button */
        .mobile-menu-btn {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.5rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .max-w-4xl.mx-auto { max-width: 900px !important; margin-left: auto; margin-right: auto; }
    </style>
</head>
<body>
    <div class="phs-layout" x-data="phsNavigation('{{ $currentSection ?? 'personal-details' }}')">
        <!-- Header -->
        <header class="phs-header">
            <div class="header-content">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Left Section -->
                    <div class="flex items-center space-x-4">
                        <button class="mobile-menu-btn lg:hidden text-white hover:text-[#D4AF37] transition-colors" @click="toggleSidebar()">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('client.dashboard') }}" class="hover:opacity-80 transition-opacity cursor-pointer">
                                <img src="{{ asset('images/pma_logo.svg') }}" alt="PMA Logo" class="pma-crest">
                            </a>
                            <div class="hidden sm:block">
                                <a href="{{ route('client.dashboard') }}" onclick="event.preventDefault(); if(window.location.pathname === '{{ url('/dashboard') }}'){ window.location.reload(); } else { window.location.href='{{ route('client.dashboard') }}'; }" class="hover:opacity-80 transition-opacity cursor-pointer">
                                    <h1 class="header-title text-white font-bold text-lg">Personal History Statement Online System</h1>
                                    <p class="text-[#D4AF37] text-xs font-medium">Complete Your PHS Form</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <div id="ph-time-header" class="text-right text-white">
                            <div style="font-weight:bold;">Philippine Standard Time:</div>
                            <div id="ph-time-value"></div>
                        </div>
                        <div class="hidden lg:block text-white text-xs">
                            <span class="text-[#D4AF37]">Client</span>
                            <span class="mx-2">/</span>
                            <span>PHS Form</span>
                        </div>
                        <!-- Logout Icon Button -->
                        <button onclick="showLogoutConfirmation()" title="Logout" class="text-white hover:text-[#D4AF37] p-2 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-[#D4AF37] ml-4">
                            <i class="fas fa-power-off text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <div class="phs-main">
            <!-- Sidebar -->
            <aside class="phs-sidebar text-white flex flex-col" :class="{ 'open': sidebarOpen }">
                <!-- User Profile Section -->
                <div class="profile-section">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="relative">
                            <a href="{{ route('profile.edit') }}">
                                <div class="w-16 h-16 rounded-full overflow-hidden profile-avatar">
                                    <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.svg') }}" alt="Profile Picture" class="w-full h-full object-cover">
                                </div>
                            </a>
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-white">{{ Auth::user()->name }}</h3>
                            <p class="text-[#D4AF37] text-sm">Client</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="w-full">
                        <div class="flex justify-between text-xs mb-2 text-white">
                            <span>Progress</span>
                            <span x-text="progressPercentage + '%'"></span>
                        </div>
                        <div class="progress-bar h-2">
                            <div class="progress-fill h-full" :style="'width: ' + progressPercentage + '%'"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Section Navigation -->
                <nav class="flex-1 p-6 overflow-y-auto">
                    <h4 class="text-[#D4AF37] font-semibold mb-4 text-sm uppercase tracking-wide">Form Sections</h4>
                    <div class="space-y-2">
                        <template x-for="section in sections" :key="section.id">
                            <div class="section-nav-item p-3 cursor-pointer" 
                                 :class="getSectionClass(section)"
                                 @click="navigateToSection(section)"
                                 :data-route="section.route">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="section-icon"
                                             :class="getSectionIconClass(section)">
                                            <i :class="section.icon"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm" x-text="section.title"></p>
                                            <p class="text-xs text-gray-300" x-text="section.description"></p>
                                        </div>
                                    </div>
                                    <div class="status-indicator" :class="getSectionStatusClass(section)"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </nav>
                
                <!-- Action Buttons -->
                <div class="p-6 border-t border-[#2B4B7D] space-y-3">
                    <button onclick="goToDashboard()" class="w-full inline-flex items-center justify-center px-4 py-2 btn-secondary rounded-lg transition-all duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Back to Dashboard
                    </button>
                </div>
            </aside>
            
            <!-- Content Area -->
            <div class="phs-content">
                <div class="phs-scroll" id="phsContent">
                    @yield('content')
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="phs-footer">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/pma_logo.svg') }}" alt="PMA Logo" class="w-8 h-8">
                        <div class="text-white text-sm">
                            <p class="font-semibold">Philippine Military Academy</p>
                            <p class="text-[#D4AF37] text-xs">Personal History Statement System</p>
                        </div>
                    </div>
                    <div class="text-white text-xs">
                        <p>&copy; {{ date('Y') }} PMA. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Dashboard Transition Overlay -->
    <div id="dashboard-transition-overlay" class="fixed inset-0 bg-[#1B365D] z-50 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-white text-center">
                <div class="mb-4">
                    <img src="{{ asset('images/pma_logo.svg') }}" 
                         alt="PMA Logo" 
                         class="w-16 h-16 mx-auto">
                </div>
                <h3 class="text-xl font-semibold">Returning to Dashboard...</h3>
            </div>
        </div>
    </div>

    <!-- Instructions Modal -->
    <div id="instructionsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="instructionsModalContent">
            <div class="p-8">
                <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mx-auto mb-6">
                    <i class="fas fa-info-circle text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#1B365D] text-center mb-4">Welcome to Your Personal History Statement</h3>
                <div class="space-y-4 text-gray-700 mb-8">
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-[#1B365D] mb-3">INSTRUCTIONS</h4>
                        <ol class="list-decimal list-inside text-base text-gray-700 space-y-3 mb-6">
                            <li>Answer all questions completely; if a question is not applicable write "NA". Write "Unknown" only if you do not know the answer and if the answer cannot be derived from personal records. Use the blank pages at the back of this form for extra details.</li>
                            <li>Type, print, or write carefully; illegible or incomplete forms will not receive due consideration.</li>
                        </ol>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-red-600 mb-3">WARNING</h4>
                        <ol class="list-decimal list-inside text-base text-gray-700 space-y-3">
                            <li>The correctness of all statements of entries made herein may be ascertained through investigation.</li>
                            <li>Any deliberate omission or distortion of information may give sufficient cause for denial of clearance and unfavorable result of the investigation.</li>
                            <li>The statements made herein are classified <span class="font-bold">CONFIDENTIAL</span>. Revelation or use other than the authorized purpose is prohibited by PMA security policy.</li>
                        </ol>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button onclick="acceptInstructions()" class="px-8 py-3 bg-[#1B365D] hover:bg-[#2B4B7D] text-white rounded-lg font-medium transition-colors">
                        I Understand, Let's Begin
                    </button>
                </div>
            </div>
        </div>
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
        // PHS Section Navigation Utility
        const PHSSectionOrder = [
            'personal-details',
            'personal-characteristics', 
            'marital-status',
            'family-background',
            'educational-background',
            'military-history',
            'places-of-residence',
            'employment-history',
            'foreign-countries',
            'credit-reputation',
            'arrest-record',
            'character-and-reputation',
            'organization',
            'miscellaneous'
        ];

        const PHSSectionRoutes = {
            'personal-details': '{{ route("phs.create") }}',
            'personal-characteristics': '{{ route("phs.personal-characteristics.create") }}',
            'marital-status': '{{ route("phs.marital-status.create") }}',
            'family-background': '{{ route("phs.family-background.create") }}',
            'educational-background': '{{ route("phs.educational-background") }}',
            'military-history': '{{ route("phs.military-history.create") }}',
            'places-of-residence': '{{ route("phs.places-of-residence.create") }}',
            'employment-history': '{{ route("phs.employment-history.create") }}',
            'foreign-countries': '{{ route("phs.foreign-countries.create") }}',
            'credit-reputation': '{{ route("phs.credit-reputation") }}',
            'arrest-record': '{{ route("phs.arrest-record") }}',
            'character-and-reputation': '{{ route("phs.character-and-reputation") }}',
            'organization': '{{ route("phs.organization") }}',
            'miscellaneous': '{{ route("phs.miscellaneous") }}'
        };

        function getNextSection(currentSection) {
            const currentIndex = PHSSectionOrder.indexOf(currentSection);
            if (currentIndex === -1 || currentIndex === PHSSectionOrder.length - 1) {
                return null; // No next section
            }
            return PHSSectionOrder[currentIndex + 1];
        }

        function getPreviousSection(currentSection) {
            const currentIndex = PHSSectionOrder.indexOf(currentSection);
            if (currentIndex <= 0) {
                return null; // No previous section
            }
            return PHSSectionOrder[currentIndex - 1];
        }

        function getSectionRoute(sectionId) {
            return PHSSectionRoutes[sectionId] || '#';
        }

        // Global function for dynamic navigation
        window.navigateToNextSection = async function(currentSection) {
            const nextSection = getNextSection(currentSection);
            
            if (!nextSection) {
                return true;
            }

            const nextRoute = getSectionRoute(nextSection);
            
            if (nextRoute === '#') {
                return false;
            }

            await saveCurrentSectionData(currentSection);

            await window.phsNavigationInstance.loadContent(nextRoute, nextSection);
            return false; // Prevent form submission
        };

        window.navigateToPreviousSection = async function(currentSection) {
            const prevSection = getPreviousSection(currentSection);
            if (!prevSection) {
                // This is the first section, go to dashboard
                window.location.href = '{{ route("client.dashboard") }}';
                return false;
            }

            const prevRoute = getSectionRoute(prevSection);
            if (prevRoute === '#') {
                return false;
            }

            // Navigate to previous section
            await window.phsNavigationInstance.loadContent(prevRoute, prevSection);
            return false; // Prevent form submission
        };

        // Global function for handling form submission
        window.handleFormSubmit = async function(event, currentSection) {
            // Prevent default form submission
            event.preventDefault();
            
            // Check if this is the last section (miscellaneous)
            if (currentSection === 'miscellaneous') {
                // For the last section, allow normal form submission with full validation
                event.target.form.submit();
                return;
            }
            
            // For intermediate sections, use dynamic navigation
            const shouldSubmit = await window.navigateToNextSection(currentSection);
            
            if (shouldSubmit) {
                event.target.form.submit();
            }
        };

        // Save current section data without validation
        async function saveCurrentSectionData(sectionId) {
            const form = document.querySelector('form');
            if (!form) {
                return;
            }

            const formData = new FormData(form);
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-Save-Only': 'true' // Custom header to indicate save-only mode
                    }
                });

                if (response.ok) {
                    // Mark section as visited
                    window.phsNavigationInstance.markSectionAsVisited(sectionId);
                }
            } catch (error) {
            }
        }

        function phsNavigation(initialSection) {
            return {
                sidebarOpen: false,
                currentSection: initialSection,
                sections: [
                    {
                        id: 'personal-details',
                        title: 'I: Personal Details',
                        description: 'Basic information',
                        icon: 'fas fa-user',
                        route: '{{ route("phs.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'personal-characteristics',
                        title: 'II: Personal Characteristics',
                        description: 'Physical attributes',
                        icon: 'fas fa-user-tag',
                        route: '{{ route("phs.personal-characteristics.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'marital-status',
                        title: 'III: Marital Status',
                        description: 'Marriage information',
                        icon: 'fas fa-heart',
                        route: '{{ route("phs.marital-status.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'family-background',
                        title: 'IV: Family Background',
                        description: 'Extended family',
                        icon: 'fas fa-tree',
                        route: '{{ route("phs.family-background.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'educational-background',
                        title: 'V: Educational Background',
                        description: 'Academic history',
                        icon: 'fas fa-graduation-cap',
                        route: '{{ route("phs.educational-background") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'military-history',
                        title: 'VI: Military History',
                        description: 'Military service',
                        icon: 'fas fa-medal',
                        route: '{{ route("phs.military-history.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'places-of-residence',
                        title: 'VII: Places of Residence',
                        description: 'Residential history',
                        icon: 'fas fa-home',
                        route: '{{ route("phs.places-of-residence.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'employment-history',
                        title: 'VIII: Employment History',
                        description: 'Work experience',
                        icon: 'fas fa-briefcase',
                        route: '{{ route("phs.employment-history.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'foreign-countries',
                        title: 'IX: Foreign Countries Visited',
                        description: 'International travel',
                        icon: 'fas fa-globe',
                        route: '{{ route("phs.foreign-countries.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'credit-reputation',
                        title: 'X: Credit Reputation',
                        description: 'Credit standing',
                        icon: 'fas fa-credit-card',
                        route: '{{ route("phs.credit-reputation") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'arrest-record',
                        title: 'XI: Arrest Record and Conduct',
                        description: 'Legal and conduct history',
                        icon: 'fas fa-gavel',
                        route: '{{ route("phs.arrest-record") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'character-and-reputation',
                        title: 'XII: Character and Reputation',
                        description: 'Character and reputation information',
                        icon: 'fas fa-user-shield',
                        route: '{{ route("phs.character-and-reputation") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'organization',
                        title: 'XIII: Organization',
                        description: 'Memberships',
                        icon: 'fas fa-users-cog',
                        route: '{{ route("phs.organization") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'miscellaneous',
                        title: 'XIV: Miscellaneous',
                        description: 'Additional information',
                        icon: 'fas fa-puzzle-piece',
                        route: '{{ route("phs.miscellaneous") }}',
                        status: 'not-started'
                    }
                ],
                
                get progressPercentage() {
                    const completed = this.sections.filter(s => s.status === 'completed').length;
                    return Math.round((completed / this.sections.length) * 100);
                },
                
                getSectionClass(section) {
                    if (section.id === this.currentSection) return 'active';
                    if (section.status === 'completed') return 'completed';
                    if (section.status === 'visited') return 'visited';
                    return '';
                },
                
                getSectionIconClass(section) {
                    if (section.id === this.currentSection) return 'bg-[#D4AF37] text-white';
                    if (section.status === 'completed') return 'bg-green-500 text-white';
                    if (section.status === 'visited') return 'bg-orange-500 text-white';
                    return 'bg-gray-600 text-white';
                },
                
                getSectionStatusClass(section) {
                    if (section.status === 'completed') return 'bg-green-500';
                    if (section.status === 'visited') return 'bg-orange-500';
                    return 'bg-gray-400';
                },
                
                async navigateToSection(section) {
                    this.currentSection = section.id;
                    if (section.status === 'not-started') {
                        section.status = 'visited';
                    }
                    
                    // Check if route is available
                    if (section.route === '#') {
                        return;
                    }
                    
                    // Load content dynamically
                    await this.loadContent(section.route, section.id);
                },
                
                async loadContent(url, sectionId) {
                    const contentArea = document.getElementById('phsContent');
                    if (!contentArea) {
                        window.location.href = url;
                        return;
                    }

                    try {
                        // Update current section immediately and trigger Alpine.js reactivity
                        this.currentSection = sectionId;
                        
                        // Force Alpine.js to update by dispatching a custom event
                        window.dispatchEvent(new CustomEvent('phs-section-changed', { 
                            detail: { sectionId: sectionId } 
                        }));
                        
                        // Mark that this is not the initial load (prevents modal from showing)
                        window.isInitialLoad = false;
                        
                        // Fade out current content
                        contentArea.style.opacity = '0.5';
                        contentArea.style.transform = 'translateY(10px)';
                        
                        // Fetch new content
                        const response = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        if (!response.ok) {
                            throw new Error('Failed to load content');
                        }
                        
                        const html = await response.text();
                        
                        // Create a temporary div to parse the HTML
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        
                        // Extract the content from the yield('content') section
                        // The AJAX response contains the full layout, so we need to find the content within it
                        let newContent = tempDiv.querySelector('#phsContent');
                        if (!newContent) {
                            // If we can't find phsContent, look for the content directly
                            newContent = tempDiv.querySelector('.max-w-4xl') || tempDiv.querySelector('main') || tempDiv.querySelector('form');
                        }
                        
                        // Update the content
                        if (newContent && newContent.innerHTML) {
                            // If we found phsContent, extract its inner content
                            if (newContent.id === 'phsContent') {
                                contentArea.innerHTML = newContent.innerHTML;
                            } else {
                                // If we found the content directly, use it
                                contentArea.innerHTML = newContent.outerHTML;
                            }
                        } else {
                            // Fallback: use the entire response
                            contentArea.innerHTML = html;
                        }
                        
                        // Update browser URL without reload
                        window.history.pushState({section: sectionId}, '', url);
                        
                        // Fade in new content
                        contentArea.style.opacity = '1';
                        contentArea.style.transform = 'translateY(0)';
                        
                        // Update page title if available
                        const titleElement = tempDiv.querySelector('title');
                        if (titleElement) {
                            document.title = titleElement.textContent;
                        }
                        
                        // Initialize section-specific functionality
                        if (sectionId === 'personal-details' && window.initializePersonalDetails) {
                            // Small delay to ensure DOM is ready
                            setTimeout(() => {
                                window.initializePersonalDetails();
                            }, 100);
                        }
                        
                        // Initialize marital status functionality
                        if (sectionId === 'marital-status') {
                            setTimeout(() => {
                                console.log('Initializing marital status section...');
                                window.initializeMaritalStatus();
                            }, 100);
                        }
                        
                        // Initialize family background functionality
                        if (sectionId === 'family-background') {
                            setTimeout(() => {
                                console.log('Initializing family background section...');
                                window.initializeFamilyBackground();
                            }, 100);
                        }
                        
                        // Initialize educational background functionality
                        if (sectionId === 'educational-background') {
                            setTimeout(() => {
                                console.log('Initializing educational background section...');
                                window.initializeEducationalBackground();
                            }, 100);
                        }
                        
                        // Initialize military history functionality
                        if (sectionId === 'military-history') {
                            setTimeout(() => {
                                console.log('Initializing military history section...');
                                window.initializeMilitaryHistory();
                            }, 100);
                        }
                        
                        // Initialize employment history functionality
                        if (sectionId === 'employment-history') {
                            setTimeout(() => {
                                console.log('Initializing employment history section...');
                                window.initializeEmploymentHistory();
                            }, 100);
                        }
                        
                        // Initialize foreign countries functionality
                        if (sectionId === 'foreign-countries') {
                            setTimeout(() => {
                                console.log('Initializing foreign countries section...');
                                window.initializeForeignCountries();
                            }, 100);
                        }
                        
                        // Initialize credit reputation functionality
                        if (sectionId === 'credit-reputation') {
                            setTimeout(() => {
                                console.log('Initializing credit reputation section...');
                                window.initializeCreditReputation();
                            }, 100);
                        }
                        
                        // Initialize arrest record functionality
                        if (sectionId === 'arrest-record') {
                            setTimeout(() => {
                                console.log('Initializing arrest record section...');
                                window.initializeArrestRecord();
                            }, 100);
                        }
                        
                        // Initialize character reputation functionality
                        if (sectionId === 'character-and-reputation') {
                            setTimeout(() => {
                                console.log('Initializing character reputation section...');
                                window.initializeCharacterReputation();
                            }, 100);
                        }
                        
                        // Initialize organization functionality
                        if (sectionId === 'organization') {
                            setTimeout(() => {
                                console.log('Initializing organization section...');
                                window.initializeOrganization();
                            }, 100);
                        }
                        
                        // Initialize miscellaneous functionality
                        if (sectionId === 'miscellaneous') {
                            setTimeout(() => {
                                console.log('Initializing miscellaneous section...');
                                window.initializeMiscellaneous();
                            }, 100);
                        }
                        
                        // Initialize places of residence functionality
                        if (sectionId === 'places-of-residence') {
                            setTimeout(() => {
                                console.log('Initializing places of residence section...');
                                window.initializePlacesOfResidence();
                            }, 100);
                        }
                        
                        // Close sidebar on mobile
                        if (window.innerWidth <= 768) {
                            this.sidebarOpen = false;
                        }
                        
                    } catch (error) {
                        // Fallback to regular navigation
                        window.location.href = url;
                    }
                },
                
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },
                
                markSectionAsCompleted(sectionId) {
                    const section = this.sections.find(s => s.id === sectionId);
                    if (section) {
                        section.status = 'completed';
                    }
                },
                
                markSectionAsVisited(sectionId) {
                    const section = this.sections.find(s => s.id === sectionId);
                    if (section && section.status === 'not-started') {
                        section.status = 'visited';
                    }
                },
                
                init() {
                    // Initialize content transition styles
                    const contentArea = document.getElementById('phsContent');
                    if (contentArea) {
                        contentArea.style.transition = 'all 0.3s ease-in-out';
                    }
                    
                    // Handle browser back/forward buttons
                    window.addEventListener('popstate', (event) => {
                        if (event.state && event.state.section) {
                            const section = this.sections.find(s => s.id === event.state.section);
                            if (section) {
                                this.navigateToSection(section);
                            }
                        }
                    });
                    
                    // Listen for section changes from AJAX navigation
                    window.addEventListener('phs-section-changed', (event) => {
                        if (event.detail && event.detail.sectionId) {
                            this.currentSection = event.detail.sectionId;
                            // Mark section as visited
                            this.markSectionAsVisited(event.detail.sectionId);
                        }
                    });
                    
                    // Mark current section as visited
                    this.markSectionAsVisited(this.currentSection);
                }
            }
        }
        
        // Initialize global navigation instance
        window.phsNavigationInstance = phsNavigation('{{ $currentSection ?? 'personal-details' }}');
        
        // Initialize the navigation instance
        document.addEventListener('DOMContentLoaded', function() {
            if (window.phsNavigationInstance) {
                window.phsNavigationInstance.init();
            }
            
            // Only show instructions on initial page load for personal-details
            @if(Route::currentRouteName() === 'phs.create')
                // Set a flag to indicate this is the initial load
                window.isInitialLoad = true;
                setTimeout(showInstructions, 500);
            @endif
        });

        // Update date and time
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

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.phs-sidebar');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Enhanced instructions modal functions
        function showInstructions() {
            // Only show instructions modal on initial page load
            if (!window.isInitialLoad) {
                return;
            }
            
            const instructionsModal = document.getElementById('instructionsModal');
            const instructionsModalContent = document.getElementById('instructionsModalContent');
            
            if (instructionsModal) {
                instructionsModal.classList.remove('hidden');
                instructionsModal.classList.add('flex');
                
                // Trigger animation
                setTimeout(() => {
                    instructionsModalContent.classList.remove('scale-95', 'opacity-0');
                    instructionsModalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
        }

        function acceptInstructions() {
            // Hide instructions modal with animation
            const instructionsModal = document.getElementById('instructionsModal');
            const instructionsModalContent = document.getElementById('instructionsModalContent');
            
            if (instructionsModalContent) {
                instructionsModalContent.classList.remove('scale-100', 'opacity-100');
                instructionsModalContent.classList.add('scale-95', 'opacity-0');
            }
            
            setTimeout(() => {
                if (instructionsModal) {
                    instructionsModal.classList.add('hidden');
                    instructionsModal.classList.remove('flex');
                }
            }, 300);
        }

        // Close instructions modal when clicking outside
        document.getElementById('instructionsModal').addEventListener('click', function(event) {
            if (event.target === this) {
                acceptInstructions();
            }
        });

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

        // Initialize date and time updates
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Dashboard transition function
        function goToDashboard() {
            const transitionOverlay = document.getElementById('dashboard-transition-overlay');
            
            // Show overlay
            transitionOverlay.classList.remove('opacity-0', 'pointer-events-none');
            transitionOverlay.classList.add('opacity-100');
            
            // Navigate after brief delay
            setTimeout(() => {
                window.location.href = '{{ route("client.dashboard") }}';
            }, 400);
        }

        window.initializeMaritalStatus = function() {
            // Dynamic child entry management
            const addChildButton = document.getElementById('add-child');
            const childrenContainer = document.getElementById('children-container');
            if (addChildButton && childrenContainer) {
                addChildButton.removeEventListener('click', addChildHandler);
                addChildButton.addEventListener('click', addChildHandler);
                childrenContainer.removeEventListener('click', removeChildHandler);
                childrenContainer.addEventListener('click', removeChildHandler);
            }
            function addChildHandler() {
                const container = document.getElementById('children-container');
                const index = container.children.length;
                const newChildEntry = `
                    <div class="child-entry p-4 border border-gray-200 rounded-lg mt-4 relative">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Child's Name</label>
                                <input type="text" name="children[${index}][name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="children[${index}][birth_date]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                <input type="text" name="children[${index}][citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <input type="text" name="children[${index}][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter address">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Father</label>
                                <input type="text" name="children[${index}][father_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter father's name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Mother</label>
                                <input type="text" name="children[${index}][mother_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter mother's name">
                            </div>
                        </div>
                        <button type="button" class="remove-child absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', newChildEntry);
            }
            function removeChildHandler(e) {
                if (e.target.closest('.remove-child')) {
                    e.target.closest('.child-entry').remove();
                }
            }
        };

        // Global function for Educational Background initialization
        window.initializeEducationalBackground = function() {
            // Helper to add entry
            function addEntry(containerId, entryClass, fields, labelPrefix) {
                const container = document.getElementById(containerId);
                const addBtn = document.getElementById('add-' + labelPrefix);
                if (!container || !addBtn) return;

                function addHandler() {
                    const entries = container.querySelectorAll('.' + entryClass);
                    const idx = entries.length;
                    const entry = document.createElement('div');
                    entry.className = entryClass + ' p-4 border border-gray-200 rounded-lg mt-4 relative';
                    entry.setAttribute('data-index', idx);
                    let html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">';
                    fields.forEach(f => {
                        html += `<div><label class='block text-sm font-medium text-gray-700 mb-2'>${f.label}</label>`;
                        if (f.type === 'select') {
                            html += `<select name='${labelPrefix}[${idx}][${f.name}]' class='w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors'>`;
                            f.options.forEach(opt => {
                                html += `<option value='${opt}'>${opt}</option>`;
                            });
                            html += `</select>`;
                        } else {
                            html += `<input type='${f.type}' name='${labelPrefix}[${idx}][${f.name}]' class='w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors' placeholder='${f.placeholder}'`;
                            if (f.min) html += ` min='${f.min}'`;
                            if (f.max) html += ` max='${f.max}'`;
                            html += '>';
                        }
                        html += '</div>';
                    });
                    html += '</div>';
                    entry.innerHTML = html + `<button type='button' class='remove-${labelPrefix} absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors'><i class='fas fa-times-circle'></i></button>`;
                    container.appendChild(entry);
                }
                function removeHandler(e) {
                    if (e.target.closest('.remove-' + labelPrefix)) {
                        const entries = container.querySelectorAll('.' + entryClass);
                        if (entries.length > 1) {
                            e.target.closest('.' + entryClass).remove();
                        }
                    }
                }
                addBtn.removeEventListener('click', addHandler);
                addBtn.addEventListener('click', addHandler);
                container.removeEventListener('click', removeHandler);
                container.addEventListener('click', removeHandler);
            }
            // Elementary
            addEntry('elementary-container', 'elementary-entry', [
                {label:'School Name', name:'school', type:'text', placeholder:'Enter school name'},
                {label:'School Address', name:'address', type:'text', placeholder:'Enter school address'},
                {label:'Year Started', name:'start', type:'number', placeholder:'YYYY', min:1900, max:2030},
                {label:'Year Graduated', name:'graduate', type:'number', placeholder:'YYYY', min:1900, max:2030}
            ], 'elementary');
            // Highschool
            addEntry('highschool-container', 'highschool-entry', [
                {label:'School Name', name:'school', type:'text', placeholder:'Enter school name'},
                {label:'School Address', name:'address', type:'text', placeholder:'Enter school address'},
                {label:'Year Started', name:'start', type:'number', placeholder:'YYYY', min:1900, max:2030},
                {label:'Year Graduated', name:'graduate', type:'number', placeholder:'YYYY', min:1900, max:2030}
            ], 'highschool');
            // College
            addEntry('college-container', 'college-entry', [
                {label:'School Name', name:'school', type:'text', placeholder:'Enter school name'},
                {label:'School Address', name:'address', type:'text', placeholder:'Enter school address'},
                {label:'Course/Degree', name:'course', type:'text', placeholder:'e.g., Bachelor of Science in Computer Science'},
                {label:'Year Level', name:'year_level', type:'text', placeholder:'Year Level'},
                {label:'Year Started', name:'start', type:'number', placeholder:'YYYY', min:1900, max:2030},
                {label:'Year Graduated', name:'graduate', type:'number', placeholder:'YYYY', min:1900, max:2030}
            ], 'college');
            // Postgraduate
            addEntry('postgraduate-container', 'postgraduate-entry', [
                {label:'School Name', name:'school', type:'text', placeholder:'Enter school name'},
                {label:'School Address', name:'address', type:'text', placeholder:'Enter school address'},
                {label:'Year Started', name:'start', type:'number', placeholder:'YYYY', min:1900, max:2030},
                {label:'Year Graduated', name:'graduate', type:'number', placeholder:'YYYY', min:1900, max:2030}
            ], 'postgraduate');
        };

        // Global function for Military History initialization
        window.initializeMilitaryHistory = function() {
            // Date type synchronization functions
            function synchronizeDateTypes(container, selectElement) {
                const type = selectElement.value;
                const dateInput = container.querySelector('input[type="date"]');
                const monthYearGroup = container.querySelector('.flex.space-x-2.hidden, .flex.space-x-2:not(.hidden)');
                
                if (type === 'exact') {
                    dateInput.classList.remove('hidden');
                    monthYearGroup.classList.add('hidden');
                } else {
                    dateInput.classList.add('hidden');
                    monthYearGroup.classList.remove('hidden');
                }
            }

            function synchronizeAssignmentDateTypes(assignmentEntry, selectElement) {
                const type = selectElement.value;
                const isFrom = selectElement.name.includes('from');
                const dateInput = assignmentEntry.querySelector(`input[name="assignments[${assignmentEntry.dataset.index}][${isFrom ? 'from' : 'to'}"]`);
                const monthYearGroup = assignmentEntry.querySelector(`#assignment-${isFrom ? 'from' : 'to'}-month-year-group-${assignmentEntry.dataset.index}`);
                
                if (type === 'exact') {
                    dateInput.classList.remove('hidden');
                    monthYearGroup.classList.add('hidden');
                } else {
                    dateInput.classList.add('hidden');
                    monthYearGroup.classList.remove('hidden');
                }
            }

            function synchronizeSchoolDateTypes(schoolEntry, selectElement) {
                const type = selectElement.value;
                const isFrom = selectElement.name.includes('from');
                const dateInput = schoolEntry.querySelector(`input[name="schools[${schoolEntry.dataset.index}][date_attended_${isFrom ? 'from' : 'to'}"]`);
                const monthYearGroup = schoolEntry.querySelector(`#school-date-${isFrom ? 'from' : 'to'}-month-year-group-${schoolEntry.dataset.index}`);
                
                if (type === 'exact') {
                    dateInput.classList.remove('hidden');
                    monthYearGroup.classList.add('hidden');
                } else {
                    dateInput.classList.add('hidden');
                    monthYearGroup.classList.remove('hidden');
                }
            }

            // Initialize date type synchronization for existing elements
            const enlistmentDateType = document.querySelector('select[name="enlistment_date_type"]');
            const commissionDateFromType = document.querySelector('select[name="commission_date_from_type"]');
            const commissionDateToType = document.querySelector('select[name="commission_date_to_type"]');

            if (enlistmentDateType) {
                enlistmentDateType.addEventListener('change', function() {
                    synchronizeDateTypes(this.closest('.flex.space-x-2'), this);
                });
            }

            if (commissionDateFromType) {
                commissionDateFromType.addEventListener('change', function() {
                    synchronizeDateTypes(this.closest('.flex.space-x-2'), this);
                });
            }

            if (commissionDateToType) {
                commissionDateToType.addEventListener('change', function() {
                    synchronizeDateTypes(this.closest('.flex.space-x-2'), this);
                });
            }

            // Initialize existing assignment date types
            document.querySelectorAll('.assignment-entry').forEach(entry => {
                const fromTypeSelect = entry.querySelector('select[name*="from_type"]');
                const toTypeSelect = entry.querySelector('select[name*="to_type"]');
                
                if (fromTypeSelect) {
                    fromTypeSelect.addEventListener('change', function() {
                        synchronizeAssignmentDateTypes(entry, this);
                    });
                }
                
                if (toTypeSelect) {
                    toTypeSelect.addEventListener('change', function() {
                        synchronizeAssignmentDateTypes(entry, this);
                    });
                }
            });

            // Initialize existing school date types
            document.querySelectorAll('.school-entry').forEach(entry => {
                const fromTypeSelect = entry.querySelector('select[name*="from_type"]');
                const toTypeSelect = entry.querySelector('select[name*="to_type"]');
                
                if (fromTypeSelect) {
                    fromTypeSelect.addEventListener('change', function() {
                        synchronizeSchoolDateTypes(entry, this);
                    });
                }
                
                if (toTypeSelect) {
                    toTypeSelect.addEventListener('change', function() {
                        synchronizeSchoolDateTypes(entry, this);
                    });
                }
            });

            // Assignments functionality
            const assignmentsContainer = document.getElementById('assignments-container');
            const addAssignmentBtn = document.getElementById('add-assignment');

            if (addAssignmentBtn && assignmentsContainer) {
                addAssignmentBtn.removeEventListener('click', addAssignmentHandler);
                addAssignmentBtn.addEventListener('click', addAssignmentHandler);
                assignmentsContainer.removeEventListener('click', removeAssignmentHandler);
                assignmentsContainer.addEventListener('click', removeAssignmentHandler);
            }

            function addAssignmentHandler() {
                const entries = assignmentsContainer.querySelectorAll('.assignment-entry');
                const idx = entries.length;
                const assignmentEntry = document.createElement('div');
                assignmentEntry.className = 'assignment-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                assignmentEntry.setAttribute('data-index', idx);
                assignmentEntry.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                            <div class="flex space-x-2">
                                <select name="assignments[${idx}][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="assignments[${idx}][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="assignment-from-month-year-group-${idx}">
                                    <select name="assignments[${idx}][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="assignments[${idx}][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                            <div class="flex space-x-2">
                                <select name="assignments[${idx}][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="assignments[${idx}][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="assignment-to-month-year-group-${idx}">
                                    <select name="assignments[${idx}][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="assignments[${idx}][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit/Office</label>
                            <input type="text" name="assignments[${idx}][unit_office]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter unit or office">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CO/Chief of Office</label>
                            <input type="text" name="assignments[${idx}][co_chief]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter CO or Chief of Office">
                        </div>
                    </div>
                    <button type="button" class="remove-assignment absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                assignmentsContainer.appendChild(assignmentEntry);

                // Add event listeners for the new assignment date type selects
                const newAssignmentFromTypeSelect = assignmentEntry.querySelector(`select[name="assignments[${idx}][from_type]"]`);
                const newAssignmentToTypeSelect = assignmentEntry.querySelector(`select[name="assignments[${idx}][to_type]"]`);
                
                newAssignmentFromTypeSelect.addEventListener('change', function() {
                    synchronizeAssignmentDateTypes(assignmentEntry, this);
                });
                
                newAssignmentToTypeSelect.addEventListener('change', function() {
                    synchronizeAssignmentDateTypes(assignmentEntry, this);
                });
            }

            function removeAssignmentHandler(e) {
                if (e.target.closest('.remove-assignment')) {
                    const entries = assignmentsContainer.querySelectorAll('.assignment-entry');
                    if (entries.length > 1) {
                        e.target.closest('.assignment-entry').remove();
                    }
                }
            }

            // Military Schools functionality
            const schoolsContainer = document.getElementById('schools-container');
            const addSchoolBtn = document.getElementById('add-school');

            if (addSchoolBtn && schoolsContainer) {
                addSchoolBtn.removeEventListener('click', addSchoolHandler);
                addSchoolBtn.addEventListener('click', addSchoolHandler);
                schoolsContainer.removeEventListener('click', removeSchoolHandler);
                schoolsContainer.addEventListener('click', removeSchoolHandler);
            }

            function addSchoolHandler() {
                const entries = schoolsContainer.querySelectorAll('.school-entry');
                const idx = entries.length;
                const schoolEntry = document.createElement('div');
                schoolEntry.className = 'school-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                schoolEntry.setAttribute('data-index', idx);
                schoolEntry.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                            <input type="text" name="schools[${idx}][school]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="schools[${idx}][location]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school location">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance (From)</label>
                            <div class="flex space-x-2">
                                <select name="schools[${idx}][date_attended_from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="schools[${idx}][date_attended_from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="school-date-from-month-year-group-${idx}">
                                    <select name="schools[${idx}][date_attended_from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="schools[${idx}][date_attended_from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance (To)</label>
                            <div class="flex space-x-2">
                                <select name="schools[${idx}][date_attended_to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="schools[${idx}][date_attended_to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="school-date-to-month-year-group-${idx}">
                                    <select name="schools[${idx}][date_attended_to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="schools[${idx}][date_attended_to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                            <input type="text" name="schools[${idx}][nature_training]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter nature of training">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <input type="text" name="schools[${idx}][rating]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter rating">
                        </div>
                    </div>
                    <button type="button" class="remove-school absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                schoolsContainer.appendChild(schoolEntry);

                // Add event listeners for the new school date type selects
                const newSchoolFromTypeSelect = schoolEntry.querySelector(`select[name="schools[${idx}][date_attended_from_type]"]`);
                const newSchoolToTypeSelect = schoolEntry.querySelector(`select[name="schools[${idx}][date_attended_to_type]"]`);
                
                newSchoolFromTypeSelect.addEventListener('change', function() {
                    synchronizeSchoolDateTypes(schoolEntry, this);
                });
                
                newSchoolToTypeSelect.addEventListener('change', function() {
                    synchronizeSchoolDateTypes(schoolEntry, this);
                });
            }

            function removeSchoolHandler(e) {
                if (e.target.closest('.remove-school')) {
                    const entries = schoolsContainer.querySelectorAll('.school-entry');
                    if (entries.length > 1) {
                        e.target.closest('.school-entry').remove();
                    }
                }
            }

            // Awards functionality
            const awardsContainer = document.getElementById('awards-container');
            const addAwardBtn = document.getElementById('add-award');

            if (addAwardBtn && awardsContainer) {
                addAwardBtn.removeEventListener('click', addAwardHandler);
                addAwardBtn.addEventListener('click', addAwardHandler);
                awardsContainer.removeEventListener('click', removeAwardHandler);
                awardsContainer.addEventListener('click', removeAwardHandler);
            }

            function addAwardHandler() {
                const entries = awardsContainer.querySelectorAll('.award-entry');
                const idx = entries.length;
                const awardEntry = document.createElement('div');
                awardEntry.className = 'award-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                awardEntry.setAttribute('data-index', idx);
                awardEntry.innerHTML = `
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <input type="text" name="awards[${idx}][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter award or decoration name">
                        </div>
                    </div>
                    <button type="button" class="remove-award absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                awardsContainer.appendChild(awardEntry);
            }

            function removeAwardHandler(e) {
                if (e.target.closest('.remove-award')) {
                    const entries = awardsContainer.querySelectorAll('.award-entry');
                    if (entries.length > 1) {
                        e.target.closest('.award-entry').remove();
                    }
                }
            }
        };

        // Global function for Places of Residence initialization
        window.initializePlacesOfResidence = function() {
            // Residence History functionality
            const residencesContainer = document.getElementById('residences-container');
            const addResidenceBtn = document.getElementById('add-residence');

            if (addResidenceBtn && residencesContainer) {
                addResidenceBtn.removeEventListener('click', addResidenceHandler);
                addResidenceBtn.addEventListener('click', addResidenceHandler);
                residencesContainer.removeEventListener('click', removeResidenceHandler);
                residencesContainer.addEventListener('click', removeResidenceHandler);
            }

            function addResidenceHandler() {
                const entries = residencesContainer.querySelectorAll('.residence-entry');
                const idx = entries.length;
                const residenceEntry = document.createElement('div');
                residenceEntry.className = 'residence-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                residenceEntry.setAttribute('data-index', idx);
                residenceEntry.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From (Year)</label>
                            <input type="number" name="residences[${idx}][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                            <input type="number" name="residences[${idx}][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="residences[${idx}][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                        </div>
                    </div>
                    <button type="button" class="remove-residence absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                residencesContainer.appendChild(residenceEntry);
            }

            function removeResidenceHandler(e) {
                if (e.target.closest('.remove-residence')) {
                    const entries = residencesContainer.querySelectorAll('.residence-entry');
                    if (entries.length > 1) {
                        e.target.closest('.residence-entry').remove();
                    }
                }
            }
        };

        // Global function for Employment History initialization
        window.initializeEmploymentHistory = function() {
            // Function to handle employment date type changes
            function handleEmploymentDateTypeChange(selectElement, isFrom = true) {
                const entry = selectElement.closest('.employment-entry');
                const index = entry.getAttribute('data-index');
                const dateInput = entry.querySelector(`input[name="employment[${index}][${isFrom ? 'from' : 'to'}"]`);
                const monthYearGroup = entry.querySelector(`#employment-${isFrom ? 'from' : 'to'}-month-year-group-${index}`);
                
                if (selectElement.value === 'exact') {
                    dateInput.classList.remove('hidden');
                    monthYearGroup.classList.add('hidden');
                } else {
                    dateInput.classList.add('hidden');
                    monthYearGroup.classList.remove('hidden');
                }
            }

            // Function to synchronize employment date types for a specific entry
            function synchronizeEmploymentDateTypes(entry, changedSelect) {
                const index = entry.getAttribute('data-index');
                const fromSelect = entry.querySelector(`select[name="employment[${index}][from_type]"]`);
                const toSelect = entry.querySelector(`select[name="employment[${index}][to_type]"]`);
                
                console.log('Synchronizing employment dates for entry', index, ':', {
                    changedSelect: changedSelect.name,
                    fromSelectValue: fromSelect.value,
                    toSelectValue: toSelect.value
                });
                
                if (changedSelect === fromSelect) {
                    toSelect.value = fromSelect.value;
                    console.log('Updated "to" select to:', toSelect.value);
                } else {
                    fromSelect.value = toSelect.value;
                    console.log('Updated "from" select to:', fromSelect.value);
                }
                
                // Always update both UI states after synchronization
                const fromDateInput = entry.querySelector(`input[name="employment[${index}][from]"]`);
                const fromMonthYearGroup = entry.querySelector(`#employment-from-month-year-group-${index}`);
                const toDateInput = entry.querySelector(`input[name="employment[${index}][to]"]`);
                const toMonthYearGroup = entry.querySelector(`#employment-to-month-year-group-${index}`);
                
                if (fromSelect.value === 'exact') {
                    fromDateInput.classList.remove('hidden');
                    fromMonthYearGroup.classList.add('hidden');
                    toDateInput.classList.remove('hidden');
                    toMonthYearGroup.classList.add('hidden');
                } else {
                    fromDateInput.classList.add('hidden');
                    fromMonthYearGroup.classList.remove('hidden');
                    toDateInput.classList.add('hidden');
                    toMonthYearGroup.classList.remove('hidden');
                }
            }

            // Add event listeners for initial employment date type selects
            const initialEmploymentFromTypeSelect = document.querySelector('select[name="employment[0][from_type]"]');
            const initialEmploymentToTypeSelect = document.querySelector('select[name="employment[0][to_type]"]');
            const initialEmploymentEntry = document.querySelector('.employment-entry[data-index="0"]');
            
            if (initialEmploymentFromTypeSelect && initialEmploymentEntry) {
                initialEmploymentFromTypeSelect.removeEventListener('change', function() {
                    synchronizeEmploymentDateTypes(initialEmploymentEntry, this);
                });
                initialEmploymentFromTypeSelect.addEventListener('change', function() {
                    synchronizeEmploymentDateTypes(initialEmploymentEntry, this);
                });
            }
            
            if (initialEmploymentToTypeSelect && initialEmploymentEntry) {
                initialEmploymentToTypeSelect.removeEventListener('change', function() {
                    synchronizeEmploymentDateTypes(initialEmploymentEntry, this);
                });
                initialEmploymentToTypeSelect.addEventListener('change', function() {
                    synchronizeEmploymentDateTypes(initialEmploymentEntry, this);
                });
            }

            // Employment Entries functionality
            const employmentContainer = document.getElementById('employment-entries');
            const addEmploymentBtn = document.getElementById('add-employment');

            if (addEmploymentBtn && employmentContainer) {
                addEmploymentBtn.removeEventListener('click', addEmploymentHandler);
                addEmploymentBtn.addEventListener('click', addEmploymentHandler);
                employmentContainer.removeEventListener('click', removeEmploymentHandler);
                employmentContainer.addEventListener('click', removeEmploymentHandler);
            }

            function addEmploymentHandler() {
                const entries = employmentContainer.querySelectorAll('.employment-entry');
                const idx = entries.length;
                const employmentEntry = document.createElement('div');
                employmentEntry.className = 'employment-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                employmentEntry.setAttribute('data-index', idx);
                employmentEntry.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                            <div class="flex space-x-2">
                                <select name="employment[${idx}][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="employment[${idx}][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="employment-from-month-year-group-${idx}">
                                    <select name="employment[${idx}][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="employment[${idx}][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                            <div class="flex space-x-2">
                                <select name="employment[${idx}][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="employment[${idx}][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="employment-to-month-year-group-${idx}">
                                    <select name="employment[${idx}][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="employment[${idx}][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type of Employment</label>
                            <input type="text" name="employment[${idx}][type]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employment type">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name of Employer</label>
                            <input type="text" name="employment[${idx}][employer_name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address of Employer</label>
                            <input type="text" name="employment[${idx}][employer_address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Leaving</label>
                            <input type="text" name="employment[${idx}][reason_leaving]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter reason for leaving">
                        </div>
                    </div>
                    <button type="button" class="remove-employment absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                employmentContainer.appendChild(employmentEntry);

                // Add event listeners for the new employment date type selects
                const newEmploymentFromTypeSelect = employmentEntry.querySelector(`select[name="employment[${idx}][from_type]"]`);
                const newEmploymentToTypeSelect = employmentEntry.querySelector(`select[name="employment[${idx}][to_type]"]`);
                
                newEmploymentFromTypeSelect.addEventListener('change', function() {
                    synchronizeEmploymentDateTypes(employmentEntry, this);
                });
                
                newEmploymentToTypeSelect.addEventListener('change', function() {
                    synchronizeEmploymentDateTypes(employmentEntry, this);
                });
            }

            function removeEmploymentHandler(e) {
                if (e.target.closest('.remove-employment')) {
                    const entries = employmentContainer.querySelectorAll('.employment-entry');
                    if (entries.length > 1) {
                        e.target.closest('.employment-entry').remove();
                    }
                }
            }

            // Dismissal select logic
            const dismissedSelect = document.getElementById('dismissed-select');
            if (dismissedSelect) {
                dismissedSelect.removeEventListener('change', function() {
                    const explanation = document.getElementById('dismissed-explanation');
                    explanation.classList.toggle('hidden', this.value !== 'yes');
                });
                dismissedSelect.addEventListener('change', function() {
                    const explanation = document.getElementById('dismissed-explanation');
                    explanation.classList.toggle('hidden', this.value !== 'yes');
                });
            }
        };

        // Global function for Foreign Countries initialization
        window.initializeForeignCountries = function() {
            // Function to handle country date type changes
            function handleCountryDateTypeChange(selectElement, isFrom = true) {
                const entry = selectElement.closest('.country-entry');
                const index = entry.getAttribute('data-index');
                const dateInput = entry.querySelector(`input[name="countries[${index}][${isFrom ? 'from' : 'to'}"]`);
                const monthYearGroup = entry.querySelector(`#country-${isFrom ? 'from' : 'to'}-month-year-group-${index}`);
                
                if (selectElement.value === 'exact') {
                    dateInput.classList.remove('hidden');
                    monthYearGroup.classList.add('hidden');
                } else {
                    dateInput.classList.add('hidden');
                    monthYearGroup.classList.remove('hidden');
                }
            }

            // Function to synchronize country date types for a specific entry
            function synchronizeCountryDateTypes(entry, changedSelect) {
                const index = entry.getAttribute('data-index');
                const fromSelect = entry.querySelector(`select[name="countries[${index}][from_type]"]`);
                const toSelect = entry.querySelector(`select[name="countries[${index}][to_type]"]`);
                
                console.log('Synchronizing country dates for entry', index, ':', {
                    changedSelect: changedSelect.name,
                    fromSelectValue: fromSelect.value,
                    toSelectValue: toSelect.value
                });
                
                if (changedSelect === fromSelect) {
                    toSelect.value = fromSelect.value;
                    console.log('Updated "to" select to:', toSelect.value);
                } else {
                    fromSelect.value = toSelect.value;
                    console.log('Updated "from" select to:', fromSelect.value);
                }
                
                // Always update both UI states after synchronization
                const fromDateInput = entry.querySelector(`input[name="countries[${index}][from]"]`);
                const fromMonthYearGroup = entry.querySelector(`#country-from-month-year-group-${index}`);
                const toDateInput = entry.querySelector(`input[name="countries[${index}][to]"]`);
                const toMonthYearGroup = entry.querySelector(`#country-to-month-year-group-${index}`);
                
                if (fromSelect.value === 'exact') {
                    fromDateInput.classList.remove('hidden');
                    fromMonthYearGroup.classList.add('hidden');
                    toDateInput.classList.remove('hidden');
                    toMonthYearGroup.classList.add('hidden');
                } else {
                    fromDateInput.classList.add('hidden');
                    fromMonthYearGroup.classList.remove('hidden');
                    toDateInput.classList.add('hidden');
                    toMonthYearGroup.classList.remove('hidden');
                }
            }

            // Add event listeners for initial country date type selects
            const initialCountryFromTypeSelect = document.querySelector('select[name="countries[0][from_type]"]');
            const initialCountryToTypeSelect = document.querySelector('select[name="countries[0][to_type]"]');
            const initialCountryEntry = document.querySelector('.country-entry[data-index="0"]');
            
            if (initialCountryFromTypeSelect && initialCountryEntry) {
                initialCountryFromTypeSelect.removeEventListener('change', function() {
                    synchronizeCountryDateTypes(initialCountryEntry, this);
                });
                initialCountryFromTypeSelect.addEventListener('change', function() {
                    synchronizeCountryDateTypes(initialCountryEntry, this);
                });
            }
            
            if (initialCountryToTypeSelect && initialCountryEntry) {
                initialCountryToTypeSelect.removeEventListener('change', function() {
                    synchronizeCountryDateTypes(initialCountryEntry, this);
                });
                initialCountryToTypeSelect.addEventListener('change', function() {
                    synchronizeCountryDateTypes(initialCountryEntry, this);
                });
            }

            const countriesContainer = document.getElementById('countries');
            const addCountryBtn = document.getElementById('add-country');

            if (addCountryBtn && countriesContainer) {
                addCountryBtn.removeEventListener('click', addCountryHandler);
                addCountryBtn.addEventListener('click', addCountryHandler);
                countriesContainer.removeEventListener('click', removeCountryHandler);
                countriesContainer.addEventListener('click', removeCountryHandler);
            }

            function addCountryHandler() {
                const entries = countriesContainer.querySelectorAll('.country-entry');
                const idx = entries.length;
                const countryEntry = document.createElement('div');
                countryEntry.className = 'country-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                countryEntry.setAttribute('data-index', idx);
                countryEntry.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Visit (From)</label>
                            <div class="flex space-x-2">
                                <select name="countries[${idx}][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="countries[${idx}][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="country-from-month-year-group-${idx}">
                                    <select name="countries[${idx}][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="countries[${idx}][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Visit (To)</label>
                            <div class="flex space-x-2">
                                <select name="countries[${idx}][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="countries[${idx}][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="country-to-month-year-group-${idx}">
                                    <select name="countries[${idx}][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="countries[${idx}][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Country Visited</label>
                            <input type="text" name="countries[${idx}][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter country visited">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Visit</label>
                            <input type="text" name="countries[${idx}][purpose]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter purpose of visit">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Abroad</label>
                            <input type="text" name="countries[${idx}][address_abroad]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter address abroad">
                        </div>
                    </div>
                    <button type="button" class="remove-country absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                countriesContainer.appendChild(countryEntry);

                // Add event listeners for the new country date type selects
                const newCountryFromTypeSelect = countryEntry.querySelector(`select[name="countries[${idx}][from_type]"]`);
                const newCountryToTypeSelect = countryEntry.querySelector(`select[name="countries[${idx}][to_type]"]`);
                
                newCountryFromTypeSelect.addEventListener('change', function() {
                    synchronizeCountryDateTypes(countryEntry, this);
                });
                
                newCountryToTypeSelect.addEventListener('change', function() {
                    synchronizeCountryDateTypes(countryEntry, this);
                });
            }

            function removeCountryHandler(e) {
                if (e.target.closest('.remove-country')) {
                    const entries = countriesContainer.querySelectorAll('.country-entry');
                    if (entries.length > 1) {
                        e.target.closest('.country-entry').remove();
                    }
                }
            }
        };

        // Global function for Credit Reputation initialization
        window.initializeCreditReputation = function() {
            // This section uses Alpine.js for dynamic functionality
            // The Alpine.js component 'creditReputationForm' handles all the dynamic behavior
            // including adding/removing income sources and bank accounts
            console.log('Credit Reputation section initialized');
        };

        // Global function for Miscellaneous initialization
        window.initializeMiscellaneous = function() {
            const addLanguageBtn = document.getElementById('add-language');
            const languagesContainer = document.getElementById('languages-container');
            const finishBtn = document.getElementById('finishBtn');
            const form = finishBtn ? finishBtn.closest('form') : null;
            const modal = document.getElementById('redirectModal');
            const secondsSpan = document.getElementById('redirectSeconds');
            let submitted = false;

            // Add language row functionality
            if (addLanguageBtn && languagesContainer) {
                addLanguageBtn.removeEventListener('click', addLanguageHandler);
                addLanguageBtn.addEventListener('click', addLanguageHandler);
            }

            // Remove language row functionality
            if (languagesContainer) {
                languagesContainer.removeEventListener('click', removeLanguageHandler);
                languagesContainer.addEventListener('click', removeLanguageHandler);
            }

            // Finish button functionality
            if (finishBtn) {
                finishBtn.removeEventListener('click', finishHandler);
                finishBtn.addEventListener('click', finishHandler);
            }

            function addLanguageHandler(e) {
                e.preventDefault();
                e.stopPropagation();
                const entries = languagesContainer.querySelectorAll('.language-entry');
                const idx = entries.length;
                const newRow = document.createElement('div');
                newRow.className = 'language-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                newRow.setAttribute('data-index', idx);
                newRow.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Language/Dialect</label>
                            <input type="text" name="languages[${idx}][language]" placeholder="e.g., English, Tagalog, Spanish" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Speak</label>
                            <select name="languages[${idx}][speak]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Select</option>
                                <option value="FLUENT">FLUENT</option>
                                <option value="FAIR">FAIR</option>
                                <option value="POOR">POOR</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Read</label>
                            <select name="languages[${idx}][read]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Select</option>
                                <option value="FLUENT">FLUENT</option>
                                <option value="FAIR">FAIR</option>
                                <option value="POOR">POOR</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Write</label>
                            <select name="languages[${idx}][write]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Select</option>
                                <option value="FLUENT">FLUENT</option>
                                <option value="FAIR">FAIR</option>
                                <option value="POOR">POOR</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="remove-language absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors">
                        <i class="fas fa-times-circle"></i>
                    </button>
                `;
                languagesContainer.appendChild(newRow);
            }

            function removeLanguageHandler(e) {
                if (e.target.closest('.remove-language')) {
                    const entries = languagesContainer.querySelectorAll('.language-entry');
                    if (entries.length > 1) {
                        e.target.closest('.language-entry').remove();
                    }
                }
            }

            function finishHandler(e) {
                if (submitted) return; // Prevent double submission
                submitted = true;
                e.preventDefault();
                finishBtn.disabled = true;

                // Show modal and start timer
                if (modal) {
                    modal.style.display = 'flex';
                    let seconds = 5;
                    if (secondsSpan) secondsSpan.textContent = seconds;
                    let countdown = setInterval(() => {
                        seconds--;
                        if (secondsSpan) secondsSpan.textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(countdown);
                            if (form) form.submit(); // Submit the form as normal
                        }
                    }, 1000);
                } else if (form) {
                    form.submit();
                }
            }

            console.log('Miscellaneous section initialized');
        };

        // Global function for Personal Details initialization
        window.initializePersonalDetails = function() {
            loadRegions();
            setupAddressEventListeners();
            console.log('Personal Details section initialized');
        };

        // Philippines Address API Integration
        async function loadRegions() {
            try {
                const response = await fetch('https://psgc.gitlab.io/api/regions/');
                const regions = await response.json();
                
                const homeRegionSelect = document.getElementById('home_region');
                const businessRegionSelect = document.getElementById('business_region');
                
                if (homeRegionSelect && businessRegionSelect) {
                    // Clear existing options except the first one
                    homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
                    businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
                    
                    regions.forEach(region => {
                        const homeOption = new Option(region.name, region.code);
                        const businessOption = new Option(region.name, region.code);
                        homeRegionSelect.add(homeOption);
                        businessRegionSelect.add(businessOption);
                    });
                }
            } catch (error) {
                console.error('Error loading regions:', error);
                // Fallback: Add common regions manually
                const commonRegions = [
                    'National Capital Region (NCR)',
                    'Cordillera Administrative Region (CAR)',
                    'Ilocos Region (Region I)',
                    'Cagayan Valley (Region II)',
                    'Central Luzon (Region III)',
                    'CALABARZON (Region IV-A)',
                    'MIMAROPA (Region IV-B)',
                    'Bicol Region (Region V)',
                    'Western Visayas (Region VI)',
                    'Central Visayas (Region VII)',
                    'Eastern Visayas (Region VIII)',
                    'Zamboanga Peninsula (Region IX)',
                    'Northern Mindanao (Region X)',
                    'Davao Region (Region XI)',
                    'SOCCSKSARGEN (Region XII)',
                    'Caraga (Region XIII)',
                    'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)'
                ];
                
                const homeRegionSelect = document.getElementById('home_region');
                const businessRegionSelect = document.getElementById('business_region');
                
                if (homeRegionSelect && businessRegionSelect) {
                    // Clear existing options except the first one
                    homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
                    businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
                    
                    commonRegions.forEach(region => {
                        const homeOption = new Option(region, region);
                        const businessOption = new Option(region, region);
                        homeRegionSelect.add(homeOption);
                        businessRegionSelect.add(businessOption);
                    });
                }
            }
        }

        async function loadProvinces(type) {
            const regionSelect = document.getElementById(`${type}_region`);
            const provinceSelect = document.getElementById(`${type}_province`);
            const citySelect = document.getElementById(`${type}_city`);
            const barangaySelect = document.getElementById(`${type}_barangay`);
            
            if (!regionSelect || !provinceSelect || !citySelect || !barangaySelect) return;
            
            // Reset dependent dropdowns
            provinceSelect.innerHTML = '<option value="">Select Province</option>';
            citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            
            if (!regionSelect.value) return;
            
            try {
                const response = await fetch(`https://psgc.gitlab.io/api/regions/${regionSelect.value}/provinces/`);
                const provinces = await response.json();
                
                provinces.forEach(province => {
                    const option = new Option(province.name, province.code);
                    provinceSelect.add(option);
                });
            } catch (error) {
                console.error('Error loading provinces:', error);
                // Fallback: Add common provinces for selected region
                const commonProvinces = getCommonProvinces(regionSelect.value);
                commonProvinces.forEach(province => {
                    const option = new Option(province, province);
                    provinceSelect.add(option);
                });
            }
            
            updateCompleteAddress(type);
        }

        async function loadCities(type) {
            const provinceSelect = document.getElementById(`${type}_province`);
            const citySelect = document.getElementById(`${type}_city`);
            const barangaySelect = document.getElementById(`${type}_barangay`);
            
            if (!provinceSelect || !citySelect || !barangaySelect) return;
            
            // Reset dependent dropdowns
            citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            
            if (!provinceSelect.value) return;
            
            try {
                const response = await fetch(`https://psgc.gitlab.io/api/provinces/${provinceSelect.value}/cities-municipalities/`);
                const cities = await response.json();
                
                cities.forEach(city => {
                    const option = new Option(city.name, city.code);
                    citySelect.add(option);
                });
            } catch (error) {
                console.error('Error loading cities:', error);
                // Fallback: Add common cities
                const commonCities = ['City/Municipality 1', 'City/Municipality 2', 'City/Municipality 3'];
                commonCities.forEach(city => {
                    const option = new Option(city, city);
                    citySelect.add(option);
                });
            }
            
            updateCompleteAddress(type);
        }

        async function loadBarangays(type) {
            const citySelect = document.getElementById(`${type}_city`);
            const barangaySelect = document.getElementById(`${type}_barangay`);
            
            if (!citySelect || !barangaySelect) return;
            
            // Reset barangay dropdown
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            
            if (!citySelect.value) return;
            
            try {
                const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${citySelect.value}/barangays/`);
                const barangays = await response.json();
                
                barangays.forEach(barangay => {
                    const option = new Option(barangay.name, barangay.code);
                    barangaySelect.add(option);
                });
            } catch (error) {
                console.error('Error loading barangays:', error);
                // Fallback: Add common barangays
                const commonBarangays = ['Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5'];
                commonBarangays.forEach(barangay => {
                    const option = new Option(barangay, barangay);
                    barangaySelect.add(option);
                });
            }
            
            updateCompleteAddress(type);
        }

        function updateCompleteAddress(type) {
            const regionSelect = document.getElementById(`${type}_region`);
            const provinceSelect = document.getElementById(`${type}_province`);
            const citySelect = document.getElementById(`${type}_city`);
            const barangaySelect = document.getElementById(`${type}_barangay`);
            const streetInput = document.getElementById(`${type}_street`);
            const displayElement = document.getElementById(`${type}_complete_address`);
            const inputElement = document.getElementById(`${type}_complete_address_input`);

            if (!regionSelect || !provinceSelect || !citySelect || !barangaySelect || !streetInput || !displayElement || !inputElement) return;

            const street = streetInput.value;

            // Use the selected option's text (name), not value (code)
            const region = regionSelect && regionSelect.selectedIndex > 0 ? regionSelect.options[regionSelect.selectedIndex].text : '';
            const province = provinceSelect && provinceSelect.selectedIndex > 0 ? provinceSelect.options[provinceSelect.selectedIndex].text : '';
            const city = citySelect && citySelect.selectedIndex > 0 ? citySelect.options[citySelect.selectedIndex].text : '';
            const barangay = barangaySelect && barangaySelect.selectedIndex > 0 ? barangaySelect.options[barangaySelect.selectedIndex].text : '';

            let completeAddress = '';
            if (street) completeAddress += street + ', ';
            if (barangay) completeAddress += barangay + ', ';
            if (city) completeAddress += city + ', ';
            if (province) completeAddress += province + ', ';
            if (region) completeAddress += region;

            if (completeAddress.endsWith(', ')) {
                completeAddress = completeAddress.slice(0, -2);
            }

            if (completeAddress) {
                displayElement.textContent = completeAddress;
                inputElement.value = completeAddress;
            } else {
                displayElement.textContent = 'Address will be displayed here...';
                inputElement.value = '';
            }
        }

        // Helper function for common provinces (fallback)
        function getCommonProvinces(region) {
            const provinceMap = {
                'National Capital Region (NCR)': ['Metro Manila'],
                'Cordillera Administrative Region (CAR)': ['Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province'],
                'Ilocos Region (Region I)': ['Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'],
                'Cagayan Valley (Region II)': ['Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'],
                'Central Luzon (Region III)': ['Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'],
                'CALABARZON (Region IV-A)': ['Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal'],
                'MIMAROPA (Region IV-B)': ['Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'],
                'Bicol Region (Region V)': ['Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon'],
                'Western Visayas (Region VI)': ['Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo', 'Negros Occidental'],
                'Central Visayas (Region VII)': ['Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'],
                'Eastern Visayas (Region VIII)': ['Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte'],
                'Zamboanga Peninsula (Region IX)': ['Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'],
                'Northern Mindanao (Region X)': ['Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental'],
                'Davao Region (Region XI)': ['Compostela Valley', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental'],
                'SOCCSKSARGEN (Region XII)': ['Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat'],
                'Caraga (Region XIII)': ['Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur'],
                'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)': ['Basilan', 'Lanao del Sur', 'Maguindanao', 'Sulu', 'Tawi-Tawi']
            };
            
            return provinceMap[region] || ['Province 1', 'Province 2', 'Province 3'];
        }

        // Setup event listeners for address functionality
        function setupAddressEventListeners() {
            ['home', 'business'].forEach(type => {
                const streetInput = document.getElementById(`${type}_street`);
                if (streetInput) {
                    // Remove existing listeners to prevent duplicates
                    streetInput.removeEventListener('input', () => updateCompleteAddress(type));
                    streetInput.addEventListener('input', () => updateCompleteAddress(type));
                }
                
                const barangaySelect = document.getElementById(`${type}_barangay`);
                if (barangaySelect) {
                    // Remove existing listeners to prevent duplicates
                    barangaySelect.removeEventListener('change', () => updateCompleteAddress(type));
                    barangaySelect.addEventListener('change', () => updateCompleteAddress(type));
                }
            });
        }

        window.initializePersonalCharacteristics = function() {
            // No dynamic JS needed for personal characteristics
        };

        window.initializeFamilyBackground = function() {
            const siblingsContainer = document.getElementById('siblings-container');
            
            // Add event listener for removing siblings
            if (siblingsContainer) {
                siblingsContainer.removeEventListener('click', removeSiblingHandler);
                siblingsContainer.addEventListener('click', removeSiblingHandler);
            }

            // Load existing siblings if any, or add one default entry
            loadExistingSiblings();

            console.log('Family Background section initialized');
        };

        // Global function to add sibling (called from the form)
        window.addSibling = function() {
            const siblingsContainer = document.getElementById('siblings-container');
            if (!siblingsContainer) return;

            const entries = siblingsContainer.querySelectorAll('.sibling-entry');
            const idx = entries.length;
            
            const siblingEntry = document.createElement('div');
            siblingEntry.className = 'sibling-entry bg-gray-50 p-4 border border-gray-200 rounded-lg relative';
            siblingEntry.setAttribute('data-index', idx);
            siblingEntry.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="siblings[${idx}][first_name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                        <input type="text" name="siblings[${idx}][middle_name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="siblings[${idx}][last_name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" name="siblings[${idx}][date_of_birth]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                        <input type="text" name="siblings[${idx}][citizenship]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship (if any)</label>
                        <input type="text" name="siblings[${idx}][dual_citizenship]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter dual citizenship">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                        <input type="text" name="siblings[${idx}][complete_address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                        <input type="text" name="siblings[${idx}][occupation]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                        <input type="text" name="siblings[${idx}][employer]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Employer Address</label>
                        <input type="text" name="siblings[${idx}][employer_address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer address">
                    </div>
                </div>
                <button type="button" class="remove-sibling absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors">
                    <i class="fas fa-times-circle"></i>
                </button>
            `;
            siblingsContainer.appendChild(siblingEntry);
        };

        function removeSiblingHandler(e) {
            if (e.target.closest('.remove-sibling')) {
                const entries = document.querySelectorAll('.sibling-entry');
                if (entries.length > 1) {
                    e.target.closest('.sibling-entry').remove();
                }
            }
        }

        function loadExistingSiblings() {
            // Always add at least one default sibling entry
            const siblingsContainer = document.getElementById('siblings-container');
            if (siblingsContainer) {
                // If no siblings exist, add one default entry
                if (siblingsContainer.children.length === 0) {
                    window.addSibling();
                }
            }
        }

        window.initializeArrestRecord = function() {
            // No dynamic JS needed for arrest record
        };

        window.initializeCharacterReferences = function() {
            // No dynamic JS needed for character references
        };

        function updatePHTimeHeader() {
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
            const el = document.getElementById('ph-time-value');
            if (el) el.textContent = dateTime;
        }
        setInterval(updatePHTimeHeader, 1000);
        updatePHTimeHeader();
    </script>
</body>
</html> 