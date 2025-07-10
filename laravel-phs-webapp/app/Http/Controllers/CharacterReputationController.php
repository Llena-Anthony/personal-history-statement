<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Helper\DataRetrieval;

class CharacterReputationController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $prefill = DataRetrieval::retrieveCharacterReputation(auth()->user()->username);
        $data = $this->getCommonViewData('character-and-reputation');
        $data = array_merge($data, $prefill);

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.character-and-reputation-content', $data)->render();
        }
        return view('phs.character-and-reputation', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        try {
            // Validation (minimal for save-only, full for final submission)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'character_references' => 'nullable|array',
                    'character_references.*.name' => 'nullable|string|max:255',
                    'character_references.*.address' => 'nullable|string|max:255',
                    'neighbors' => 'nullable|array',
                    'neighbors.*.name' => 'nullable|string|max:255',
                    'neighbors.*.address' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'character_references' => 'nullable|array',
                    'character_references.*.name' => 'nullable|string|max:255',
                    'character_references.*.address' => 'nullable|string|max:255',
                    'neighbors' => 'nullable|array',
                    'neighbors.*.name' => 'nullable|string|max:255',
                    'neighbors.*.address' => 'nullable|string|max:255',
                ]);
            }

            $username = auth()->user()->username;
            $data = [
                'character_references' => $validated['character_references'] ?? [],
                'neighbors' => $validated['neighbors'] ?? [],
            ];
            
            \App\Helper\DataUpdate::saveCharacterReputation($data, $username);
            $this->markSectionAsCompleted('character-and-reputation');
            session()->save();

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Character and reputation saved successfully']);
            }

            if ($request->ajax()) {
                $nextRoute = route('phs.organization.create');
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }

            return redirect()->route('phs.organization.create')
                ->with('success', 'Character and reputation saved successfully. Please continue with your organization memberships.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in CharacterReputationController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your character and reputation. Please try again.');
        }
    }

    protected function getSections()
    {
        return [
            'personal-details',
            'family-background',
            'educational-background',
            'employment-history',
            'military-history',
            'places-of-residence',
            'foreign-countries',
            'credit-reputation',
            'arrest-record',
            'character-and-reputation',
            'organization',
            'miscellaneous'
        ];
    }
}
