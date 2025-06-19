@props([
    'route' => '',
    'placeholder' => 'Search...',
    'filters' => []
])

<div class="search-and-filter-system">
    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ $route }}" method="GET" class="flex gap-2">
            @foreach(request()->except(['search', 'page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="{{ $placeholder }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#1B365D] focus:border-[#1B365D] sm:text-sm">
            </div>
            
            <button type="submit" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                Search
            </button>
            
            @if(request('search'))
            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                Clear
            </a>
            @endif
        </form>
    </div>

    <!-- Filter Dropdown System -->
    <x-admin.filter-dropdown :filters="$filters" :route="$route" />
</div> 