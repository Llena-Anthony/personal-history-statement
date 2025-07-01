<!DOCTYPE html>
<html lang="en">
<head>
    <style>[x-cloak] { display: none !important; }</style>
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
            /* border-radius: 0 0 2rem 2rem; */
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
            width: 280px;
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
            align-items: flex-start;
            gap: 0.75rem;
            margin: 0.75rem;
            border-radius: 1.5rem;
            position: relative;
            overflow: visible;
            border: 1px solid rgba(212, 175, 55, 0.2);
            min-height: 100px;
            max-width: calc(100% - 1.5rem);
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
            /* border: 1px solid; */
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
        
        .profile-container a {
            cursor: pointer;
            text-decoration: none;
        }
        
        .profile-container .user-info {
            flex-grow: 1;
            position: relative;
            z-index: 1;
            min-width: 0;
            max-width: calc(100% - 60px);
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
            overflow: visible;
        }
        
        .profile-container .user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.125rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            white-space: normal;
            overflow: visible;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: block;
            text-decoration: none;
            width: 100%;
            max-width: 100%;
            line-height: 1.2;
            word-wrap: break-word;
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
        
        .profile-container .user-username {
            font-size: 0.75rem;
            font-weight: 500;
            color: #D4AF37;
            margin-bottom: 0.125rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            white-space: normal;
            overflow: visible;
            width: 100%;
            max-width: 100%;
            line-height: 1.2;
            word-wrap: break-word;
        }
        
        .profile-container .user-role {
            font-size: 0.6875rem;
            color: #94a3b8;
            letter-spacing: 0.5px;
            text-transform: capitalize;
            font-weight: 400;
            white-space: normal;
            overflow: visible;
            word-wrap: break-word;
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
            max-width: calc(100vw - 300px - 1rem);
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
            /* border-radius: 2rem 2rem 0 0; */
        }

        .admin-footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #D4AF37, #B38F2A, #D4AF37);
            /* border-radius: 2rem 2rem 0 0; */
        }

        .footer-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
            /* border-radius: 2rem 2rem 0 0; */
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

        #header-breadcrumb:hover {
            box-shadow: 0 4px 16px rgba(212,175,55,0.13);
            background: linear-gradient(90deg, rgba(212,175,55,0.18) 0%, rgba(27,54,93,0.15) 100%);
        }

        .pma-switch-btn {
            margin-top: 2px;
            margin-right: 2px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #D4AF37 0%, #B38F2A 100%);
            color: #1B365D;
            border: 2px solid #D4AF37;
            border-radius: 50%;
            box-shadow: 0 2px 8px 0 rgba(212, 175, 55, 0.15);
            transition: box-shadow 0.2s, background 0.2s, color 0.2s;
            z-index: 2;
        }
        .pma-switch-btn:hover {
            background: linear-gradient(135deg, #FFD700 0%, #D4AF37 100%);
            color: #2B4B7D;
            box-shadow: 0 4px 16px 0 rgba(212, 175, 55, 0.25);
        }

        .pma-switch-btn-wrapper {
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .pma-switch-tooltip {
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%);
            color: #fffbe8;
            padding: 8px 18px;
            border-radius: 1.5rem;
            font-size: 0.92rem;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 8px 32px rgba(27, 54, 93, 0.15);
            border: 2px solid #D4AF37;
            z-index: 9999;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.18s;
            text-align: left;
            visibility: hidden;
        }
        .pma-switch-tooltip::before {
            content: '';
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 10px 10px 10px 0;
            border-style: solid;
            border-color: transparent #D4AF37 transparent transparent;
        }

        .pma-switch-btn i {
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .pma-switch-btn:hover i,
        .pma-switch-btn:focus i {
            transform: rotate(180deg);
        }

        .switch-loading-overlay {
            display: flex;
            position: fixed;
            z-index: 2147483647;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(27,54,93,0.55);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        .switch-loading-overlay.active {
            opacity: 1;
            pointer-events: all;
        }
        .switch-loading-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: scaleInSpinner 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .switch-spinner {
            border: 6px solid #FFD700;
            border-top: 6px solid #1B365D;
            border-radius: 50%;
            width: 64px;
            height: 64px;
            animation: spin 1.2s cubic-bezier(0.4,0,0.2,1) infinite;
            margin-bottom: 22px;
            box-shadow: 0 0 24px 4px #fffbe8, 0 4px 24px 0 rgba(27,54,93,0.18);
            background: transparent;
        }
        .switch-loading-text {
            color: #fffbe8;
            font-weight: 700;
            font-size: 1.25rem;
            text-shadow: 0 2px 12px #1B365D, 0 0 8px #fff;
            letter-spacing: 0.01em;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes scaleInSpinner {
            0% { transform: scale(0.7); opacity: 0; }
            60% { transform: scale(1.08); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                            <a href="{{ route('admin.dashboard') }}" class="hover:opacity-80 transition-opacity">
                                <img src="{{ asset('images/pma_logo.svg') }}" 
                                     alt="PMA Logo" 
                                     class="pma-crest select-none" draggable="false">
                            </a>
                            <div class="hidden sm:block">
                                <h1 class="header-title text-white font-bold text-lg">Personal History Statement Online System</h1>
                                <p class="text-[#D4AF37] text-xs font-medium">Administrative Portal</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <!-- Philippine Standard Time -->
                        <a href="https://oras.pagasa.dost.gov.ph/index.shtml" target="_blank" rel="noopener noreferrer" class="hidden md:block text-xs text-right hover:underline focus:underline outline-none">
                            <div class="font-bold text-white">Philippine Standard Time:</div>
                            <div id="ph-time-value-admin" class="text-yellow-400"></div>
                        </a>
                        <!-- Notifications -->
                        <button class="notification-btn text-white hover:text-[#D4AF37] transition-colors">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        <!-- Breadcrumb -->
                        <div class="hidden lg:block text-white text-xs">
                            <span class="text-[#D4AF37]">Admin</span>
                            <span class="mx-2">/</span>
                            <span id="header-breadcrumb" style="
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                min-width: 140px;
                                max-width: 220px;
                                width: 180px;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                text-align: center;
                                vertical-align: middle;
                                background: linear-gradient(90deg, rgba(212,175,55,0.13) 0%, rgba(27,54,93,0.10) 100%);
                                border: 1.5px solid #D4AF37;
                                box-shadow: 0 2px 8px rgba(27,54,93,0.07);
                                border-radius: 0.75rem;
                                padding: 4px 18px 4px 14px;
                                font-weight: 700;
                                font-size: 1.05rem;
                                color: #fffbe8;
                                letter-spacing: 0.02em;
                                transition: box-shadow 0.2s, background 0.2s;
                            ">
                                @yield('header', 'Dashboard')
                            </span>
                        </div>
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
        <!-- Sidebar -->
            <aside class="sidebar text-white flex flex-col">
            <!-- Profile Section -->
            <div class="profile-container relative">
                    <a href="{{ route('admin.profile.edit') }}" class="block">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Picture" class="profile-picture">
                    </a>
                <div class="user-info">
                        <a href="{{ route('admin.profile.edit') }}" 
                           class="user-name"
                           title="{{ Auth::user()->username }} - {{ Auth::user()->name }}">
                            {{ Auth::user()->name }}
                        </a>
                    <div class="user-username">
                        {{ '@' . Auth::user()->username }}
                    </div>
                    <div class="user-role">
                        {{ ucfirst(Auth::user()->usertype ?? 'Administrator') }}
                    </div>
                    <div class="pma-switch-btn-wrapper absolute top-0 right-0" style="margin-top:2px; margin-right:2px; z-index:2;">
                        <a href="{{ route('admin.switch.to.client') }}"
                           class="pma-switch-btn"
                           id="pmaSwitchBtn"
                           tabindex="0">
                            <i class="fas fa-repeat" style="font-size: 1rem;"></i>
                        </a>
                        <div class="pma-switch-tooltip" id="pmaSwitchTooltip">Switch to Client View<br><span style='font-weight:400;font-size:0.68em;opacity:0.85;'>Preview your PHS as a client</span></div>
                    </div>
                </div>
                </div>
                
            <!-- Navigation -->
                <div class="tab-container">
                    <div class="space-y-1">
                        <li><a href="{{ route('admin.dashboard') }}" 
                               data-route="admin.dashboard"
                               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} dynamic-nav">
                            <i class="fa-solid fa-chart-line"></i>
                            <span class="ml-3">Dashboard</span>
                        </a></li>
                        <li><a href="{{ route('admin.phs.index') }}" 
                               data-route="admin.phs.index"
                               class="nav-link {{ request()->routeIs('admin.phs.*') ? 'active' : '' }} dynamic-nav">
                            <i class="fa-regular fa-folder"></i>
                            <span class="ml-3">PHS Submissions</span>
                        </a></li>
                        <li><a href="#" class="nav-link">
                            <i class="fa-regular fa-folder"></i>
                            <span class="ml-3">PDS Submissions</span>
                        </a></li>
                        <li><a href="{{ route('admin.users.index') }}" 
                               data-route="admin.users.index"
                               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} dynamic-nav">
                            <i class="fa-regular fa-address-book"></i>
                            <span class="ml-3">User Management</span>
                        </a></li>
                        <li><a href="{{ route('admin.activity-logs.index') }}" 
                               data-route="admin.activity-logs.index"
                               class="nav-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }} dynamic-nav">
                            <i class="fas fa-history"></i>
                            <span class="ml-3">Activity Logs</span>
                        </a></li>
                        <li><a href="{{ route('admin.reports.index') }}" 
                               data-route="admin.reports.index"
                               class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }} dynamic-nav">
                            <i class="fa-regular fa-file-lines"></i>
                            <span class="ml-3">Reports</span>
                        </a></li>
                    </div>
                </div>

            <!-- Logout Section -->
                <div class="p-6 border-t border-[#2B4B7D] mt-auto relative z-10">
                <!-- Logout button removed from sidebar, now in header -->
                </div>
        </aside>

            <!-- Content Area -->
            <div class="content-area">
                <div class="content-scroll" id="mainContent">
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

    <!-- Switch Loading Overlay -->
    <div id="switchLoadingOverlay" class="switch-loading-overlay">
        <div class="switch-loading-content">
            <div class="switch-spinner"></div>
            <span class="switch-loading-text">Switching to Client View...</span>
        </div>
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

        // Dynamic Navigation System
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.dynamic-nav');
            const mainContent = document.getElementById('mainContent');
            const loadingOverlay = document.getElementById('loadingOverlay');
            let currentRoute = '{{ request()->route()->getName() }}';

            // Add click event listeners to navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const route = this.getAttribute('data-route');
                    const url = this.getAttribute('href');
                    
                    if (route && route !== currentRoute) {
                        loadContent(url, route);
                    }
                });
            });

            // Function to load content dynamically
            function loadContent(url, route) {
                // Fade out current content
                mainContent.style.opacity = '0';
                mainContent.style.transform = 'translateY(10px)';

                // Fetch new content
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html, application/xhtml+xml'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Create a temporary div to parse the HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = html;
                    
                    // Extract the content from the yield('content') section
                    const newContent = tempDiv.querySelector('#mainContent') || tempDiv.querySelector('.content-scroll') || tempDiv;
                    
                    // Update the content immediately
                    mainContent.innerHTML = newContent.innerHTML;
                    
                    // Update active navigation
                    updateActiveNav(route);
                    
                    // Update browser URL without reload
                    window.history.pushState({route: route}, '', url);
                    currentRoute = route;
                    
                    // Fade in new content
                    mainContent.style.opacity = '1';
                    mainContent.style.transform = 'translateY(0)';
                    
                    // Update page title if available
                    const titleElement = tempDiv.querySelector('title');
                    if (titleElement) {
                        document.title = titleElement.textContent;
                    }

                    // Update header breadcrumb if available
                    const newHeader = tempDiv.querySelector('#header-breadcrumb');
                    if (newHeader) {
                        const headerBreadcrumb = document.getElementById('header-breadcrumb');
                        if (headerBreadcrumb) {
                            headerBreadcrumb.textContent = newHeader.textContent;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.style.opacity = '1';
                    mainContent.style.transform = 'translateY(0)';
                });
            }

            // Function to update active navigation
            function updateActiveNav(route) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-route') === route) {
                        link.classList.add('active');
                    }
                });
            }

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function(event) {
                if (event.state && event.state.route) {
                    const link = document.querySelector(`[data-route="${event.state.route}"]`);
                    if (link) {
                        loadContent(link.getAttribute('href'), event.state.route);
                    }
                }
            });

            // Initialize content transition styles
            mainContent.style.transition = 'all 0.3s ease-in-out';
        });

        // Philippine Standard Time for admin (full date and time)
        function updatePHTimeHeaderAdmin() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
                timeZone: 'Asia/Manila'
            };
            const dateTime = now.toLocaleString('en-US', options);
            const el = document.getElementById('ph-time-value-admin');
            if (el) el.textContent = dateTime;
        }
        setInterval(updatePHTimeHeaderAdmin, 1000);
        updatePHTimeHeaderAdmin();

        // Tooltip positioning for switch button (to the right of the icon)
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('pmaSwitchBtn');
            const tooltip = document.getElementById('pmaSwitchTooltip');
            if (!btn || !tooltip) return;

            function showTooltip() {
                const rect = btn.getBoundingClientRect();
                tooltip.style.visibility = 'visible';
                tooltip.style.opacity = '1';
                // Position tooltip to the right, vertically centered to the button
                const tooltipRect = tooltip.getBoundingClientRect();
                const left = rect.right + 10; // 10px to the right of the button
                const top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                tooltip.style.left = `${left}px`;
                tooltip.style.top = `${top}px`;
            }
            function hideTooltip() {
                tooltip.style.visibility = 'hidden';
                tooltip.style.opacity = '0';
            }
            btn.addEventListener('mouseenter', showTooltip);
            btn.addEventListener('focus', showTooltip);
            btn.addEventListener('mouseleave', hideTooltip);
            btn.addEventListener('blur', hideTooltip);
        });

        // Show loading overlay on switch button click
        const switchBtn = document.getElementById('pmaSwitchBtn');
        if (switchBtn) {
            switchBtn.addEventListener('click', function(e) {
                const overlay = document.getElementById('switchLoadingOverlay');
                if (overlay) {
                    overlay.classList.add('active');
                    // Force reflow for transition
                    void overlay.offsetWidth;
                }
                // Let the navigation proceed
            });
        }
    </script>
    
    <!-- Activity Logs JavaScript -->
    @if(request()->routeIs('admin.activity-logs.*'))
        @vite(['resources/js/activity-logs.js'])
    @endif
    @stack('scripts')
</body>
</html> 