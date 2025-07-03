@extends('layouts.phs-new')

@section('title', 'IX: Foreign Countries Visited')

@section('content')
    @include('phs.sections.foreign-countries-content')
    <form method="POST" action="{{ route('personnel.phs.foreign-countries.store') }}">
@endsection

@php($currentSection = 'foreign-countries') 