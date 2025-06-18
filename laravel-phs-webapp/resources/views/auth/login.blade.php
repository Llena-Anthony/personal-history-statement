<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Personal History Statement</title>
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
        
        .input-field {
            transition: all 0.2s ease;
        }
        
        .input-field:focus {
            box-shadow: 0 0 0 4px rgba(27, 54, 93, 0.1);
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
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .slideshow img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            pointer-events: none;
        }

        .slideshow img.active {
            opacity: 1;
            z-index: 1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(27, 54, 93, 0.85), rgba(27, 54, 93, 0.75));
            z-index: 2;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Slideshow Background -->
    <div class="slideshow">
        <div class="overlay"></div>
        <img src="{{ asset('images/pmabg1.png') }}" alt="PMA Background 1" class="active">
        <img src="{{ asset('images/pmabg2.png') }}" alt="PMA Background 2">
        <img src="{{ asset('images/pmabg3.png') }}" alt="PMA Background 3">
        <img src="{{ asset('images/pmabg4.png') }}" alt="PMA Background 4">
    </div>

    <div class="w-full max-w-5xl">
        <div class="glass-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Left side - Login Form -->
                <div class="w-full lg:w-1/2 p-6 lg:p-12">
                    <div class="text-center mb-8 fade-in">
                        <h2 class="text-2xl lg:text-3xl font-semibold text-[#1B365D] mb-2">PHS Online Application System</h2>
                        <p class="text-gray-600 text-sm lg:text-base">Welcome to the Philippine Military Academy's Document Portal</p>
                    </div>
                    
                    @if(session('error'))
                    <div class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}" class="space-y-4 lg:space-y-6 fade-in" style="animation-delay: 0.1s;">
                        @csrf
                        <div>
                            <label for="username" class="block text-sm font-medium text-[#1B365D] mb-2">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                    class="input-field block w-full pl-10 pr-4 py-2.5 lg:py-3 border {{ $errors->has('username') ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 focus:ring-[#1B365D] focus:border-[#1B365D]' }} rounded-xl bg-gray-50 focus:outline-none">
                                @error('username')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                @enderror
                            </div>
                            @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-[#1B365D] mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password" required
                                    class="input-field block w-full pl-10 pr-12 py-2.5 lg:py-3 border {{ $errors->has('password') ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 focus:ring-[#1B365D] focus:border-[#1B365D]' }} rounded-xl bg-gray-50 focus:outline-none">
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                                @error('password')
                                <div class="absolute inset-y-0 right-0 pr-10 flex items-center pointer-events-none">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                @enderror
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember"
                                    class="h-4 w-4 text-[#1B365D] focus:ring-[#1B365D] border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-[#1B365D]">Remember me</label>
                            </div>

                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-[#1B365D] hover:text-[#D4AF37] transition-colors duration-200">Forgot password?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="btn-primary w-full flex justify-center py-2.5 lg:py-3 px-6 border border-transparent rounded-xl text-sm font-medium text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Sign in
                            </button>
                        </div>
                    </form>

                    <!-- PMA Links Section -->
                    <div class="mt-6 lg:mt-8 pt-4 lg:pt-6 border-t border-gray-200 fade-in" style="animation-delay: 0.2s;">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-3 lg:mb-4">Connect with Philippine Military Academy</p>
                            <div class="flex justify-center space-x-4 lg:space-x-6">
                                <a href="https://www.pma.edu.ph/" target="_blank" 
                                   class="text-[#1B365D] hover:text-[#D4AF37] transition-colors duration-200">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-globe text-base"></i>
                                        <span class="text-xs">Official Website</span>
                                    </div>
                                </a>
                                <a href="https://www.facebook.com/philippinemilitaryacademypublicaffairs/" target="_blank"
                                   class="text-[#1B365D] hover:text-[#D4AF37] transition-colors duration-200">
                                    <div class="flex items-center space-x-2">
                                        <i class="fab fa-facebook text-base"></i>
                                        <span class="text-xs">Facebook Page</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right side - Logo -->
                <div class="hidden lg:block w-1/2 bg-[#1B365D] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#1B365D]/90 to-[#1B365D]/80"></div>
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" 
                             alt="PMA Logo" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-center text-white">
                        <p class="text-sm text-gray-200">Fort Del Pilar, Baguio City, Philippines 2600</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Slideshow functionality
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.slideshow img');
        let currentImage = 0;

        function nextImage() {
            images[currentImage].classList.remove('active');
            currentImage = (currentImage + 1) % images.length;
            images[currentImage].classList.add('active');
        }

        // Set initial active image
        images[0].classList.add('active');

        // Change image every 5 seconds
        setInterval(nextImage, 5000);
    });
    </script>
</body>
</html> 