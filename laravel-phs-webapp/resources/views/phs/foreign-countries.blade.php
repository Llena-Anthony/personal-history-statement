@extends('layouts.phs-new')

@section('title', 'IX: Foreign Countries Visited')

@section('content')
    @include('phs.sections.foreign-countries-content')
@endsection

@php($currentSection = 'foreign-countries') 