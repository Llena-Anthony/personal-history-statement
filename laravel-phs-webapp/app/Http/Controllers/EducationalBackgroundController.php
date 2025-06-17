<?php

namespace App\Http\Controllers;

use App\Models\EducationalBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationalBackgroundController extends Controller
{
    public function create()
    {
        return view('phs.educational-background');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'elementary_name' => 'required|array',
            'elementary_name.*' => 'required|string|max:255',
            'elementary_location' => 'required|array',
            'elementary_location.*' => 'required|string|max:255',
            'elementary_date' => 'required|array',
            'elementary_date.*' => 'required|string|max:255',
            'elementary_graduated' => 'required|array',
            'elementary_graduated.*' => 'required|string|max:255',

            'high_school_name' => 'required|array',
            'high_school_name.*' => 'required|string|max:255',
            'high_school_location' => 'required|array',
            'high_school_location.*' => 'required|string|max:255',
            'high_school_date' => 'required|array',
            'high_school_date.*' => 'required|string|max:255',
            'high_school_graduated' => 'required|array',
            'high_school_graduated.*' => 'required|string|max:255',

            'college_name' => 'required|array',
            'college_name.*' => 'required|string|max:255',
            'college_location' => 'required|array',
            'college_location.*' => 'required|string|max:255',
            'college_date' => 'required|array',
            'college_date.*' => 'required|string|max:255',
            'college_graduated' => 'required|array',
            'college_graduated.*' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $userId = auth()->id();

            // Save Elementary Education
            foreach ($validated['elementary_name'] as $key => $name) {
                EducationalBackground::create([
                    'user_id' => $userId,
                    'level' => 'elementary',
                    'school_name' => $name,
                    'location' => $validated['elementary_location'][$key],
                    'date_of_attendance' => $validated['elementary_date'][$key],
                    'year_graduated' => $validated['elementary_graduated'][$key],
                ]);
            }

            // Save High School Education
            foreach ($validated['high_school_name'] as $key => $name) {
                EducationalBackground::create([
                    'user_id' => $userId,
                    'level' => 'high_school',
                    'school_name' => $name,
                    'location' => $validated['high_school_location'][$key],
                    'date_of_attendance' => $validated['high_school_date'][$key],
                    'year_graduated' => $validated['high_school_graduated'][$key],
                ]);
            }

            // Save College Education
            foreach ($validated['college_name'] as $key => $name) {
                EducationalBackground::create([
                    'user_id' => $userId,
                    'level' => 'college',
                    'school_name' => $name,
                    'location' => $validated['college_location'][$key],
                    'date_of_attendance' => $validated['college_date'][$key],
                    'year_graduated' => $validated['college_graduated'][$key],
                ]);
            }

            DB::commit();

            return redirect()->route('phs.military-history.create')
                ->with('success', 'Educational background saved successfully. Please continue with your military history.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your educational background. Please try again.');
        }
    }
} 