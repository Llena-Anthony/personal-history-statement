@php
    // Standardized section configuration
    $sectionName = 'educational-background';
    $sectionTitle = 'V: Educational Background';
    $sectionDescription = 'Please provide your educational history';
    $sectionIcon = 'fas fa-graduation-cap';
    $nextSection = 'military-history';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.educational-background-content')
@endsection

{{-- Pass currentSection to layout --}}
@php($currentSection = 'educational-background')

<form method="POST" action="{{ route('phs.educational-background.store') }}">
