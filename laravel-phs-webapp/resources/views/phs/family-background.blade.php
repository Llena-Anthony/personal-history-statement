@extends('layouts.phs')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">Family Background</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 py-8 sm:px-0">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <form action="{{ route('phs.family-background.store') }}" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <!-- Father's Information -->
                                    <div class="border-b border-gray-200 pb-6">
                                        <h3 class="text-lg font-medium text-gray-900">Father's Information</h3>
                                        <div class="mt-4 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                            <div class="sm:col-span-3">
                                                <label for="father_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                                <input type="text" name="father_last_name" id="father_last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label for="father_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                                <input type="text" name="father_first_name" id="father_first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label for="father_middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                                                <input type="text" name="father_middle_name" id="father_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label for="father_occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                                                <input type="text" name="father_occupation" id="father_occupation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mother's Information -->
                                    <div class="border-b border-gray-200 pb-6">
                                        <h3 class="text-lg font-medium text-gray-900">Mother's Information</h3>
                                        <div class="mt-4 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                            <div class="sm:col-span-3">
                                                <label for="mother_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                                <input type="text" name="mother_last_name" id="mother_last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label for="mother_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                                <input type="text" name="mother_first_name" id="mother_first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label for="mother_middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                                                <input type="text" name="mother_middle_name" id="mother_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label for="mother_occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                                                <input type="text" name="mother_occupation" id="mother_occupation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end space-x-3">
                                    <a href="{{ route('phs.personal-characteristics') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Previous
                                    </a>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Next
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 