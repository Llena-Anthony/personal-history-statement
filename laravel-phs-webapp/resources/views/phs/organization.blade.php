@extends('layouts.phs-new')

@section('title', 'XIII: Organization')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Organization</h1>
                <p class="text-gray-600">List all organizations you are or have been a member of.</p>
            </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('phs.organization.store') }}" class="space-y-8">
        @csrf
        
        <!-- Organization Entries -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-building mr-3 text-[#D4AF37]"></i>
                    Organization Entries
                </h3>
            </div>
            <div id="organizations" class="space-y-4">
                <!-- Initial organization entry (default, not removable) -->
                <div class="organization-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                            <input type="text" name="organizations[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter organization name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="organizations[0][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter organization address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Membership</label>
                            <div class="flex space-x-2">
                                <select name="organizations[0][month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="">Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <input type="number" name="organizations[0][year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Position Held</label>
                            <input type="text" name="organizations[0][position]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter position held">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-organization" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Organization
            </button>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('organization')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'organization')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
// Global function that can be called from AJAX navigation
window.initializeOrganization = function() {
    // Organization Entries functionality
    const organizationContainer = document.getElementById('organizations');
    const addOrganizationBtn = document.getElementById('add-organization');

    // Add organization button click handler
    if (addOrganizationBtn) {
        // Remove existing event listeners to prevent duplicates
        addOrganizationBtn.removeEventListener('click', addOrganizationHandler);
        addOrganizationBtn.addEventListener('click', addOrganizationHandler);
    }

    // Remove organization entry
    // Remove existing event listeners to prevent duplicates
    organizationContainer.removeEventListener('click', removeOrganizationHandler);
    organizationContainer.addEventListener('click', removeOrganizationHandler);
};

// Organization addition handler
function addOrganizationHandler(e) {
    e.preventDefault();
    
    const organizationContainer = document.getElementById('organizations');
    const organizationEntry = document.createElement('div');
    const orgIndex = organizationContainer.querySelectorAll('.organization-entry').length;
    
    organizationEntry.className = 'organization-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
    organizationEntry.setAttribute('data-index', orgIndex);
    organizationEntry.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                <input type="text" name="organizations[${orgIndex}][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter organization name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" name="organizations[${orgIndex}][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter organization address">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Membership</label>
                <div class="flex space-x-2">
                    <select name="organizations[${orgIndex}][month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <option value="">Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <input type="number" name="organizations[${orgIndex}][year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Position Held</label>
                <input type="text" name="organizations[${orgIndex}][position]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter position held">
            </div>
        </div>
        <button type="button" class="remove-organization absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
    `;
    organizationContainer.appendChild(organizationEntry);
}

// Organization removal handler
function removeOrganizationHandler(e) {
    if (e.target.closest('.remove-organization')) {
        const organizationContainer = document.getElementById('organizations');
        const entries = organizationContainer.querySelectorAll('.organization-entry');
        if (entries.length > 1) {
            e.target.closest('.organization-entry').remove();
        }
    }
}

// Initialize on page load (for non-AJAX loads)
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('organizations')) {
        window.initializeOrganization();
    }
});
</script>
@endsection

@php($currentSection = 'organization') 