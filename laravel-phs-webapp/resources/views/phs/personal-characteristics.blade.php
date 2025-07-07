@php
    // Standardized section configuration
    $sectionName = 'personal-characteristics';
    $sectionTitle = 'II: Personal Characteristics';
    $sectionDescription = 'Please provide your physical attributes and health information';
    $sectionIcon = 'fas fa-user-tag';
    $nextSection = 'marital-status';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.personal-characteristics-content')
@endsection

{{-- Pass currentSection to layout --}}
@php($currentSection = 'personal-characteristics') 