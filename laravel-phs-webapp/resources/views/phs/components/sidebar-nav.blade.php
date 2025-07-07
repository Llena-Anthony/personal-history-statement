@extends('layouts.app')

@section('title', 'Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 relative">
    <!-- Background Overlay -->
    <div class="absolute inset-0 bg-[url('/images/pma-background.jpg')] bg-cover bg-center bg-no-repeat opacity-10 blur-sm"></div>

    <div class="relative flex min-h-screen">
        <!-- Fixed Sidebar -->
        <aside class="w-72 bg-white shadow-lg fixed top-0 left-0 h-screen overflow-y-auto z-40 flex flex-col">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-gray-200 bg-white flex flex-col items-center">
                <img src="/images/profile-placeholder.png" alt="User Photo" class="w-16 h-16 rounded-full object-cover mb-2">
                <div class="text-center">
                    <h3 class="text-base font-semibold text-gray-800">Gregorio Del Pilar</h3>
                    <p class="text-xs text-gray-500">Civilian</p>
                </div>
            </div>
            <!-- Navigation -->
            <nav class="flex-1 p-6 bg-white">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('phs.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.create') ? 'bg-green-500' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">I</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.create') ? 'font-bold' : 'font-medium' }}">Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.personal-characteristics.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.personal-characteristics.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">II</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.personal-characteristics.create') ? 'font-bold' : 'font-medium' }}">Personal Characteristics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.marital-status.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.marital-status.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.marital-status.create') ? 'bg-green-500' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">III</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.marital-status.create') ? 'font-bold' : 'font-medium' }}">Marital Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.family-background.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.family-background.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.family-background.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">IV</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.family-background.create') ? 'font-bold' : 'font-medium' }}">Family History and Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.educational-background.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.educational-background.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.educational-background.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">V</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.educational-background.create') ? 'font-bold' : 'font-medium' }}">Educational Background</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.military-history.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.military-history.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.military-history.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">VI</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.military-history.create') ? 'font-bold' : 'font-medium' }}">Military History</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.places-of-residence.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.places-of-residence.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.places-of-residence.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">VII</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.places-of-residence.create') ? 'font-bold' : 'font-medium' }}">Places of Residence Since Birth</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.employment-history.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.employment-history.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.employment-history.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">VIII</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.employment-history.create') ? 'font-bold' : 'font-medium' }}">Employment History</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.foreign-countries.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.foreign-countries.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.foreign-countries.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">IX</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.foreign-countries.create') ? 'font-bold' : 'font-medium' }}">Foreign Countries Visited</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.credit-reputation.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.credit-reputation.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.credit-reputation.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">X</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.credit-reputation.create') ? 'font-bold' : 'font-medium' }}">Credit Reputation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.arrest-record.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.arrest-record.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.arrest-record.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">XI</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.arrest-record.create') ? 'font-bold' : 'font-medium' }}">Arrest Record and Conduct</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.character-and-reputation.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.character-and-reputation.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.character-and-reputation.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">XII</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.character-and-reputation.create') ? 'font-bold' : 'font-medium' }}">Character and Reputation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.organization.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.organization.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.organization.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">XIII</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.organization.create') ? 'font-bold' : 'font-medium' }}">Organization</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.miscellaneous.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.miscellaneous.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.miscellaneous.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">XIV</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.miscellaneous.create') ? 'font-bold' : 'font-medium' }}">Miscellaneous</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8 mt-16">
            @yield('main-content')
        </main>
    </div>
</div>
@endsection 