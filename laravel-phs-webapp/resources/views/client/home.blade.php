<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Personal History Statement</title>
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
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-[#1B365D] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" alt="PMA Logo" class="h-12 w-auto">
                    <span class="ml-3 text-white text-xl font-semibold">PHS Online System</span>
                </div>
                <div class="flex items-center">
                    <span class="text-white mr-4">Welcome, {{ Auth::user()->username }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#D4AF37] hover:bg-[#B38F2A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37]">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-[#1B365D] text-white py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Welcome to Your Document Portal</h1>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                    Access and manage your Personal History Statement (PHS) and Personal Data Sheet (PDS) applications
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- PHS Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.02] slide-in" style="animation-delay: 0.2s;">
                <div class="p-8">
                    <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mb-6 mx-auto">
                        <i class="fas fa-file-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-[#1B365D] mb-4">Personal History Statement</h3>
                    <p class="text-gray-600 text-center mb-6">
                        Complete your PHS form to provide detailed information about your personal background, education, and experience.
                    </p>
                    <div class="text-center">
                        <a href="{{ route('phs.create') }}" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                            <i class="fas fa-edit mr-2"></i>
                            Fill Out PHS
                        </a>
                    </div>
                </div>
            </div>

            <!-- PDS Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.02] slide-in" style="animation-delay: 0.4s;">
                <div class="p-8">
                    <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mb-6 mx-auto">
                        <i class="fas fa-id-card text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-[#1B365D] mb-4">Personal Data Sheet</h3>
                    <p class="text-gray-600 text-center mb-6">
                        Submit your PDS to provide essential personal and professional information for official records.
                    </p>
                    <div class="text-center">
                        <a href="{{ route('pds.create') }}" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                            <i class="fas fa-file-upload mr-2"></i>
                            Submit PDS
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PMA Information Section -->
        <div class="mt-16 bg-white rounded-xl shadow-lg overflow-hidden p-8 scale-in" style="animation-delay: 0.6s;">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-[#1B365D]">About Philippine Military Academy</h2>
                <p class="text-gray-600 mt-2">The Premier Military School in the Philippines</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <i class="fas fa-graduation-cap text-4xl text-[#1B365D] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Military Education</h3>
                    <p class="text-gray-600">Training future leaders of the Armed Forces of the Philippines</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-medal text-4xl text-[#1B365D] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Excellence</h3>
                    <p class="text-gray-600">Producing distinguished military officers since 1905</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-mountain text-4xl text-[#1B365D] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Location</h3>
                    <p class="text-gray-600">Fort Del Pilar, Baguio City, Philippines</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1B365D] text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm">© {{ date('Y') }} Philippine Military Academy. All rights reserved.</p>
                <p class="text-sm mt-2">Fort Del Pilar, Baguio City, Philippines 2600</p>
            </div>
        </div>
    </footer>
</body>
</html> 