<!-- Personal Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-id-card mr-3 text-[#D4AF37]"></i>
        Personal Information
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                First Name
            </label>
            <input type="text" name="first_name" id="first_name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter your first name"
                   value="{{ old('first_name', $first_name)}}">
            @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Middle Name -->
        <div>
            <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                Middle Name
            </label>
            <input type="text" name="middle_name" id="middle_name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter your middle name"
                   value="{{ old('middle_name', $middle_name)}}">
            @error('middle_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                Last Name
            </label>
            <input type="text" name="last_name" id="last_name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter your last name"
                   value="{{ old('last_name', $last_name)}}">
            @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Suffix -->
        <div>
            <label for="suffix" class="block text-sm font-medium text-gray-700 mb-2">
                Name Extension (Jr., Sr., III, etc.)
            </label>
            <input type="text" name="suffix" id="suffix"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="e.g., Jr., Sr., III"
                   value="{{ old('suffix', $suffix)}}">
        </div>

        <!-- Nickname -->
        <div>
            <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">
                Nickname
            </label>
            <input type="text" name="nickname" id="nickname"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter your nickname"
                   value="{{ old('nickname', $nickname)}}">
        </div>
    </div>
</div>

<!-- Birth Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-birthday-cake mr-3 text-[#D4AF37]"></i>
        Birth Information
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Date of Birth -->
        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                Date of Birth
            </label>
            <input type="date" name="date_of_birth" id="date_of_birth"
       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
       value="{{ isset($date_of_birth) ? (strlen($date_of_birth) === 10 ? \Carbon\Carbon::parse($date_of_birth)->format('Y-m-d') : '') : '' }}">
            @error('date_of_birth')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nationality -->
        <div>
            <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                Nationality
            </label>
            <input type="text" name="nationality" id="nationality"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter your nationality"
                   value="{{ $nationality ?? '' }}">
        </div>
    </div>
    <!-- Place of Birth -->
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Place of Birth</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Region -->
            <div>
                <label for="birth_region" class="block text-sm font-medium text-gray-700 mb-2">
                    Region
                </label>
                <select name="birth_region" id="birth_region"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadProvinces('birth')">
                    <option value="">Select Region</option>
                    @if(isset($birth_region) && $birth_region)
                        <option value="{{ $birth_region }}" selected>
                            {{ $birth_region_name ?? $birth_region }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- Province -->
            <div>
                <label for="birth_province" class="block text-sm font-medium text-gray-700 mb-2">
                    Province
                </label>
                <select name="birth_province" id="birth_province"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadCities('birth')">
                    <option value="">Select Province</option>
                    @if(isset($birth_province) && $birth_province)
                        <option value="{{ $birth_province }}" selected>
                            {{ $birth_province_name ?? $birth_province }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- City/Municipality -->
            <div>
                <label for="birth_city" class="block text-sm font-medium text-gray-700 mb-2">
                    City/Municipality
                </label>
                <select name="birth_city" id="birth_city"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadBarangays('birth')">
                    <option value="">Select City/Municipality</option>
                    @if(isset($birth_city) && $birth_city)
                        <option value="{{ $birth_city }}" selected>
                            {{ $birth_city_name ?? $birth_city }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Barangay -->
        <div>
            <label for="birth_barangay" class="block text-sm font-medium text-gray-700 mb-2">
                Barangay
            </label>
            <select name="birth_barangay" id="birth_barangay"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Barangay</option>
                @if(isset($birth_barangay) && $birth_barangay)
                    <option value="{{ $birth_barangay }}" selected>
                        {{ $birth_barangay_name ?? $birth_barangay }}
                    </option>
                @endif
            </select>
        </div>

        <!-- Street Address -->
        <div>
            <label for="birth_street" class="block text-sm font-medium text-gray-700 mb-2">
                Street Address
            </label>
            <input type="text" name="birth_street" id="birth_street"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter street address"
                   value="{{ $birth_street ?? '' }}">
        </div>
    </div>
</div>

<!-- Address Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-map-marker-alt mr-3 text-[#D4AF37]"></i>
        Address Information
    </h3>

    <!-- Home Address -->
    <div class="mb-8">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Home Address</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Region -->
            <div>
                <label for="home_region" class="block text-sm font-medium text-gray-700 mb-2">
                    Region
                </label>
                <select name="home_region" id="home_region"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadProvinces('home')">
                    <option value="">Select Region</option>
                    @if(isset($home_region) && $home_region)
                        <option value="{{ $home_region }}" selected>
                            {{ $home_region_name ?? $home_region }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- Province -->
            <div>
                <label for="home_province" class="block text-sm font-medium text-gray-700 mb-2">
                    Province
                </label>
                <select name="home_province" id="home_province"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadCities('home')">
                    <option value="">Select Province</option>
                    @if(isset($home_province) && $home_province)
                        <option value="{{ $home_province }}" selected>
                            {{ $home_province_name ?? $home_province }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- City/Municipality -->
            <div>
                <label for="home_city" class="block text-sm font-medium text-gray-700 mb-2">
                    City/Municipality
                </label>
                <select name="home_city" id="home_city"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadBarangays('home')">
                    <option value="">Select City/Municipality</option>
                    @if(isset($home_city) && $home_city)
                        <option value="{{ $home_city }}" selected>
                            {{ $home_city_name ?? $home_city }}
                        </option>
                    @endif
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Barangay -->
            <div>
                <label for="home_barangay" class="block text-sm font-medium text-gray-700 mb-2">
                    Barangay
                </label>
                <select name="home_barangay" id="home_barangay"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                    <option value="">Select Barangay</option>
                    @if(isset($home_barangay) && $home_barangay)
                        <option value="{{ $home_barangay }}" selected>
                            {{ $home_barangay_name ?? $home_barangay }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- Street Address -->
            <div>
                <label for="home_street" class="block text-sm font-medium text-gray-700 mb-2">
                    Street Address
                </label>
                <input type="text" name="home_street" id="home_street"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                       placeholder="Enter street address"
                       value="{{ $home_street ?? '' }}">
            </div>
        </div>
    </div>

    <!-- Business Address -->
    <div>
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Business Address</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Region -->
            <div>
                <label for="business_region" class="block text-sm font-medium text-gray-700 mb-2">
                    Region
                </label>
                <select name="business_region" id="business_region"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadProvinces('business')">
                    <option value="">Select Region</option>
                    @if(isset($business_region) && $business_region)
                        <option value="{{ $business_region }}" selected>
                            {{ $business_region_name ?? $business_region }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- Province -->
            <div>
                <label for="business_province" class="block text-sm font-medium text-gray-700 mb-2">
                    Province
                </label>
                <select name="business_province" id="business_province"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadCities('business')">
                    <option value="">Select Province</option>
                    @if(isset($business_province) && $business_province)
                        <option value="{{ $business_province }}" selected>
                            {{ $business_province_name ?? $business_province }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- City/Municipality -->
            <div>
                <label for="business_city" class="block text-sm font-medium text-gray-700 mb-2">
                    City/Municipality
                </label>
                <select name="business_city" id="business_city"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="loadBarangays('business')">
                    <option value="">Select City/Municipality</option>
                    @if(isset($business_city) && $business_city)
                        <option value="{{ $business_city }}" selected>
                            {{ $business_city_name ?? $business_city }}
                        </option>
                    @endif
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Barangay -->
            <div>
                <label for="business_barangay" class="block text-sm font-medium text-gray-700 mb-2">
                    Barangay
                </label>
                <select name="business_barangay" id="business_barangay"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                    <option value="">Select Barangay</option>
                    @if(isset($business_barangay) && $business_barangay)
                        <option value="{{ $business_barangay }}" selected>
                            {{ $business_barangay_name ?? $business_barangay }}
                        </option>
                    @endif
                </select>
            </div>

            <!-- Street Address -->
            <div>
                <label for="business_street" class="block text-sm font-medium text-gray-700 mb-2">
                    Street Address
                </label>
                <input type="text" name="business_street" id="business_street"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                       placeholder="Enter street address"
                       value="{{ $business_street ?? '' }}">
            </div>
        </div>
    </div>
</div>

<!-- Hidden fields for address names -->
<input type="hidden" name="home_region_name" id="home_region_name">
<input type="hidden" name="home_province_name" id="home_province_name">
<input type="hidden" name="home_city_name" id="home_city_name">
<input type="hidden" name="home_barangay_name" id="home_barangay_name">
<input type="hidden" name="business_region_name" id="business_region_name">
<input type="hidden" name="business_province_name" id="business_province_name">
<input type="hidden" name="business_city_name" id="business_city_name">
<input type="hidden" name="business_barangay_name" id="business_barangay_name">
