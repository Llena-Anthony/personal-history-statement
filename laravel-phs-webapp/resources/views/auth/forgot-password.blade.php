<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Personal History Statement</title>
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
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="flex w-full max-w-7xl bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Left side - Forgot Password Form -->
        <div class="w-1/2 p-16">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-4xl font-semibold text-[#1B365D] mb-3">Reset Password</h2>
                <p class="text-gray-600 text-lg">Enter your email address to receive a password reset link</p>
            </div>
            
            @if(session('status'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">Please correct the following errors:</p>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}" class="space-y-8 fade-in" style="animation-delay: 0.1s;">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-[#1B365D] mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="input-field block w-full pl-12 pr-4 py-4 border {{ $errors->has('email') ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 focus:ring-[#1B365D] focus:border-[#1B365D]' }} rounded-xl bg-gray-50 focus:outline-none">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="btn-primary w-full flex justify-center py-4 px-6 border border-transparent rounded-xl text-base font-medium text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Reset Link
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[#1B365D] hover:text-[#D4AF37] transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>

        <!-- Right side - Image -->
        <div class="w-1/2 bg-[#1B365D] relative">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1B365D]/90 to-[#1B365D]/80"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" 
                     alt="PMA Logo" 
                     class="w-full h-full object-cover">
            </div>
            <div class="absolute bottom-0 left-0 right-0 p-8 text-center text-white">
                <p class="text-sm text-gray-200">Fort Del Pilar, Baguio City, Philippines 2600</p>
            </div>
        </div>
    </div>
</body>
</html> 