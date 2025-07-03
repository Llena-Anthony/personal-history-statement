@extends('layouts.phs-new')

@section('title', 'III: Marital Status')

@section('content')
<form method="POST" action="{{ route('personnel.phs.marital-status.store') }}">
@include('phs.sections.marital-status-content')
</form>
@endsection 