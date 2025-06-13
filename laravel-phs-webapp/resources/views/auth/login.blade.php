<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Personal History Statement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Left side - Login Form -->
            <div class="w-1/2 p-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-[#1B365D]">PHS Online Application System</h2>
                    <p class="text-gray-600 mt-2">Please sign in to your account</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-[#1B365D]">Username</label>
                        <input type="text" name="username" id="username" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#1B365D] focus:border-[#1B365D]">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-[#1B365D]">Password</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#1B365D] focus:border-[#1B365D]">
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-[#1B365D] focus:ring-[#1B365D] border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-[#1B365D]">Remember me</label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-[#1B365D] hover:text-[#D4AF37]">Forgot password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                            Sign in
                        </button>
                    </div>
                </form>

                <!-- PMA Links Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-4">Connect with Philippine Military Academy</p>
                        <div class="flex justify-center space-x-6">
                            <a href="https://www.pma.edu.ph/" target="_blank" 
                               class="text-[#1B365D] hover:text-[#D4AF37] transition-colors duration-200">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-globe text-lg"></i>
                                    <span class="text-sm">Official Website</span>
                                </div>
                            </a>
                            <a href="https://www.facebook.com/philippinemilitaryacademypublicaffairs/" target="_blank"
                               class="text-[#1B365D] hover:text-[#D4AF37] transition-colors duration-200">
                                <div class="flex items-center space-x-2">
                                    <i class="fab fa-facebook text-lg"></i>
                                    <span class="text-sm">Facebook Page</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Image -->
            <div class="w-1/2 bg-[#1B365D] relative">
                <div class="absolute inset-0 bg-gradient-to-b from-[#1B365D]/50 to-[#1B365D]/80"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" 
                         alt="PMA Logo" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 text-center text-white z-10">
                    <p class="text-sm text-gray-200">Fort Del Pilar, Baguio City, Philippines 2600</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 