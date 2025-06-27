@extends('layouts.admin')

@section('title', 'Activity Log Details')
@section('header', 'Activity Log Details')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-8">
    <div class="mb-6">
        <a href="{{ route('admin.activity-logs.index') }}" class="text-[#1B365D] hover:text-[#2B4B7D] text-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Activity Logs
        </a>
    </div>
    <h2 class="text-xl font-bold mb-4">Activity Details</h2>
    <dl class="divide-y divide-gray-200">
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">User</dt>
            <dd class="text-gray-900">{{ $activityLog->user->name ?? 'N/A' }} ({{ $activityLog->user->username ?? 'N/A' }})</dd>
        </div>
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">Email</dt>
            <dd class="text-gray-900">{{ $activityLog->user->email ?? 'N/A' }}</dd>
        </div>
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">Action</dt>
            <dd class="text-gray-900"><i class="{{ $activityLog->action_icon }} text-[#1B365D] mr-2"></i>{{ ucfirst(str_replace('_', ' ', $activityLog->action)) }}</dd>
        </div>
        <div class="py-3">
            <dt class="font-medium text-gray-600 mb-2">Description</dt>
            <dd class="text-gray-900 break-words leading-relaxed">{{ $activityLog->description }}</dd>
        </div>
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">Status</dt>
            <dd class="text-gray-900">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    @if($activityLog->status === 'success') bg-green-100 text-green-800
                    @elseif($activityLog->status === 'warning') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($activityLog->status) }}
                </span>
            </dd>
        </div>
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">IP Address</dt>
            <dd class="text-gray-900">{{ $activityLog->ip_address ?? 'N/A' }}</dd>
        </div>
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">User Agent</dt>
            <dd class="text-gray-900">{{ $activityLog->user_agent ?? 'N/A' }}</dd>
        </div>
        <div class="py-3 flex justify-between">
            <dt class="font-medium text-gray-600">Date & Time</dt>
            <dd class="text-gray-900">
                <span class="time-ago" data-timestamp="{{ $activityLog->created_at->toIso8601String() }}">
                    {{ $activityLog->created_at->diffForHumans() }}
                </span>
            </dd>
        </div>
    </dl>
</div>
@endsection 