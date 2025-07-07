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
                   value="{{ $personalDetails ? $personalDetails->first_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->first_name : '') }}">
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
                   value="{{ $personalDetails ? $personalDetails->middle_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->middle_name : '') }}">
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
                   value="{{ $personalDetails ? $personalDetails->last_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->last_name : '') }}">
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
                   value="{{ $personalDetails ? $personalDetails->suffix : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->name_extension : '') }}">
        </div>

        <!-- Nickname -->
        <div>
            <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">
                Nickname
            </label>
            <input type="text" name="nickname" id="nickname"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter your nickname"
                   value="{{ $personalDetails ? $personalDetails->nickname : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->nickname : '') }}">
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
                   value="{{ isset($personalDetails->date_of_birth) ? (\Illuminate\Support\Str::length($personalDetails->date_of_birth) === 10 ? $personalDetails->date_of_birth : (new \Carbon\Carbon($personalDetails->date_of_birth))->format('Y-m-d')) : '' }}">
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
                   value="{{ $personalDetails->nationality ?? '' }}">
        </div>
    </div>
    <!-- Place of Birth -->
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
                @if(isset($personalDetails->birth_region) && $personalDetails->birth_region)
                    <option value="{{ $personalDetails->birth_region }}" selected>
                        {{ $personalDetails->birth_region_name ?? $personalDetails->birth_region }}
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
                @if(isset($personalDetails->birth_province) && $personalDetails->birth_province)
                    <option value="{{ $personalDetails->birth_province }}" selected>
                        {{ $personalDetails->birth_province_name ?? $personalDetails->birth_province }}
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
                @if(isset($personalDetails->birth_city) && $personalDetails->birth_city)
                    <option value="{{ $personalDetails->birth_city }}" selected>
                        {{ $personalDetails->birth_city_name ?? $personalDetails->birth_city }}
                    </option>
                @endif
            </select>
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
                @if(isset($personalDetails->birth_barangay) && $personalDetails->birth_barangay)
                    <option value="{{ $personalDetails->birth_barangay }}" selected>
                        {{ $personalDetails->birth_barangay_name ?? $personalDetails->birth_barangay }}
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
                   value="{{ $personalDetails->birth_street ?? '' }}">
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
                    @if(isset($personalDetails->home_region) && $personalDetails->home_region)
                        <option value="{{ $personalDetails->home_region }}" selected>
                            {{ $personalDetails->home_region_name ?? $personalDetails->home_region }}
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
                    @if(isset($personalDetails->home_province) && $personalDetails->home_province)
                        <option value="{{ $personalDetails->home_province }}" selected>
                            {{ $personalDetails->home_province_name ?? $personalDetails->home_province }}
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
                    @if(isset($personalDetails->home_city) && $personalDetails->home_city)
                        <option value="{{ $personalDetails->home_city }}" selected>
                            {{ $personalDetails->home_city_name ?? $personalDetails->home_city }}
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
                    @if(isset($personalDetails->home_barangay) && $personalDetails->home_barangay)
                        <option value="{{ $personalDetails->home_barangay }}" selected>
                            {{ $personalDetails->home_barangay_name ?? $personalDetails->home_barangay }}
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
                       value="{{ $personalDetails->home_street ?? '' }}">
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
                    @if(isset($personalDetails->business_region) && $personalDetails->business_region)
                        <option value="{{ $personalDetails->business_region }}" selected>
                            {{ $personalDetails->business_region_name ?? $personalDetails->business_region }}
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
                    @if(isset($personalDetails->business_province) && $personalDetails->business_province)
                        <option value="{{ $personalDetails->business_province }}" selected>
                            {{ $personalDetails->business_province_name ?? $personalDetails->business_province }}
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
                    @if(isset($personalDetails->business_city) && $personalDetails->business_city)
                        <option value="{{ $personalDetails->business_city }}" selected>
                            {{ $personalDetails->business_city_name ?? $personalDetails->business_city }}
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
                    @if(isset($personalDetails->business_barangay) && $personalDetails->business_barangay)
                        <option value="{{ $personalDetails->business_barangay }}" selected>
                            {{ $personalDetails->business_barangay_name ?? $personalDetails->business_barangay }}
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
                       value="{{ $personalDetails->business_street ?? '' }}">
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