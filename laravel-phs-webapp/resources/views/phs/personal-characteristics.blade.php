@extends('layouts.phs')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">Personal Characteristics</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 py-8 sm:px-0">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <form action="{{ route('phs.personal-characteristics.store') }}" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <!-- Height -->
                                    <div>
                                        <label for="height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                                        <input type="number" name="height" id="height" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Weight -->
                                    <div>
                                        <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                        <input type="number" name="weight" id="weight" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Hair Color -->
                                    <div>
                                        <label for="hair_color" class="block text-sm font-medium text-gray-700">Hair Color</label>
                                        <input type="text" name="hair_color" id="hair_color" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Eye Color -->
                                    <div>
                                        <label for="eye_color" class="block text-sm font-medium text-gray-700">Eye Color</label>
                                        <input type="text" name="eye_color" id="eye_color" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Complexion -->
                                    <div>
                                        <label for="complexion" class="block text-sm font-medium text-gray-700">Complexion</label>
                                        <input type="text" name="complexion" id="complexion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Identifying Marks -->
                                    <div>
                                        <label for="identifying_marks" class="block text-sm font-medium text-gray-700">Identifying Marks</label>
                                        <textarea name="identifying_marks" id="identifying_marks" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end space-x-3">
                                    <a href="{{ route('phs.family-background.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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