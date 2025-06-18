@php
$sections = [
    'personal-details' => [
        'title' => 'Personal Details',
        'icon' => 'user',
        'status' => 'completed'
    ],
    'marital-status' => [
        'title' => 'Marital Status',
        'icon' => 'heart',
        'status' => 'pending'
    ],
    'educational-background' => [
        'title' => 'Educational Background',
        'icon' => 'academic-cap',
        'status' => 'pending'
    ],
    'military-history' => [
        'title' => 'Military History',
        'icon' => 'shield-check',
        'status' => 'pending'
    ],
    'places-of-residence' => [
        'title' => 'Places of Residence',
        'icon' => 'home',
        'status' => 'pending'
    ],
    'employment-history' => [
        'title' => 'Employment History',
        'icon' => 'briefcase',
        'status' => 'pending'
    ],
    'foreign-countries' => [
        'title' => 'Foreign Countries',
        'icon' => 'globe',
        'status' => 'pending'
    ]
];

$currentSection = request()->segment(2) ?? 'personal-details';
@endphp

@foreach($sections as $route => $section)
    <a href="{{ route('phs.' . $route . '.create') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
              {{ $currentSection === $route 
                 ? 'bg-blue-50 text-blue-700' 
                 : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
        <span class="mr-3 flex-shrink-0 h-6 w-6 flex items-center justify-center">
            @if($section['status'] === 'completed')
                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            @elseif($section['status'] === 'in-progress')
                <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            @else
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            @endif
        </span>
        {{ $section['title'] }}
    </a>
@endforeach 