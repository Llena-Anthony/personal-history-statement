<?php

namespace App\Http\Controllers;

use App\Models\ArrestRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrestRecordController extends Controller
{
    public function create()
    {
        $arrestRecord = ArrestRecord::where('username', Auth::user()->username)->first();
        
        if (request()->ajax()) {
            return view('phs.sections.arrest-record-content', compact('arrestRecord'));
        }

        return view('phs.arrest-record', compact('arrestRecord'));
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'investigated_arrested' => 'nullable|in:yes,no',
                'investigated_arrested_details' => 'nullable|string|max:1000',
                'family_investigated_arrested' => 'nullable|in:yes,no',
                'family_investigated_arrested_details' => 'nullable|string|max:1000',
                'administrative_case' => 'nullable|in:yes,no',
                'administrative_case_details' => 'nullable|string|max:1000',
                'pd1081_arrested' => 'nullable|in:yes,no',
                'pd1081_arrested_details' => 'nullable|string|max:1000',
                'intoxicating_liquor_narcotics' => 'nullable|in:yes,no',
                'intoxicating_liquor_narcotics_details' => 'nullable|string|max:1000',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'investigated_arrested' => 'required|in:yes,no',
                'investigated_arrested_details' => 'required_if:investigated_arrested,yes|string|max:1000',
                'family_investigated_arrested' => 'required|in:yes,no',
                'family_investigated_arrested_details' => 'required_if:family_investigated_arrested,yes|string|max:1000',
                'administrative_case' => 'required|in:yes,no',
                'administrative_case_details' => 'required_if:administrative_case,yes|string|max:1000',
                'pd1081_arrested' => 'required|in:yes,no',
                'pd1081_arrested_details' => 'required_if:pd1081_arrested,yes|string|max:1000',
                'intoxicating_liquor_narcotics' => 'required|in:yes,no',
                'intoxicating_liquor_narcotics_details' => 'required_if:intoxicating_liquor_narcotics,yes|string|max:1000',
            ]);
        }

        // Add username to validated data
        $validated['username'] = Auth::user()->username;

        \Log::info('ArrestRecord validated data:', $validated);

        try {
            // Save or update arrest record
            $arrestRecord = ArrestRecord::updateOrCreate(
                ['username' => Auth::user()->username],
                $validated
            );

            \Log::info('ArrestRecord after save:', $arrestRecord->toArray());

            // Mark section as completed
            session()->put('phs_sections.arrest-record', 'completed');
            
            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Arrest record and conduct information saved successfully']);
            }
            
            return redirect()->route('phs.character-and-reputation')->with('success', 'Arrest record and conduct saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your arrest record. Please try again.');
        }
    }
}
