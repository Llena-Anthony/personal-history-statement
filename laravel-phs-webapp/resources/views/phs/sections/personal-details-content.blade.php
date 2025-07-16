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
       value="{{ old('date_of_birth', isset($date_of_birth) && $date_of_birth ? \Carbon\Carbon::parse($date_of_birth)->format('Y-m-d') : '') }}">
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
                        onchange="loadProvinces('birth'); updateCompleteAddress('birth'); updateAddressNames('birth')">
                    <option value="">Select Region</option>
                    @if(isset($birth_region_name) && $birth_region_name)
                        <option value="{{ $birth_region_name }}" selected>
                            {{ $birth_region_name }}
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
                        onchange="loadCities('birth'); updateCompleteAddress('birth'); updateAddressNames('birth')">
                    <option value="">Select Province</option>
                    @if(isset($birth_province_name) && $birth_province_name)
                        <option value="{{ $birth_province_name }}" selected>
                            {{ $birth_province_name }}
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
                        onchange="loadBarangays('birth'); updateCompleteAddress('birth'); updateAddressNames('birth')">
                    <option value="">Select City/Municipality</option>
                    @if(isset($birth_city_name) && $birth_city_name)
                        <option value="{{ $birth_city_name }}" selected>
                            {{ $birth_city_name }}
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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                    onchange="updateCompleteAddress('birth'); updateAddressNames('birth')">
                <option value="">Select Barangay</option>
                @if(isset($birth_barangay_name) && $birth_barangay_name)
                    <option value="{{ $birth_barangay_name }}" selected>
                        {{ $birth_barangay_name }}
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

