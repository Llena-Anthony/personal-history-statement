@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-4">
            <img src="{{ asset('images/pma-logo.png') }}" alt="PMA Logo" class="h-16 mx-auto">
            <h2 class="mt-4 text-lg font-semibold text-center text-gray-800">Personal History Statement</h2>
        </div>
        <nav class="mt-4">
            <a href="{{ route('phs.create') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                I. Personal Information
            </a>
            <a href="{{ route('phs.family-background.create') }}" class="block px-4 py-2 text-white bg-blue-600">
                II. Family Background
            </a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                III. Educational Background
            </a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                IV. Civil Service Eligibility
            </a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                V. Work Experience
            </a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                VI. Voluntary Work
            </a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                VII. Learning and Development
            </a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                VIII. Other Information
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">II. Family Background</h1>

                <form action="{{ route('phs.family-background.store') }}" method="POST">
                    @csrf

                    <!-- Spouse Information -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Spouse Information (Optional)</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" name="spouse_first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" name="spouse_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" name="spouse_last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Suffix</label>
                                <input type="text" name="spouse_suffix" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Occupation</label>
                                <input type="text" name="spouse_occupation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Employer/Business Name</label>
                                <input type="text" name="spouse_employer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Business Address</label>
                                <input type="text" name="spouse_business_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telephone No.</label>
                                <input type="text" name="spouse_telephone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Father's Information -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Father's Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" name="father_first_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" name="father_middle_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" name="father_last_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Suffix</label>
                                <input type="text" name="father_suffix" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Mother's Information -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Mother's Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" name="mother_first_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" name="mother_middle_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" name="mother_last_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Suffix</label>
                                <input type="text" name="mother_suffix" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Children Information -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Children Information (Optional)</h2>
                            <button type="button" id="addChild" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Add Child
                            </button>
                        </div>
                        <div id="childrenContainer">
                            <!-- Child entries will be added here -->
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('phs.create') }}" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Previous
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Save and Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addChildButton = document.getElementById('addChild');
        const childrenContainer = document.getElementById('childrenContainer');
        let childCount = 0;

        addChildButton.addEventListener('click', function() {
            const childDiv = document.createElement('div');
            childDiv.className = 'mb-4 p-4 border rounded-md';
            childDiv.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-md font-medium text-gray-700">Child ${childCount + 1}</h3>
                    <button type="button" class="text-red-600 hover:text-red-800" onclick="this.parentElement.parentElement.remove()">
                        Remove
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="children[${childCount}][full_name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="children[${childCount}][date_of_birth]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            `;
            childrenContainer.appendChild(childDiv);
            childCount++;
        });
    });
</script>
@endpush
@endsection 