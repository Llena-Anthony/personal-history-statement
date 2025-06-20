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
            font-weight: 600;
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
        .phs-layout { display: flex; flex-direction: column; height: 100vh; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); position: relative; overflow: hidden; }
        .phs-layout::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 20% 20%, rgba(27, 54, 93, 0.03) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.02) 0%, transparent 50%); pointer-events: none; }
        .phs-header { background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%); border-bottom: 3px solid transparent; background-clip: padding-box; position: relative; flex-shrink: 0; z-index: 40; box-shadow: 0 8px 32px rgba(27, 54, 93, 0.15); }
        .phs-header::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, transparent 50%, rgba(212, 175, 55, 0.05) 100%); }
        .phs-header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #D4AF37, #B38F2A, #D4AF37); border-radius: 0 0 2rem 2rem; }
        .header-content { border-radius: 0 0 2rem 2rem; position: relative; z-index: 1; }
        .pma-crest { filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3)); transition: all 0.3s ease; position: relative; width: 3.5rem; height: 3.5rem; }
        .phs-main { flex: 1; display: flex; overflow: hidden; position: relative; margin: 0.25rem; }
        .phs-sidebar { background: linear-gradient(180deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%); border: 2px solid transparent; background-clip: padding-box; position: relative; overflow: hidden; width: 320px; flex-shrink: 0; z-index: 30; border-radius: 1.5rem; box-shadow: 0 8px 32px rgba(27, 54, 93, 0.15); }
        .phs-content { flex: 1; background: white; border-radius: 1.5rem; margin-left: 0.25rem; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); overflow: hidden; display: flex; flex-direction: column; border: 1px solid rgba(212, 175, 55, 0.1); }
        .phs-scroll { flex: 1; overflow-y: auto; padding: 1.25rem 1.5rem; }
        .phs-footer { background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 50%, #1B365D 100%); border-top: 3px solid transparent; background-clip: padding-box; position: relative; flex-shrink: 0; z-index: 40; box-shadow: 0 -8px 32px rgba(27, 54, 93, 0.15); }
        .phs-footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, transparent 50%, rgba(212, 175, 55, 0.1) 100%); }
        
        /* Section Navigation Styles */
        .section-nav-item { transition: all 0.3s ease; border-radius: 0.75rem; margin-bottom: 0.5rem; }
        .section-nav-item:hover { background-color: rgba(212, 175, 55, 0.1); }
        .section-nav-item.visited { background-color: rgba(249, 115, 22, 0.2); border-left: 4px solid #f97316; }
        .section-nav-item.completed { background-color: rgba(34, 197, 94, 0.2); border-left: 4px solid #22c55e; }
        .section-nav-item.active { background: linear-gradient(135deg, rgba(212, 175, 55, 0.3) 0%, rgba(212, 175, 55, 0.1) 100%); border-left: 4px solid #D4AF37; }
        
        /* Progress Bar */
        .progress-bar { background: rgba(255, 255, 255, 0.1); border-radius: 1rem; overflow: hidden; }
        .progress-fill { background: linear-gradient(90deg, #D4AF37, #B38F2A); transition: width 0.5s ease; }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .phs-sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .phs-sidebar.open { transform: translateX(0); }
            .phs-content { margin-left: 0; }
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
        .phs-sidebar nav {
            scrollbar-width: thin;
            scrollbar-color: #D4AF37 #1B365D;
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
                            <img src="{{ asset('images/pma_logo.svg') }}" alt="PMA Logo" class="pma-crest">
                            <div class="hidden sm:block">
                                <h1 class="header-title text-white font-bold text-lg">Personal History Statement</h1>
                                <p class="text-[#D4AF37] text-xs font-medium">Complete Your PHS Form</p>
                            </div>
                        </div>
                    </div>
                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <div class="hidden md:block text-white text-xs">
                            <div class="font-medium" id="current-time"></div>
                            <div class="text-[#D4AF37] text-xs" id="current-date"></div>
                        </div>
                        <div class="hidden lg:block text-white text-xs">
                            <span class="text-[#D4AF37]">Client</span>
                            <span class="mx-2">/</span>
                            <span>PHS Form</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <div class="phs-main">
            <!-- Sidebar -->
            <aside class="phs-sidebar text-white flex flex-col" :class="{ 'open': sidebarOpen }">
                <!-- User Profile Section -->
                <div class="p-6 border-b border-[#2B4B7D] flex flex-col items-center">
                    <div class="relative mb-3">
                        <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-[#D4AF37]">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.svg') }}" alt="Profile Picture" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-check text-xs text-white"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3>
                        <p class="text-[#D4AF37] text-sm">Client</p>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="w-full mt-4">
                        <div class="flex justify-between text-xs mb-2">
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
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold"
                                             :class="getSectionIconClass(section)">
                                            <i :class="section.icon"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm" x-text="section.title"></p>
                                            <p class="text-xs text-gray-300" x-text="section.description"></p>
                                        </div>
                                    </div>
                                    <div class="w-2 h-2 rounded-full" :class="getSectionStatusClass(section)"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </nav>
                
                <!-- Action Buttons -->
                <div class="p-6 border-t border-[#2B4B7D] space-y-3">
                    <a href="{{ route('client.dashboard') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-[#D4AF37] text-sm font-medium rounded-lg text-[#D4AF37] bg-transparent hover:bg-[#D4AF37] hover:text-white transition-all duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Back to Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-400 text-sm font-medium rounded-lg text-red-400 bg-transparent hover:bg-red-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
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
    
    <script>
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
                        id: 'family-history',
                        title: 'IV: Family History',
                        description: 'Extended family',
                        icon: 'fas fa-tree',
                        route: '{{ route("phs.family-history.create") }}',
                        status: 'not-started'
                    },
                    {
                        id: 'educational-background',
                        title: 'V: Educational Background',
                        description: 'Education history',
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
                        title: 'VII: Places of Residence Since Birth',
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
                        route: '#',
                        status: 'not-started'
                    },
                    {
                        id: 'arrest-record',
                        title: 'XI: Arrest Record and Conduct',
                        description: 'Legal and conduct history',
                        icon: 'fas fa-gavel',
                        route: '#',
                        status: 'not-started'
                    },
                    {
                        id: 'employment-history-2',
                        title: 'XII: Character and Reputation',
                        description: 'Character and reputation information',
                        icon: 'fas fa-user-shield',
                        route: '#',
                        status: 'not-started'
                    },
                    {
                        id: 'organization',
                        title: 'XIII: Organization',
                        description: 'Memberships',
                        icon: 'fas fa-users-cog',
                        route: '#',
                        status: 'not-started'
                    },
                    {
                        id: 'miscellaneous',
                        title: 'XIV: Miscellaneous',
                        description: 'Other information',
                        icon: 'fas fa-ellipsis-h',
                        route: '#',
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
                        console.log('Section not yet implemented:', section.title);
                        return;
                    }
                    
                    // Load content dynamically
                    await this.loadContent(section.route, section.id);
                },
                
                async loadContent(url, sectionId) {
                    const contentArea = document.getElementById('phsContent');
                    
                    // Fade out current content
                    contentArea.style.opacity = '0';
                    contentArea.style.transform = 'translateY(10px)';
                    
                    try {
                        // Fetch new content
                        const response = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html, application/xhtml+xml'
                            }
                        });
                        
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        
                        const html = await response.text();
                        
                        // Create a temporary div to parse the HTML
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        
                        // Extract the content from the yield('content') section
                        const newContent = tempDiv.querySelector('#phsContent') || tempDiv.querySelector('.phs-scroll') || tempDiv;
                        
                        // Update the content
                        contentArea.innerHTML = newContent.innerHTML;
                        
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
                        
                        // Close sidebar on mobile
                        if (window.innerWidth <= 768) {
                            this.sidebarOpen = false;
                        }
                        
                    } catch (error) {
                        console.error('Error loading content:', error);
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
                    
                    // Mark current section as visited
                    this.markSectionAsVisited(this.currentSection);
                }
            }
        }
        
        // Update date and time
        function updateDateTime() {
            const now = new Date();
            const timeElement = document.getElementById('current-time');
            const dateElement = document.getElementById('current-date');
            if (timeElement) { timeElement.textContent = now.toLocaleTimeString('en-US', { hour12: true, hour: '2-digit', minute: '2-digit' }); }
            if (dateElement) { dateElement.textContent = now.toLocaleDateString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' }); }
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
        
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
    </script>
</body>
</html> 