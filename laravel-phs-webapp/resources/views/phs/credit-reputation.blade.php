@php
    // Standardized section configuration
    $sectionName = 'credit-reputation';
    $sectionTitle = 'X: Credit Reputation';
    $sectionDescription = 'Please provide your credit reputation information';
    $sectionIcon = 'fas fa-credit-card';
    $nextSection = 'arrest-record';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.credit-reputation-content')
@endsection
