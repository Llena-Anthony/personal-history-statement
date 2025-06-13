<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                Welcome, {{ $user->name }}!
            </h1>
            <p class="text-lg text-gray-600">
                Please select the form you would like to fill out
            </p>
        </div>

        <!-- Options Grid -->
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- PHS Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Personal History Statement</h2>
                    <p class="text-gray-600 mb-6 text-center">
                        Complete your detailed personal history statement for official documentation
                    </p>
                    <div class="text-center">
                        <a href="{{ route('phs.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            Start PHS Form
                        </a>
                    </div>
                </div>
            </div>

            <!-- PDS Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Personal Data Sheet</h2>
                    <p class="text-gray-600 mb-6 text-center">
                        Fill out your personal data sheet for employment and official records
                    </p>
                    <div class="text-center">
                        <a href="{{ route('pds.create') }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                            Start PDS Form
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="text-center mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-600 hover:text-gray-800 transition duration-300">
                    <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html> 