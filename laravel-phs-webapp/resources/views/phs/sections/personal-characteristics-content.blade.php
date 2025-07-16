<!-- Section 1: Physical Attributes -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-user mr-3 text-[#D4AF37]"></i>
        Description
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Sex -->
        <div>
            <label for="sex" class="block text-sm font-medium text-gray-700 mb-2">
                Sex
            </label>
            <select name="sex" id="sex"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Sex</option>
                <option value="male" {{ old('sex', $personalCharacteristics->sex ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('sex', $personalCharacteristics->sex ?? '') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('sex')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Age -->
        <div>
            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">
                Age
            </label>
            <input type="number" name="age" id="age" 
                   value="{{ old('age', $personalCharacteristics->age ?? '') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter age" min="1" max="120">
            @error('age')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Height -->
        <div>
            <label for="height" class="block text-sm font-medium text-gray-700 mb-2">
                Height
            </label>
            <div class="relative">
                <input type="number" step="0.01" name="height" id="height" 
                       value="{{ old('height', $personalCharacteristics->height ?? '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                       placeholder="0.00" min="0.50" max="2.50">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <span class="text-gray-500 text-sm">meters</span>
                </div>
            </div>
            @error('height')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Weight -->
        <div>
            <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">
                Weight
            </label>
            <div class="relative">
                <input type="number" step="0.01" name="weight" id="weight" 
                       value="{{ old('weight', $personalCharacteristics->weight ?? '') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                       placeholder="0.00" min="20" max="300">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <span class="text-gray-500 text-sm">kg</span>
                </div>
            </div>
            @error('weight')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Body Build -->
        <div>
            <label for="body_build" class="block text-sm font-medium text-gray-700 mb-2">
                Body Build
            </label>
            <select name="body_build" id="body_build"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Body Build</option>
                <option value="heavy" {{ old('body_build', $personalCharacteristics->body_build ?? '') == 'heavy' ? 'selected' : '' }}>Heavy</option>
                <option value="medium" {{ old('body_build', $personalCharacteristics->body_build ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="light" {{ old('body_build', $personalCharacteristics->body_build ?? '') == 'light' ? 'selected' : '' }}>Light</option>
            </select>
            @error('body_build')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Complexion -->
        <div>
            <label for="complexion" class="block text-sm font-medium text-gray-700 mb-2">
                Complexion
            </label>
            <select name="complexion" id="complexion"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Complexion</option>
                <option value="dark" {{ old('complexion', $personalCharacteristics->complexion ?? '') == 'dark' ? 'selected' : '' }}>Dark</option>
                <option value="fair" {{ old('complexion', $personalCharacteristics->complexion ?? '') == 'fair' ? 'selected' : '' }}>Fair</option>
                <option value="light" {{ old('complexion', $personalCharacteristics->complexion ?? '') == 'light' ? 'selected' : '' }}>Light</option>
            </select>
            @error('complexion')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Hair Color -->
        <div>
            <label for="hair_color" class="block text-sm font-medium text-gray-700 mb-2">
                Color of Hair
            </label>
            <input type="text" name="hair_color" id="hair_color" 
                   value="{{ old('hair_color', $personalCharacteristics->hair_color ?? '') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter hair color">
            @error('hair_color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Eye Color -->
        <div>
            <label for="eye_color" class="block text-sm font-medium text-gray-700 mb-2">
                Color of Eyes
            </label>
            <select name="eye_color" id="eye_color"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Eye Color</option>
                <option value="black" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'black' ? 'selected' : '' }}>Black</option>
                <option value="brown" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'brown' ? 'selected' : '' }}>Brown</option>
                <option value="blue" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'blue' ? 'selected' : '' }}>Blue</option>
                <option value="green" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'green' ? 'selected' : '' }}>Green</option>
                <option value="gray" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'gray' ? 'selected' : '' }}>Gray</option>
                <option value="hazel" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'hazel' ? 'selected' : '' }}>Hazel</option>
                <option value="other" {{ old('eye_color', $personalCharacteristics->eye_color ?? '') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('eye_color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    
    <!-- Scars/Marks & Other Distinguishing Features -->
    <div class="mt-6">
        <label for="other_marks" class="block text-sm font-medium text-gray-700 mb-2">
            Scars, Marks & Other Distinguishing Features
        </label>
        <textarea name="other_marks" id="other_marks" rows="3"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                  placeholder="Describe any scars, marks, tattoos, or other distinguishing features...">{{ old('other_marks', $personalCharacteristics->distinguishing_features ?? $personalCharacteristics->other_marks ?? '') }}</textarea>
        @error('other_marks')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<!-- Section 2: Health Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-heartbeat mr-3 text-[#D4AF37]"></i>
        Physical Condition
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Present State of Health -->
        <div>
            <label for="health_state" class="block text-sm font-medium text-gray-700 mb-2">
                Present State of Health
            </label>
            <select name="health_state" id="health_state"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Health Status</option>
                <option value="excellent" {{ old('health_state', $personalCharacteristics->health_status ?? $personalCharacteristics->health_state ?? '') == 'excellent' ? 'selected' : '' }}>Excellent</option>
                <option value="good" {{ old('health_state', $personalCharacteristics->health_status ?? $personalCharacteristics->health_state ?? '') == 'good' ? 'selected' : '' }}>Good</option>
                <option value="poor" {{ old('health_state', $personalCharacteristics->health_status ?? $personalCharacteristics->health_state ?? '') == 'poor' ? 'selected' : '' }}>Poor</option>
            </select>
            @error('health_state')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        
        <!-- Blood Type -->
        <div>
            <label for="blood_type" class="block text-sm font-medium text-gray-700 mb-2">
                Blood Type
            </label>
            <select name="blood_type" id="blood_type"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Blood Type</option>
                <option value="A+" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'AB-' ? 'selected' : '' }}>AB-</option>
                <option value="O+" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('blood_type', $personalCharacteristics->blood_type ?? '') == 'O-' ? 'selected' : '' }}>O-</option>
            </select>
            @error('blood_type')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    
    <!-- Recent Serious Illness -->
    <div class="mt-6">
        <label for="illness" class="block text-sm font-medium text-gray-700 mb-2">
            Recent Serious Illness
        </label>
        <textarea name="illness" id="illness" rows="3"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                  placeholder="Describe any recent serious illness, if any...">{{ old('illness', $personalCharacteristics->recent_illness ?? $personalCharacteristics->illness ?? '') }}</textarea>
        @error('illness')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<!-- Additional Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
        <i class="fas fa-tshirt mr-3 text-[#D4AF37]"></i>
        Additional Information
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="shoe_size" class="block text-sm font-medium text-gray-700 mb-2">Shoe Size</label>
            <input type="number" step="0.1" min="1" max="20" name="shoe_size" id="shoe_size"
                   value="{{ old('shoe_size', $personalCharacteristics->shoe_size ?? '') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                   placeholder="Enter shoe size">
            @error('shoe_size')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="cap_size" class="block text-sm font-medium text-gray-700 mb-2">Cap Size</label>
            <select name="cap_size" id="cap_size"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                <option value="">Select Cap Size</option>
                <option value="XS" {{ old('cap_size', $personalCharacteristics->cap_size ?? '') == 'XS' ? 'selected' : '' }}>XS</option>
                <option value="S" {{ old('cap_size', $personalCharacteristics->cap_size ?? '') == 'S' ? 'selected' : '' }}>S</option>
                <option value="M" {{ old('cap_size', $personalCharacteristics->cap_size ?? '') == 'M' ? 'selected' : '' }}>M</option>
                <option value="L" {{ old('cap_size', $personalCharacteristics->cap_size ?? '') == 'L' ? 'selected' : '' }}>L</option>
                <option value="XL" {{ old('cap_size', $personalCharacteristics->cap_size ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
                <option value="XXL" {{ old('cap_size', $personalCharacteristics->cap_size ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
            </select>
            @error('cap_size')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
</div> 