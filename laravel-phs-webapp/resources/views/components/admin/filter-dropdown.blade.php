@props([
    'filters' => [],
    'route' => '',
    'currentFilters' => []
])

<div class="filter-system">
    <!-- Enhanced Filter Icons Bar -->
    <div class="flex items-center flex-wrap gap-3 mb-6">
        <span class="text-sm font-semibold text-gray-700 flex items-center">
            <i class="fas fa-filter mr-2 text-blue-500"></i>
            Filters:
        </span>
        
        <!-- Status Filter Icon -->
        @if(isset($filters['status']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:shadow-md">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                Status
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- Status Dropdown -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-2 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 border border-gray-200">
                <div class="py-2">
                    @foreach($filters['status'] as $status => $label)
                    <a href="{{ request()->fullUrlWithQuery(['status' => $status]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150">
                        <i class="fas fa-circle mr-2 text-xs 
                            @if($status === 'active' || $status === 'success') text-green-500
                            @elseif($status === 'disabled' || $status === 'inactive' || $status === 'warning') text-red-500
                            @elseif($status === 'error') text-red-600
                            @else text-gray-500
                            @endif"></i>
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
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:shadow-md">
                <i class="fas fa-users mr-2 text-blue-500"></i>
                User Type
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- User Type Dropdown -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-2 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 border border-gray-200">
                <div class="py-2">
                    @foreach($filters['user_type'] as $type => $label)
                    <a href="{{ request()->fullUrlWithQuery(['user_type' => $type]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150">
                        <i class="fas fa-user mr-2 text-blue-400"></i>
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
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:shadow-md">
                <i class="fas fa-calendar mr-2 text-purple-500"></i>
                Date Range
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- Date Range Dropdown -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-2 w-80 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>
                        Select Date Range
                    </h3>
                    <form action="{{ $route }}" method="GET" class="space-y-4">
                        @foreach(request()->except(['date_from', 'date_to']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200">
                        </div>
                        
                        <div class="flex space-x-3 pt-2">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-xl text-sm hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-check mr-2"></i>
                                Apply
                            </button>
                            <a href="{{ request()->fullUrlWithQuery(['date_from' => null, 'date_to' => null]) }}" 
                                class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-sm hover:bg-gray-200 text-center transition-all duration-200">
                                <i class="fas fa-times mr-2"></i>
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
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:shadow-md">
                <i class="fas fa-cogs mr-2 text-orange-500"></i>
                Action
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- Action Dropdown -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-2 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 border border-gray-200">
                <div class="py-2">
                    @foreach($filters['action'] as $action => $label)
                    <a href="{{ request()->fullUrlWithQuery(['action' => $action]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 transition-colors duration-150">
                        <i class="fas fa-cog mr-2 text-orange-400"></i>
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
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:shadow-md">
                <i class="fas fa-user mr-2 text-indigo-500"></i>
                User
                <i class="fas fa-chevron-down ml-2 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            
            <!-- User Dropdown -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="open = false" 
                class="absolute z-10 mt-2 w-64 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 border border-gray-200">
                <div class="py-2 max-h-60 overflow-y-auto">
                    @foreach($filters['user'] as $user)
                    <a href="{{ request()->fullUrlWithQuery(['user_id' => $user->id]) }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-150">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-semibold mr-3">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-medium">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->username }}</div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Clear All Filters -->
        @if(collect(request()->except(['page', 'per_page']))->filter()->count() > 0)
        <a href="{{ $route }}" 
            class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-xl text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 hover:shadow-md">
            <i class="fas fa-times mr-2"></i>
            Clear All
        </a>
        @endif
    </div>

    <!-- Active Filters Display -->
    @if(collect(request()->except(['page', 'per_page']))->filter()->count() > 0)
    <div class="mb-6">
        <div class="flex items-center flex-wrap gap-2">
            <span class="text-sm font-medium text-gray-700">Active Filters:</span>
            
            @if(request('search'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                Search: "{{ request('search') }}"
                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
            
            @if(request('status'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Status: {{ $filters['status'][request('status')] ?? request('status') }}
                <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="ml-2 text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
            
            @if(request('user_type'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                User Type: {{ $filters['user_type'][request('user_type')] ?? request('user_type') }}
                <a href="{{ request()->fullUrlWithQuery(['user_type' => null]) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
            
            @if(request('action'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                Action: {{ $filters['action'][request('action')] ?? request('action') }}
                <a href="{{ request()->fullUrlWithQuery(['action' => null]) }}" class="ml-2 text-orange-600 hover:text-orange-800">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
            
            @if(request('date_from') || request('date_to'))
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                Date: {{ request('date_from') }} - {{ request('date_to') }}
                <a href="{{ request()->fullUrlWithQuery(['date_from' => null, 'date_to' => null]) }}" class="ml-2 text-purple-600 hover:text-purple-800">
                    <i class="fas fa-times"></i>
                </a>
            </span>
            @endif
        </div>
    </div>
    @endif
</div> 