        <!-- Marital Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
                Marital Status
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Marital Status -->
                <div>
                    <label for="marital_stat" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Marital Status *
                    </label>
                    <select name="marital_stat" id="marital_stat" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Marital Status</option>
                        <option value="Single" {{ old('marital_stat', $marital_stat ?? '') === 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('marital_stat', $marital_stat ?? '') === 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ old('marital_stat', $marital_stat ?? '') === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="Separated" {{ old('marital_stat', $marital_stat ?? '') === 'Separated' ? 'selected' : '' }}>Separated</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Spouse Information (Always Visible) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user mr-3 text-[#D4AF37]"></i>
                Spouse Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="spouse_first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="spouse_first_name" id="spouse_first_name" value="{{ old('spouse_first_name', $spouse_first_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label for="spouse_middle_name" class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="spouse_middle_name" id="spouse_middle_name" value="{{ old('spouse_middle_name', $spouse_middle_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label for="spouse_last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="spouse_last_name" id="spouse_last_name" value="{{ old('spouse_last_name', $spouse_last_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label for="spouse_suffix" class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="spouse_suffix" id="spouse_suffix" value="{{ old('spouse_suffix', $spouse_suffix ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter suffix (if any)">
                </div>
                <div>
                    <label for="marriage_month" class="block text-sm font-medium text-gray-700 mb-2">Month of Marriage</label>
                    <select name="marriage_month" id="marriage_month" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Month</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i < 10 ? '0'.$i : $i }}" {{ old('marriage_month', $marriage_month ?? '') == ($i < 10 ? '0'.$i : (string)$i) ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="marriage_year" class="block text-sm font-medium text-gray-700 mb-2">Year of Marriage</label>
                    <input type="number" name="marriage_year" id="marriage_year" min="1900" max="2030" value="{{ old('marriage_year', $marriage_year ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                </div>
                <div>
                    <label for="marriage_place" class="block text-sm font-medium text-gray-700 mb-2">Place of Marriage *</label>
                    <input type="text" name="marriage_place" id="marriage_place" value="{{ old('marriage_place', $marriage_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of marriage">
                </div>
                <div>
                    <label for="spouse_birth_date" class="block text-sm font-medium text-gray-700 mb-2">Spouse Birth Date</label>
                    <input type="date" name="spouse_birth_date" id="spouse_birth_date" value="{{ old('spouse_birth_date', $spouse_birth_date ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label for="spouse_birth_place" class="block text-sm font-medium text-gray-700 mb-2">Spouse Birth Place</label>
                    <input type="text" name="spouse_birth_place" id="spouse_birth_place" value="{{ old('spouse_birth_place', $spouse_birth_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse birth place">
                </div>
                <div>
                    <label for="spouse_occupation" class="block text-sm font-medium text-gray-700 mb-2">Spouse Occupation</label>
                    <input type="text" name="spouse_occupation" id="spouse_occupation" value="{{ old('spouse_occupation', $spouse_occupation ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse occupation">
                </div>
                <div>
                    <label for="spouse_employer" class="block text-sm font-medium text-gray-700 mb-2">Spouse Employer</label>
                    <input type="text" name="spouse_employer" id="spouse_employer" value="{{ old('spouse_employer', $spouse_employer ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse employer">
                </div>
                <div>
                    <label for="spouse_employment_place" class="block text-sm font-medium text-gray-700 mb-2">Spouse Employment Place</label>
                    <input type="text" name="spouse_employment_place" id="spouse_employment_place" value="{{ old('spouse_employment_place', $spouse_employment_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse employment place">
                </div>
                <div>
                    <label for="spouse_contact" class="block text-sm font-medium text-gray-700 mb-2">Spouse Contact</label>
                    <input type="text" name="spouse_contact" id="spouse_contact" value="{{ old('spouse_contact', $spouse_contact ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse contact">
                </div>
                <div>
                    <label for="spouse_citizenship" class="block text-sm font-medium text-gray-700 mb-2">Spouse Citizenship</label>
                    <input type="text" name="spouse_citizenship" id="spouse_citizenship" value="{{ old('spouse_citizenship', $spouse_citizenship ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse citizenship">
                </div>
                <div>
                    <label for="spouse_other_citizenship" class="block text-sm font-medium text-gray-700 mb-2">Spouse Other Citizenship</label>
                    <input type="text" name="spouse_other_citizenship" id="spouse_other_citizenship" value="{{ old('spouse_other_citizenship', $spouse_other_citizenship ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter spouse other citizenship">
                </div>
            </div>
        </div>

        <!-- Children Information (Always Visible) -->
        <div id="children-section" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-child mr-3 text-[#D4AF37]"></i>
                Children Information
            </h3>

            <div id="children-container" class="space-y-4">
                @if(isset($children) && count($children) > 0)
                    @foreach($children as $index => $child)
                        <div class="child-entry p-4 border border-gray-200 rounded-lg {{ $index > 0 ? 'relative' : '' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="children[{{ $index }}][first_name]"
                                           value="{{ $child->childName->first_name ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter child's first name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="children[{{ $index }}][middle_name]"
                                           value="{{ $child->childName->middle_name ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter child's middle name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="children[{{ $index }}][last_name]"
                                           value="{{ $child->childName->last_name ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter child's last name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                                    <input type="text" name="children[{{ $index }}][suffix]"
                                           value="{{ $child->childName->suffix ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter child's suffix">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                    <input type="date" name="children[{{ $index }}][birth_date]"
                                           value="{{ $child->birth_date ? $child->birth_date->format('Y-m-d') : '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                    <input type="text" name="children[{{ $index }}][citizenship]"
                                           value="{{ $child->citizenshipDetail->cit_description ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter citizenship">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                    <input type="text" name="children[{{ $index }}][address]"
                                           value="{{ $child->addressDetail->street ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter address">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Name of Father</label>
                                    <input type="text" name="children[{{ $index }}][father_name]"
                                           value="{{ $child->father_name ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter father's name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Name of Mother</label>
                                    <input type="text" name="children[{{ $index }}][mother_name]"
                                           value="{{ $child->mother_name ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                           placeholder="Enter mother's name">
                                </div>
                            </div>
                            @if($index > 0)
                                <button type="button" class="remove-child absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="child-entry p-4 border border-gray-200 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="children[0][first_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's first name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input type="text" name="children[0][middle_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's middle name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="children[0][last_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's last name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                                <input type="text" name="children[0][suffix]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's suffix">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="children[0][birth_date]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                <input type="text" name="children[0][citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <input type="text" name="children[0][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter address">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Father</label>
                                <input type="text" name="children[0][father_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter father's name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Mother</label>
                                <input type="text" name="children[0][mother_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter mother's name">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <button type="button" id="add-child" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Child
            </button>
        </div>

@push('scripts')
<script>
function getChildCardHtml(index) {
    return `
        <div class="child-entry p-4 border border-gray-200 rounded-lg relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-2">First Name</label><input type="text" name="children[${index}][first_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's first name"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label><input type="text" name="children[${index}][middle_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's middle name"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label><input type="text" name="children[${index}][last_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's last name"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label><input type="text" name="children[${index}][suffix]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter child's suffix"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label><input type="date" name="children[${index}][birth_date]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label><input type="text" name="children[${index}][citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Address</label><input type="text" name="children[${index}][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter address"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Name of Father</label><input type="text" name="children[${index}][father_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter father's name"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Name of Mother</label><input type="text" name="children[${index}][mother_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter mother's name"></div>
            </div>
            <button type="button" class="remove-child absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
        </div>
    `;
}

function getNextChildIndex() {
    // Find the highest current index and add 1
    const entries = document.querySelectorAll('#children-container .child-entry');
    let maxIndex = -1;
    entries.forEach(entry => {
        const input = entry.querySelector('input[name^="children["]');
        if (input) {
            const match = input.name.match(/^children\[(\d+)\]/);
            if (match) {
                const idx = parseInt(match[1]);
                if (idx > maxIndex) maxIndex = idx;
            }
        }
    });
    return maxIndex + 1;
}

function initializeMaritalStatus() {
    // Add child functionality
    const addChildButton = document.getElementById('add-child');
    if (addChildButton) {
        addChildButton.onclick = function() {
            const container = document.getElementById('children-container');
            const nextIndex = getNextChildIndex();
            container.insertAdjacentHTML('beforeend', getChildCardHtml(nextIndex));
            const newEntry = container.lastElementChild;
            newEntry.querySelector('.remove-child').addEventListener('click', function() {
                newEntry.remove();
            });
        };
    }
    // Remove child functionality for existing entries
    document.querySelectorAll('.remove-child').forEach(function(btn) {
        btn.onclick = function() {
            btn.closest('.child-entry').remove();
        };
    });
}

document.addEventListener('DOMContentLoaded', initializeMaritalStatus);
window.addEventListener('load', initializeMaritalStatus);

// Marriage date synchronization
document.addEventListener('DOMContentLoaded', function() {
    const marriageMonthSelect = document.querySelector('select[name="marriage_month"]');
    const marriageYearInput = document.querySelector('input[name="marriage_year"]');
    const marriageDateHidden = document.querySelector('input[name="marriage_date"]');

    function updateMarriageDate() {
        const month = marriageMonthSelect ? marriageMonthSelect.value : '';
        const year = marriageYearInput ? marriageYearInput.value : '';

        if (month && year) {
            // Set to first day of the month for month/year format
            const date = new Date(year, month - 1, 1);
            marriageDateHidden.value = date.toISOString().split('T')[0];
        } else {
            marriageDateHidden.value = '';
        }
    }

    if (marriageMonthSelect) {
        marriageMonthSelect.addEventListener('change', updateMarriageDate);
    }

    if (marriageYearInput) {
        marriageYearInput.addEventListener('change', updateMarriageDate);
        marriageYearInput.addEventListener('input', updateMarriageDate);
    }

    // Initialize on page load
    updateMarriageDate();
});
</script>
@endpush
