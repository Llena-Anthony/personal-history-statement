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
                            <option value="exact" {{ isset($militaryHistory) && $militaryHistory->enlistment_date_type === 'exact' ? 'selected' : '' }}>Exact Date</option>
                            <option value="month_year" {{ isset($militaryHistory) && $militaryHistory->enlistment_date_type === 'month_year' ? 'selected' : '' }}>Month/Year</option>
                        </select>
                        <input type="date" name="enlistment_date" value="{{ isset($militaryHistory) && $militaryHistory->date_enlisted_afp ? $militaryHistory->date_enlisted_afp->format('Y-m-d') : '' }}" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 {{ isset($militaryHistory) && $militaryHistory->enlistment_date_type === 'month_year' ? '' : 'hidden' }}" id="enlistment-month-year-group">
                            <select name="enlistment_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Month</option>
                                <option value="01" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($militaryHistory) && $militaryHistory->enlistment_month === '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <input type="number" name="enlistment_year" min="1900" max="2030" value="{{ isset($militaryHistory) ? $militaryHistory->enlistment_year : '' }}" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Source of Commission</label>
                    <input type="text" name="commission_source" value="{{ isset($militaryHistory) ? $militaryHistory->source_of_commision : '' }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter source of commission">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission (From)</label>
                    <div class="flex space-x-2">
                        <select name="commission_date_from_type" id="commission_date_from_type" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_type === 'exact' ? 'selected' : '' }}>Exact Date</option>
                            <option value="month_year" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_type === 'month_year' ? 'selected' : '' }}>Month/Year</option>
                        </select>
                        <input type="date" name="commission_date_from" value="{{ isset($militaryHistory) && $militaryHistory->start_date_of_commision ? $militaryHistory->start_date_of_commision->format('Y-m-d') : '' }}" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 {{ isset($militaryHistory) && $militaryHistory->commission_date_from_type === 'month_year' ? '' : 'hidden' }}" id="commission-from-month-year-group">
                            <select name="commission_date_from_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Month</option>
                                <option value="01" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($militaryHistory) && $militaryHistory->commission_date_from_month === '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <input type="number" name="commission_date_from_year" min="1900" max="2030" value="{{ isset($militaryHistory) ? $militaryHistory->commission_date_from_year : '' }}" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission (To)</label>
                    <div class="flex space-x-2">
                        <select name="commission_date_to_type" id="commission_date_to_type" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_type === 'exact' ? 'selected' : '' }}>Exact Date</option>
                            <option value="month_year" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_type === 'month_year' ? 'selected' : '' }}>Month/Year</option>
                        </select>
                        <input type="date" name="commission_date_to" value="{{ isset($militaryHistory) && $militaryHistory->end_date_of_commision ? $militaryHistory->end_date_of_commision->format('Y-m-d') : '' }}" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 {{ isset($militaryHistory) && $militaryHistory->commission_date_to_type === 'month_year' ? '' : 'hidden' }}" id="commission-to-month-year-group">
                            <select name="commission_date_to_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Month</option>
                                <option value="01" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($militaryHistory) && $militaryHistory->commission_date_to_month === '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <input type="number" name="commission_date_to_year" min="1900" max="2030" value="{{ isset($militaryHistory) ? $militaryHistory->commission_date_to_year : '' }}" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
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

        <!-- Awards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-medal mr-3 text-[#D4AF37]"></i>
                    Decorations, Awards, or Commendations Received
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle date type changes for basic military information
        const enlistmentDateTypeSelect = document.querySelector('select[name="enlistment_date_type"]');
        const enlistmentDateInput = document.querySelector('input[name="enlistment_date"]');
        const enlistmentMonthYearGroup = document.getElementById('enlistment-month-year-group');

        const handleEnlistmentDateTypeChange = () => {
            if (enlistmentDateTypeSelect.value === 'exact') {
                enlistmentDateInput.classList.remove('hidden');
                enlistmentMonthYearGroup.classList.add('hidden');
            } else {
                enlistmentDateInput.classList.add('hidden');
                enlistmentMonthYearGroup.classList.remove('hidden');
            }
        };

        enlistmentDateTypeSelect.addEventListener('change', handleEnlistmentDateTypeChange);
        handleEnlistmentDateTypeChange(); // Initial check

        // Handle commission date from type changes
        const commissionFromDateTypeSelect = document.querySelector('select[name="commission_date_from_type"]');
        const commissionFromDateInput = document.querySelector('input[name="commission_date_from"]');
        const commissionFromMonthYearGroup = document.getElementById('commission-from-month-year-group');

        const handleCommissionFromDateTypeChange = () => {
            if (commissionFromDateTypeSelect.value === 'exact') {
                commissionFromDateInput.classList.remove('hidden');
                commissionFromMonthYearGroup.classList.add('hidden');
            } else {
                commissionFromDateInput.classList.add('hidden');
                commissionFromMonthYearGroup.classList.remove('hidden');
            }
        };

        // Handle commission date to type changes
        const commissionToDateTypeSelect = document.querySelector('select[name="commission_date_to_type"]');
        const commissionToDateInput = document.querySelector('input[name="commission_date_to"]');
        const commissionToMonthYearGroup = document.getElementById('commission-to-month-year-group');

        const handleCommissionToDateTypeChange = () => {
            if (commissionToDateTypeSelect.value === 'exact') {
                commissionToDateInput.classList.remove('hidden');
                commissionToMonthYearGroup.classList.add('hidden');
            } else {
                commissionToDateInput.classList.add('hidden');
                commissionToMonthYearGroup.classList.remove('hidden');
            }
        };

        // Synchronize commission date type selections
        const synchronizeCommissionDateTypes = (changedSelect) => {
            const fromSelect = document.querySelector('select[name="commission_date_from_type"]');
            const toSelect = document.querySelector('select[name="commission_date_to_type"]');
            
            console.log('Synchronizing commission dates:', {
                changedSelect: changedSelect.name,
                fromSelectValue: fromSelect.value,
                toSelectValue: toSelect.value
            });
            
            if (changedSelect === fromSelect) {
                toSelect.value = fromSelect.value;
                console.log('Updated "to" select to:', toSelect.value);
            } else {
                fromSelect.value = toSelect.value;
                console.log('Updated "from" select to:', fromSelect.value);
            }
            
            // Always update both UI states after synchronization
            handleCommissionFromDateTypeChange();
            handleCommissionToDateTypeChange();
        };

        // Add event listeners for synchronization (only these, no duplicates)
        if (commissionFromDateTypeSelect) {
            commissionFromDateTypeSelect.addEventListener('change', function() {
                synchronizeCommissionDateTypes(this);
            });
        }
        
        if (commissionToDateTypeSelect) {
            commissionToDateTypeSelect.addEventListener('change', function() {
                synchronizeCommissionDateTypes(this);
            });
        }

        // Initial check for commission date types
        handleCommissionFromDateTypeChange();
        handleCommissionToDateTypeChange();

        // Function to handle assignment date type changes
        function handleAssignmentDateTypeChange(selectElement, isFrom = true) {
            const entry = selectElement.closest('.assignment-entry');
            const index = entry.getAttribute('data-index');
            const dateInput = entry.querySelector(`input[name="assignments[${index}][${isFrom ? 'from' : 'to'}"]`);
            const monthYearGroup = entry.querySelector(`#assignment-${isFrom ? 'from' : 'to'}-month-year-group-${index}`);
            
            if (selectElement.value === 'exact') {
                dateInput.classList.remove('hidden');
                monthYearGroup.classList.add('hidden');
            } else {
                dateInput.classList.add('hidden');
                monthYearGroup.classList.remove('hidden');
            }
        }

        // Function to synchronize assignment date types for a specific entry
        function synchronizeAssignmentDateTypes(entry, changedSelect) {
            const index = entry.getAttribute('data-index');
            const fromSelect = entry.querySelector(`select[name="assignments[${index}][from_type]"]`);
            const toSelect = entry.querySelector(`select[name="assignments[${index}][to_type]"]`);
            
            console.log('Synchronizing assignment dates for entry', index, ':', {
                changedSelect: changedSelect.name,
                fromSelectValue: fromSelect.value,
                toSelectValue: toSelect.value
            });
            
            if (changedSelect === fromSelect) {
                toSelect.value = fromSelect.value;
                console.log('Updated "to" select to:', toSelect.value);
            } else {
                fromSelect.value = toSelect.value;
                console.log('Updated "from" select to:', fromSelect.value);
            }
            
            // Always update both UI states after synchronization
            const fromDateInput = entry.querySelector(`input[name="assignments[${index}][from]"]`);
            const fromMonthYearGroup = entry.querySelector(`#assignment-from-month-year-group-${index}`);
            const toDateInput = entry.querySelector(`input[name="assignments[${index}][to]"]`);
            const toMonthYearGroup = entry.querySelector(`#assignment-to-month-year-group-${index}`);
            
            if (fromSelect.value === 'exact') {
                fromDateInput.classList.remove('hidden');
                fromMonthYearGroup.classList.add('hidden');
                toDateInput.classList.remove('hidden');
                toMonthYearGroup.classList.add('hidden');
            } else {
                fromDateInput.classList.add('hidden');
                fromMonthYearGroup.classList.remove('hidden');
                toDateInput.classList.add('hidden');
                toMonthYearGroup.classList.remove('hidden');
            }
        }

        // Add event listeners for initial assignment date type selects
        const initialAssignmentFromTypeSelect = document.querySelector('select[name="assignments[0][from_type]"]');
        const initialAssignmentToTypeSelect = document.querySelector('select[name="assignments[0][to_type]"]');
        const initialAssignmentEntry = document.querySelector('.assignment-entry[data-index="0"]');
        
        if (initialAssignmentFromTypeSelect && initialAssignmentEntry) {
            initialAssignmentFromTypeSelect.addEventListener('change', function() {
                synchronizeAssignmentDateTypes(initialAssignmentEntry, this);
            });
        }
        
        if (initialAssignmentToTypeSelect && initialAssignmentEntry) {
            initialAssignmentToTypeSelect.addEventListener('change', function() {
                synchronizeAssignmentDateTypes(initialAssignmentEntry, this);
            });
        }

        // Function to handle school date type changes
        function handleSchoolDateTypeChange(selectElement, isFrom = true) {
            const entry = selectElement.closest('.school-entry');
            const index = entry.getAttribute('data-index');
            const dateInput = entry.querySelector(`input[name="schools[${index}][date_attended_${isFrom ? 'from' : 'to'}"]`);
            const monthYearGroup = entry.querySelector(`#school-date-${isFrom ? 'from' : 'to'}-month-year-group-${index}`);
            
            if (selectElement.value === 'exact') {
                dateInput.classList.remove('hidden');
                monthYearGroup.classList.add('hidden');
            } else {
                dateInput.classList.add('hidden');
                monthYearGroup.classList.remove('hidden');
            }
        }

        // Function to synchronize school date types for a specific entry
        function synchronizeSchoolDateTypes(entry, changedSelect) {
            const index = entry.getAttribute('data-index');
            const fromSelect = entry.querySelector(`select[name="schools[${index}][date_attended_from_type]"]`);
            const toSelect = entry.querySelector(`select[name="schools[${index}][date_attended_to_type]"]`);
            
            console.log('Synchronizing school dates for entry', index, ':', {
                changedSelect: changedSelect.name,
                fromSelectValue: fromSelect.value,
                toSelectValue: toSelect.value
            });
            
            if (changedSelect === fromSelect) {
                toSelect.value = fromSelect.value;
                console.log('Updated "to" select to:', toSelect.value);
            } else {
                fromSelect.value = toSelect.value;
                console.log('Updated "from" select to:', fromSelect.value);
            }
            
            // Always update both UI states after synchronization
            const fromDateInput = entry.querySelector(`input[name="schools[${index}][date_attended_from]"]`);
            const fromMonthYearGroup = entry.querySelector(`#school-date-from-month-year-group-${index}`);
            const toDateInput = entry.querySelector(`input[name="schools[${index}][date_attended_to]"]`);
            const toMonthYearGroup = entry.querySelector(`#school-date-to-month-year-group-${index}`);
            
            if (fromSelect.value === 'exact') {
                fromDateInput.classList.remove('hidden');
                fromMonthYearGroup.classList.add('hidden');
                toDateInput.classList.remove('hidden');
                toMonthYearGroup.classList.add('hidden');
            } else {
                fromDateInput.classList.add('hidden');
                fromMonthYearGroup.classList.remove('hidden');
                toDateInput.classList.add('hidden');
                toMonthYearGroup.classList.remove('hidden');
            }
        }

        // Add event listeners for initial school date type selects
        const initialSchoolFromTypeSelect = document.querySelector('select[name="schools[0][date_attended_from_type]"]');
        const initialSchoolToTypeSelect = document.querySelector('select[name="schools[0][date_attended_to_type]"]');
        const initialSchoolEntry = document.querySelector('.school-entry[data-index="0"]');
        
        if (initialSchoolFromTypeSelect && initialSchoolEntry) {
            initialSchoolFromTypeSelect.addEventListener('change', function() {
                synchronizeSchoolDateTypes(initialSchoolEntry, this);
            });
        }
        
        if (initialSchoolToTypeSelect && initialSchoolEntry) {
            initialSchoolToTypeSelect.addEventListener('change', function() {
                synchronizeSchoolDateTypes(initialSchoolEntry, this);
            });
        }

        // Unit Assignments functionality
        const assignmentsContainer = document.getElementById('assignments-container');
        const addAssignmentBtn = document.getElementById('add-assignment');

        addAssignmentBtn.addEventListener('click', () => {
            const entries = assignmentsContainer.querySelectorAll('.assignment-entry');
            const idx = entries.length;
            const assignmentEntry = document.createElement('div');
            assignmentEntry.className = 'assignment-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            assignmentEntry.setAttribute('data-index', idx);
            assignmentEntry.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                        <div class="flex space-x-2">
                            <select name="assignments[${idx}][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="exact">Exact Date</option>
                                <option value="month_year">Month/Year</option>
                            </select>
                            <input type="date" name="assignments[${idx}][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <div class="w-2/3 flex space-x-2 hidden" id="assignment-from-month-year-group-${idx}">
                                <select name="assignments[${idx}][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                <input type="number" name="assignments[${idx}][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                        <div class="flex space-x-2">
                            <select name="assignments[${idx}][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="exact">Exact Date</option>
                                <option value="month_year">Month/Year</option>
                            </select>
                            <input type="date" name="assignments[${idx}][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <div class="w-2/3 flex space-x-2 hidden" id="assignment-to-month-year-group-${idx}">
                                <select name="assignments[${idx}][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                <input type="number" name="assignments[${idx}][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Unit/Office</label>
                        <input type="text" name="assignments[${idx}][unit_office]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter unit or office">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">CO/Chief of Office</label>
                        <input type="text" name="assignments[${idx}][co_chief]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter CO or Chief of Office">
                    </div>
                </div>
                <button type="button" class="remove-assignment absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            assignmentsContainer.appendChild(assignmentEntry);

            // Add event listeners for the new assignment date type selects
            const newAssignmentFromTypeSelect = assignmentEntry.querySelector(`select[name="assignments[${idx}][from_type]"]`);
            const newAssignmentToTypeSelect = assignmentEntry.querySelector(`select[name="assignments[${idx}][to_type]"]`);
            
            newAssignmentFromTypeSelect.addEventListener('change', function() {
                synchronizeAssignmentDateTypes(assignmentEntry, this);
            });
            
            newAssignmentToTypeSelect.addEventListener('change', function() {
                synchronizeAssignmentDateTypes(assignmentEntry, this);
            });
        });

        assignmentsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-assignment')) {
                const entries = assignmentsContainer.querySelectorAll('.assignment-entry');
                if (entries.length > 1) {
                    e.target.closest('.assignment-entry').remove();
                }
            }
        });

        // Military Schools functionality
        const schoolsContainer = document.getElementById('schools-container');
        const addSchoolBtn = document.getElementById('add-school');

        addSchoolBtn.addEventListener('click', () => {
            const entries = schoolsContainer.querySelectorAll('.school-entry');
            const idx = entries.length;
            const schoolEntry = document.createElement('div');
            schoolEntry.className = 'school-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            schoolEntry.setAttribute('data-index', idx);
            schoolEntry.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                        <input type="text" name="schools[${idx}][school]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="schools[${idx}][location]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school location">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance (From)</label>
                        <div class="flex space-x-2">
                            <select name="schools[${idx}][date_attended_from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="exact">Exact Date</option>
                                <option value="month_year">Month/Year</option>
                            </select>
                            <input type="date" name="schools[${idx}][date_attended_from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <div class="w-2/3 flex space-x-2 hidden" id="school-date-from-month-year-group-${idx}">
                                <select name="schools[${idx}][date_attended_from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                <input type="number" name="schools[${idx}][date_attended_from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance (To)</label>
                        <div class="flex space-x-2">
                            <select name="schools[${idx}][date_attended_to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="exact">Exact Date</option>
                                <option value="month_year">Month/Year</option>
                            </select>
                            <input type="date" name="schools[${idx}][date_attended_to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <div class="w-2/3 flex space-x-2 hidden" id="school-date-to-month-year-group-${idx}">
                                <select name="schools[${idx}][date_attended_to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                <input type="number" name="schools[${idx}][date_attended_to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                        <input type="text" name="schools[${idx}][nature_training]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter nature of training">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <input type="text" name="schools[${idx}][rating]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter rating">
                    </div>
                </div>
                <button type="button" class="remove-school absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            schoolsContainer.appendChild(schoolEntry);

            // Add event listeners for the new school date type selects
            const newSchoolFromTypeSelect = schoolEntry.querySelector(`select[name="schools[${idx}][date_attended_from_type]"]`);
            const newSchoolToTypeSelect = schoolEntry.querySelector(`select[name="schools[${idx}][date_attended_to_type]"]`);
            
            newSchoolFromTypeSelect.addEventListener('change', function() {
                synchronizeSchoolDateTypes(schoolEntry, this);
            });
            
            newSchoolToTypeSelect.addEventListener('change', function() {
                synchronizeSchoolDateTypes(schoolEntry, this);
            });
        });

        schoolsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-school')) {
                const entries = schoolsContainer.querySelectorAll('.school-entry');
                if (entries.length > 1) {
                    e.target.closest('.school-entry').remove();
                }
            }
        });

        // Awards functionality
        const awardsContainer = document.getElementById('awards-container');
        const addAwardBtn = document.getElementById('add-award');

        addAwardBtn.addEventListener('click', () => {
            const entries = awardsContainer.querySelectorAll('.award-entry');
            const idx = entries.length;
            const awardEntry = document.createElement('div');
            awardEntry.className = 'award-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            awardEntry.setAttribute('data-index', idx);
            awardEntry.innerHTML = `
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <input type="text" name="awards[${idx}][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter award or decoration name">
                    </div>
                </div>
                <button type="button" class="remove-award absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            awardsContainer.appendChild(awardEntry);
        });

        awardsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-award')) {
                const entries = awardsContainer.querySelectorAll('.award-entry');
                if (entries.length > 1) {
                    e.target.closest('.award-entry').remove();
                }
            }
        });
    });
</script>
@endsection
@php($currentSection = 'military-history') 