<!-- Military and Contact Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-user-shield mr-3 text-[#D4AF37]"></i>
        Military and Contact Information
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Rank -->
        <div>
            <label for="rank" class="block text-sm font-medium text-gray-700 mb-2">Rank</label>
            <input type="text" name="rank" id="rank" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your rank" value="{{ old('rank', $rank) }}">
        </div>
        <!-- AFPSN -->
        <div>
            <label for="afpsn" class="block text-sm font-medium text-gray-700 mb-2">AFPSN</label>
            <input type="text" name="afpsn" id="afpsn" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your AFPSN" value="{{ old('afpsn', $afpsn) }}">
        </div>
        <!-- Branch of Service -->
        <div>
            <label for="branch_of_service" class="block text-sm font-medium text-gray-700 mb-2">Br of Svc</label>
            <input type="text" name="branch_of_service" id="branch_of_service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your branch of service" value="{{ old('branch_of_service', $branch_of_service) }}">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Present Job Assignment -->
        <div>
            <label for="present_job" class="block text-sm font-medium text-gray-700 mb-2">Present Job Assignment</label>
            <input type="text" name="present_job" id="present_job" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your present job assignment" value="{{ old('present_job', $present_job) }}">
        </div>
        <!-- Change in name -->
        <div>
            <label for="name_change" class="block text-sm font-medium text-gray-700 mb-2">Change in name (If by court action, give details)</label>
            <input type="text" name="name_change" id="name_change" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="If by court action, give details" value="{{ old('name_change', $name_change) }}">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- TIN -->
        <div>
            <label for="tin" class="block text-sm font-medium text-gray-700 mb-2">TAX IDENTIFICATION NR</label>
            <input type="text" name="tin" id="tin" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your TIN" value="{{ old('tin', $tin) }}">
        </div>
        <!-- Religion -->
        <div>
            <label for="religion" class="block text-sm font-medium text-gray-700 mb-2">Religion</label>
            <input type="text" name="religion" id="religion" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your religion" value="{{ old('religion', $religion) }}">
        </div>
        <!-- Mobile Number -->
        <div>
            <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
            <input type="text" name="mobile" id="mobile" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your mobile number" value="{{ old('mobile', $mobile) }}">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your email address" value="{{ old('email', $email) }}">
        </div>
        <!-- Passport Number -->
        <div>
            <label for="passport_number" class="block text-sm font-medium text-gray-700 mb-2">Passport Number</label>
            <input type="text" name="passport_number" id="passport_number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter your passport number" value="{{ old('passport_number', $passport_number) }}">
        </div>
        <!-- Passport Expiry -->
        <div>
            <label for="passport_expiry" class="block text-sm font-medium text-gray-700 mb-2">Passport Expiry Date</label>
            <input type="date" name="passport_expiry" id="passport_expiry" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" value="{{ old('passport_expiry', $passport_expiry) }}">
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
                        onchange="loadProvinces('home'); updateCompleteAddress('home'); updateAddressNames('home')">
                    <option value="">Select Region</option>
                    @if(isset($home_region_name) && $home_region_name)
                        <option value="{{ $home_region_name }}" selected>
                            {{ $home_region_name }}
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
                        onchange="loadCities('home'); updateCompleteAddress('home'); updateAddressNames('home')">
                    <option value="">Select Province</option>
                    @if(isset($home_province_name) && $home_province_name)
                        <option value="{{ $home_province_name }}" selected>
                            {{ $home_province_name }}
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
                        onchange="loadBarangays('home'); updateCompleteAddress('home'); updateAddressNames('home')">
                    <option value="">Select City/Municipality</option>
                    @if(isset($home_city_name) && $home_city_name)
                        <option value="{{ $home_city_name }}" selected>
                            {{ $home_city_name }}
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="updateCompleteAddress('home'); updateAddressNames('home')">
                    <option value="">Select Barangay</option>
                                    @if(isset($home_barangay_name) && $home_barangay_name)
                    <option value="{{ $home_barangay_name }}" selected>
                        {{ $home_barangay_name }}
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
    @php
        $fullHomeAddress = trim(
            ($home_street ?? '') . ', ' .
            ($home_barangay_name ?? $home_barangay ?? '') . ', ' .
            ($home_city_name ?? $home_city ?? '') . ', ' .
            ($home_province_name ?? $home_province ?? '') . ', ' .
            ($home_region_name ?? $home_region ?? '')
        , ' ,');
    @endphp
    @if($fullHomeAddress && $fullHomeAddress !== ', , , ,')
        <div class="mt-2 text-sm text-gray-600 font-semibold">
            Full Address: {{ $fullHomeAddress }}
        </div>
    @endif

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
                        onchange="loadProvinces('business'); updateCompleteAddress('business'); updateAddressNames('business')">
                    <option value="">Select Region</option>
                    @if(isset($business_region_name) && $business_region_name)
                        <option value="{{ $business_region_name }}" selected>
                            {{ $business_region_name }}
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
                        onchange="loadCities('business'); updateCompleteAddress('business'); updateAddressNames('business')">
                    <option value="">Select Province</option>
                    @if(isset($business_province_name) && $business_province_name)
                        <option value="{{ $business_province_name }}" selected>
                            {{ $business_province_name }}
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
                        onchange="loadBarangays('business'); updateCompleteAddress('business'); updateAddressNames('business')">
                    <option value="">Select City/Municipality</option>
                    @if(isset($business_city_name) && $business_city_name)
                        <option value="{{ $business_city_name }}" selected>
                            {{ $business_city_name }}
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                        onchange="updateCompleteAddress('business'); updateAddressNames('business')">
                    <option value="">Select Barangay</option>
                                    @if(isset($business_barangay_name) && $business_barangay_name)
                    <option value="{{ $business_barangay_name }}" selected>
                        {{ $business_barangay_name }}
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
    @php
        $fullBusinessAddress = trim(
            ($business_street ?? '') . ', ' .
            ($business_barangay_name ?? $business_barangay ?? '') . ', ' .
            ($business_city_name ?? $business_city ?? '') . ', ' .
            ($business_province_name ?? $business_province ?? '') . ', ' .
            ($business_region_name ?? $business_region ?? '')
        , ' ,');
    @endphp
    @if($fullBusinessAddress && $fullBusinessAddress !== ', , , ,')
        <div class="mt-2 text-sm text-gray-600 font-semibold">
            Full Address: {{ $fullBusinessAddress }}
        </div>
    @endif
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
<input type="hidden" id="birth_region_name" name="birth_region_name" value="{{ $birth_region_name ?? '' }}">
<input type="hidden" id="birth_province_name" name="birth_province_name" value="{{ $birth_province_name ?? '' }}">
<input type="hidden" id="birth_city_name" name="birth_city_name" value="{{ $birth_city_name ?? '' }}">
<input type="hidden" id="birth_barangay_name" name="birth_barangay_name" value="{{ $birth_barangay_name ?? '' }}">
