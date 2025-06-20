@props([
    'filters' => [],
    'route' => '',
    'currentFilters' => []
])

<div class="filter-system">
    <!-- Filter Icons Bar -->
    <div class="flex items-center space-x-2 mb-4">
        <span class="text-sm font-medium text-gray-700">Filters:</span>
        
        <!-- Status Filter Icon -->
        @if(isset($filters['status']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" 
                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                <i class="fas fa-filter mr-2 text-[#1B365D]"></i>
                Status
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- Status Dropdown -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    @foreach($filters['status'] as $status => $label)
                    <a href="{{ request()->fullUrlWithQuery(['status' => $status]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- User Type Filter Icon -->
        @if(isset($filters['user_type']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" 
                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                <i class="fas fa-users mr-2 text-[#1B365D]"></i>
                User Type
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- User Type Dropdown -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    @foreach($filters['user_type'] as $type => $label)
                    <a href="{{ request()->fullUrlWithQuery(['user_type' => $type]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Date Range Filter Icon -->
        @if(isset($filters['date_range']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" 
                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                <i class="fas fa-calendar mr-2 text-[#1B365D]"></i>
                Date Range
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- Date Range Dropdown -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-1 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="p-4">
                    <form action="{{ $route }}" method="GET" class="space-y-3">
                        @foreach(request()->except(['date_from', 'date_to']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">From Date</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm transition-colors duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">To Date</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm transition-colors duration-200">
                        </div>
                        
                        <div class="flex space-x-2">
                            <button type="submit" class="flex-1 bg-[#1B365D] text-white px-3 py-2 rounded-md text-sm hover:bg-[#2B4B7D] transition-colors duration-200">
                                Apply
                            </button>
                            <a href="{{ request()->fullUrlWithQuery(['date_from' => null, 'date_to' => null]) }}" 
                                class="flex-1 bg-gray-300 text-gray-700 px-3 py-2 rounded-md text-sm hover:bg-gray-400 text-center transition-colors duration-200">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Filter Icon (for Activity Logs) -->
        @if(isset($filters['action']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" 
                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                <i class="fas fa-cogs mr-2 text-[#1B365D]"></i>
                Action
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- Action Dropdown -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    @foreach($filters['action'] as $action => $label)
                    <a href="{{ request()->fullUrlWithQuery(['action' => $action]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- User Filter Icon -->
        @if(isset($filters['user']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" 
                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                <i class="fas fa-user mr-2 text-[#1B365D]"></i>
                User
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- User Dropdown -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-1 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1 max-h-60 overflow-y-auto">
                    @foreach($filters['user'] as $user)
                    <a href="{{ request()->fullUrlWithQuery(['user_id' => $user->id]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150">
                        {{ $user->name }} ({{ $user->username }})
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Clear All Filters -->
        @if(collect(request()->except(['page', 'per_page']))->filter()->count() > 0)
        <a href="{{ $route }}" 
            class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
            <i class="fas fa-times mr-2"></i>
            Clear All
        </a>
        @endif
    </div>

    <!-- Active Filter Tags -->
    @if(collect(request()->except(['page', 'per_page']))->filter()->count() > 0)
    <div class="mb-4" x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2">
        <div class="flex flex-wrap gap-2">
            @if(request('status'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 transition-all duration-200 hover:bg-blue-200">
                Status: {{ ucfirst(request('status')) }}
                <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="ml-2 text-blue-600 hover:text-blue-800 transition-colors duration-150">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif

            @if(request('user_type'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 transition-all duration-200 hover:bg-green-200">
                User Type: {{ ucfirst(request('user_type')) }}
                <a href="{{ request()->fullUrlWithQuery(['user_type' => null]) }}" class="ml-2 text-green-600 hover:text-green-800 transition-colors duration-150">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif

            @if(request('action'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 transition-all duration-200 hover:bg-purple-200">
                Action: {{ ucfirst(str_replace('_', ' ', request('action'))) }}
                <a href="{{ request()->fullUrlWithQuery(['action' => null]) }}" class="ml-2 text-purple-600 hover:text-purple-800 transition-colors duration-150">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif

            @if(request('user_id') && isset($filters['user']))
            @php
                $selectedUser = collect($filters['user'])->firstWhere('id', request('user_id'));
            @endphp
            @if($selectedUser)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 transition-all duration-200 hover:bg-yellow-200">
                User: {{ $selectedUser->name }}
                <a href="{{ request()->fullUrlWithQuery(['user_id' => null]) }}" class="ml-2 text-yellow-600 hover:text-yellow-800 transition-colors duration-150">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
            @endif

            @if(request('date_from') || request('date_to'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800 transition-all duration-200 hover:bg-orange-200">
                Date: {{ request('date_from', 'Any') }} to {{ request('date_to', 'Any') }}
                <a href="{{ request()->fullUrlWithQuery(['date_from' => null, 'date_to' => null]) }}" class="ml-2 text-orange-600 hover:text-orange-800 transition-colors duration-150">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif

            @if(request('search'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 transition-all duration-200 hover:bg-gray-200">
                Search: "{{ request('search') }}"
                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-2 text-gray-600 hover:text-gray-800 transition-colors duration-150">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
        </div>
    </div>
    @endif
</div> 