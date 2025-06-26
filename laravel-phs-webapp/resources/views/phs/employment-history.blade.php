@extends('layouts.phs-new')

@section('title', 'VIII: Employment History')

@section('content')
    @include('phs.sections.employment-history-content')
@endsection

@php($currentSection = 'employment-history') 