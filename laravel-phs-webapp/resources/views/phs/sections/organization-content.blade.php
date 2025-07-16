    {{-- Remove the <form> wrapper and just keep the section content fields here --}}

    <!-- Organization Entries -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                <i class="fas fa-building mr-3 text-[#D4AF37]"></i>
                Organization Entries
            </h3>
        </div>
        <div id="organizations" class="space-y-4">
            @if(isset($organizations) && $organizations->count() > 0)
                @foreach($organizations as $index => $organization)
                    <div class="organization-entry p-4 border border-gray-200 rounded-lg" data-index="{{ $index }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                                <input type="text" name="organizations[{{ $index }}][name]" 
                                       value="{{ old('organizations.' . $index . '.name', $organization->org_name ?? '') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" 
                                       placeholder="Enter organization name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Position Held</label>
                                <input type="text" name="organizations[{{ $index }}][position]" 
                                       value="{{ old('organizations.' . $index . '.position', $organization->membershipDetails->first()->position ?? '') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" 
                                       placeholder="Enter position held">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <input type="text" name="organizations[{{ $index }}][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter address" value="{{ old('organizations.' . $index . '.address', $organization->address ?? '') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Membership</label>
                                <div class="flex space-x-2">
                                    <select name="organizations[{{ $index }}][month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '01' ? 'selected' : '' }}>January</option>
                                        <option value="02" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '02' ? 'selected' : '' }}>February</option>
                                        <option value="03" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '03' ? 'selected' : '' }}>March</option>
                                        <option value="04" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '04' ? 'selected' : '' }}>April</option>
                                        <option value="05" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '05' ? 'selected' : '' }}>May</option>
                                        <option value="06" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '06' ? 'selected' : '' }}>June</option>
                                        <option value="07" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '07' ? 'selected' : '' }}>July</option>
                                        <option value="08" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '08' ? 'selected' : '' }}>August</option>
                                        <option value="09" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '09' ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '10' ? 'selected' : '' }}>October</option>
                                        <option value="11" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '11' ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ old('organizations.' . $index . '.month', $organization->membershipDetails->first() ? date('m', strtotime($organization->membershipDetails->first()->date_joined)) : '') == '12' ? 'selected' : '' }}>December</option>
                                    </select>
                                    <input type="number" name="organizations[{{ $index }}][year]" min="1900" max="2030" 
                                           value="{{ old('organizations.' . $index . '.year', $organization->membershipDetails->first() ? date('Y', strtotime($organization->membershipDetails->first()->date_joined)) : '') }}"
                                           class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" 
                                           placeholder="Year">
                                </div>
                            </div>
                        </div>
                        @if($index > 0)
                            <button type="button" class="remove-organization absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                        @endif
                    </div>
                @endforeach
            @else
                <!-- Initial organization entry (default, not removable) -->
                <div class="organization-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                            <input type="text" name="organizations[0][name]" class="w-full px-4 py-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter organization name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Position Held</label>
                            <input type="text" name="organizations[0][position]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter position held">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="organizations[0][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter address" value="{{ old('organizations.0.address') }}">
                        </div>
                        <div class="md:col-span-2">
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
                    </div>
                </div>
            @endif
        </div>
        <button type="button" id="add-organization" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
            <i class="fas fa-plus mr-1"></i> Add Another Organization
        </button>
    </div>

    {{-- Remove the <form> wrapper and just keep the section content fields here --}}

    {{-- Remove the <form> wrapper and just keep the section content fields here --}}

<script>
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Position Held</label>
                <input type="text" name="organizations[${orgIndex}][position]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter position held">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" name="organizations[${orgIndex}][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter address" value="">
            </div>
            <div class="md:col-span-2">
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

document.addEventListener('DOMContentLoaded', function() {
    // Attach add handler
    const addBtn = document.getElementById('add-organization');
    if (addBtn) {
        addBtn.removeEventListener('click', addOrganizationHandler);
        addBtn.addEventListener('click', addOrganizationHandler);
    }
    // Attach remove handler (event delegation)
    const orgContainer = document.getElementById('organizations');
    if (orgContainer) {
        orgContainer.removeEventListener('click', removeOrganizationHandler);
        orgContainer.addEventListener('click', removeOrganizationHandler);
    }
});
// Call global initialization function for Organization
if (typeof window.initializeOrganization === 'function') {
    window.initializeOrganization();
}

// Dynamically load regions for all organization region dropdowns
async function loadOrganizationRegions() {
    try {
        const response = await fetch('https://psgc.gitlab.io/api/regions/');
        const regions = await response.json();
        document.querySelectorAll('select[id$="_region"]').forEach(regionSelect => {
            // Only fill if not already filled with options
            if (regionSelect.options.length <= 1) {
                regions.forEach(region => {
                    const option = new Option(region.name, region.code);
                    regionSelect.add(option);
                });
            }
        });
    } catch (error) {
        console.error('Error loading organization regions:', error);
    }
}

// Call on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadOrganizationRegions);
} else {
    loadOrganizationRegions();
}

// Also call after adding a new organization entry
const addOrgBtn = document.getElementById('add-organization');
if (addOrgBtn) {
    addOrgBtn.addEventListener('click', function() {
        setTimeout(loadOrganizationRegions, 100); // Wait for new entry to be added
    });
}
</script> 