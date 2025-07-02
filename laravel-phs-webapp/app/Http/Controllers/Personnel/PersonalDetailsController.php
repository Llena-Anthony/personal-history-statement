<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PersonalDetailsController extends Controller
{
    public function create()
    {
        $phs = \App\Models\PHS::where('user_id', auth()->id())->first();
        $userDetails = \App\Models\UserDetails::where('username', auth()->user()->username)
            ->with('nameDetails')
            ->first();

        return view('phs.personal-details', [
            'phs' => $phs,
            'userDetails' => $userDetails,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        try {
            if ($isSaveOnly) {
                $validated = $request->all();
            } else {
                // Full validation for final submission (add as needed)
                $validated = $request->all();
            }

            // Add user_id
            $validated['user_id'] = auth()->id();

            // Save or update PHS
            $phs = \App\Models\PHS::where('user_id', auth()->id())->first();
            if ($phs) {
                $phs->update($validated);
            } else {
                $phs = \App\Models\PHS::create($validated);
            }

            // Redirect or respond
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Personal details saved successfully']);
            }

            return redirect()->route('personnel.phs.personal-characteristics')
                ->with('success', 'Personal details saved successfully. Please continue with your personal characteristics.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'An error occurred while saving your personal information. Please try again.');
        }
    }
}
