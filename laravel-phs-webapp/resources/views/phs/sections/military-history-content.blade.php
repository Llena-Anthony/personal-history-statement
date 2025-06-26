@extends('layouts.phs-new')

@section('title', 'VI: Military History')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Military History</h1>
                <p class="text-gray-600">Please provide your military service information</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('phs.military-history.store') }}" class="space-y-8">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-info-circle mr-3 text-[#D4AF37]"></i>
                Basic Military Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Enlistment in the AFP</label>
                    <div class="flex space-x-2">
                        <select name="enlistment_date_type" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact">Exact Date</option>
                            <option value="month_year">Month/Year</option>
                        </select>
                        <input type="date" name="enlistment_date" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 hidden" id="enlistment-month-year-group">
                            <select name="enlistment_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                            <input type="number" name="enlistment_year" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Source of Commission</label>
                    <input type="text" name="commission_source" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter source of commission">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission (From)</label>
                    <div class="flex space-x-2">
                        <select name="commission_date_from_type" id="commission_date_from_type" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact">Exact Date</option>
                            <option value="month_year">Month/Year</option>
                        </select>
                        <input type="date" name="commission_date_from" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 hidden" id="commission-from-month-year-group">
                            <select name="commission_date_from_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                            <input type="number" name="commission_date_from_year" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission (To)</label>
                    <div class="flex space-x-2">
                        <select name="commission_date_to_type" id="commission_date_to_type" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact">Exact Date</option>
                            <option value="month_year">Month/Year</option>
                        </select>
                        <input type="date" name="commission_date_to" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 hidden" id="commission-to-month-year-group">
                            <select name="commission_date_to_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                            <input type="number" name="commission_date_to_year" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Assignments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-map-marker-alt mr-3 text-[#D4AF37]"></i>
                    Important Unit Assignments since enlisted/CAD
                </h3>
            </div>
            <div id="assignments-container" class="space-y-4">
                <!-- Initial assignment entry (default, not removable) -->
                <div class="assignment-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                            <div class="flex space-x-2">
                                <select name="assignments[0][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="assignments[0][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="assignment-from-month-year-group-0">
                                    <select name="assignments[0][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                    <input type="number" name="assignments[0][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                            <div class="flex space-x-2">
                                <select name="assignments[0][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="assignments[0][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="assignment-to-month-year-group-0">
                                    <select name="assignments[0][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                    <input type="number" name="assignments[0][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit/Office</label>
                            <input type="text" name="assignments[0][unit_office]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter unit or office">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CO/Chief of Office</label>
                            <input type="text" name="assignments[0][co_chief]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter CO or Chief of Office">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-assignment" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Assignment
            </button>
        </div>

        <!-- Military Schools -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                    Military Schools Attended
                </h3>
            </div>
            <div id="schools-container" class="space-y-4">
                <!-- Initial school entry (default, not removable) -->
                <div class="school-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                            <input type="text" name="schools[0][school]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="schools[0][location]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school location">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance (From)</label>
                            <div class="flex space-x-2">
                                <select name="schools[0][date_attended_from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="schools[0][date_attended_from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="school-date-from-month-year-group-0">
                                    <select name="schools[0][date_attended_from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                    <input type="number" name="schools[0][date_attended_from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance (To)</label>
                            <div class="flex space-x-2">
                                <select name="schools[0][date_attended_to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="schools[0][date_attended_to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="school-date-to-month-year-group-0">
                                    <select name="schools[0][date_attended_to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                    <input type="number" name="schools[0][date_attended_to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                            <input type="text" name="schools[0][nature_training]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter nature of training">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <input type="text" name="schools[0][rating]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter rating">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-school" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another School
            </button>
        </div>

        <!-- Awards and Decorations -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-medal mr-3 text-[#D4AF37]"></i>
                    Awards and Decorations
                </h3>
            </div>
            <div id="awards-container" class="space-y-4">
                <!-- Initial award entry (default, not removable) -->
                <div class="award-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <input type="text" name="awards[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter award or decoration name">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-award" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Award
            </button>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('military-history')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'military-history')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<!-- Initialize dynamic functionality after AJAX load -->
<script>
    if (typeof window.initializeMilitaryHistory === 'function') {
        window.initializeMilitaryHistory();
    }
</script>
@endsection 