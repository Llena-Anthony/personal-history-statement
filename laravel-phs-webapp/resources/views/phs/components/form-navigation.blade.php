@props([
    'previousRoute' => null,
    'nextRoute' => null,
    'previousText' => 'Previous Section',
    'nextText' => 'Next Section'
])

<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-4 px-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        @if($previousRoute)
            <a href="{{ $previousRoute }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg class="mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ $previousText }}
            </a>
        @else
            <div></div>
        @endif

        @if($nextRoute)
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                {{ $nextText }}
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif
    </div>
</div> 