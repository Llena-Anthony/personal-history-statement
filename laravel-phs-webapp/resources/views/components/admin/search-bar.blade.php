@props([
    'route' => '',
    'placeholder' => 'Search...',
    'filters' => []
])

<div class="search-and-filter-system">
    <!-- Enhanced Search Bar -->
    <div class="mb-6">
        <form action="{{ $route }}" method="GET" class="flex gap-3">
            @foreach(request()->except(['search', 'page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="{{ $placeholder }}"
                    class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-200 shadow-sm hover:shadow-md">
            </div>
            
            <button type="submit" 
                class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-search mr-2"></i>
                Search
            </button>
            
            @if(request('search'))
            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                class="inline-flex items-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-times mr-2"></i>
                Clear
            </a>
            @endif
        </form>
    </div>

    <!-- Enhanced Filter Dropdown System -->
    <x-admin.filter-dropdown :filters="$filters" :route="$route" />
</div> 