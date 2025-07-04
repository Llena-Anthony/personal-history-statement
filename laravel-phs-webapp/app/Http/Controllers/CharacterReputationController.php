<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReferenceDetail;
use App\Models\Miscellaneous;
use Illuminate\Support\Facades\Auth;
use App\Traits\PHSSectionTracking;

class CharacterReputationController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $user = Auth::user();

        // Get character references for this user
        $characterReferences = ReferenceDetail::where('username', $user->id)
            ->where('ref_type', 'character')
            ->get();

        // If no character references exist, create 5 empty ones
        if ($characterReferences->isEmpty()) {
            $characterReferences = collect(array_fill(0, 5, new ReferenceDetail()));
        }

        // Get neighbors (stored as miscellaneous with type 'neighbor')
        $neighbors = ReferenceDetail::where('username', $user->id)
            ->where('ref_type', 'neighbor')
            ->get();

        // If no neighbors exist, create 3 empty ones
        if ($neighbors->isEmpty()) {
            $neighbors = collect(array_fill(0, 3, new ReferenceDetail()));
        }

        $commonData = $this->getCommonViewData('character-and-reputation');

        return view('phs.character-reputation', array_merge($commonData, [
            'characterReferences' => $characterReferences,
            'neighbors' => $neighbors,
        ]));
    }

    public function store(Request $request)
    {
        $this->markSectionAsCompleted('character-and-reputation');

        $user = Auth::user();

        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // Validation rules
        $characterRefRules = $isSaveOnly ? 'nullable|string|max:255' : 'required|string|max:255';
        $neighborRules = $isSaveOnly ? 'nullable|string|max:255' : 'required|string|max:255';

        try {
            $validated = $request->validate([
                'character_references.*.name' => $characterRefRules,
                'character_references.*.address' => $characterRefRules,
                'neighbors.*.name' => $neighborRules,
                'neighbors.*.address' => $neighborRules,
            ]);

            \Log::info('CharacterReputation validated data:', $validated);

            // Clear existing character references for this user
            CharacterReference::where('user_id', $user->id)
                ->where('ref_relationship', 'character_reference')
                ->delete();

            // Save character references
            if ($request->has('character_references')) {
                foreach ($request->character_references as $reference) {
                    if (!empty($reference['name']) || !empty($reference['address'])) {
                        CharacterReference::create([
                            'user_id' => $user->id,
                            'ref_name' => $reference['name'] ?? '',
                            'ref_address' => $reference['address'] ?? '',
                            'ref_occupation' => '',
                            'ref_employer' => '',
                            'ref_contact' => '',
                            'ref_relationship' => 'character_reference',
                        ]);
                    }
                }
            }

            // Clear existing neighbors
            Miscellaneous::where('user_id', $user->id)
                ->where('misc_type', 'neighbor')
                ->delete();

            // Save neighbors
            if ($request->has('neighbors')) {
                foreach ($request->neighbors as $index => $neighbor) {
                    if (!empty($neighbor['name']) || !empty($neighbor['address'])) {
                        Miscellaneous::create([
                            'user_id' => $user->id,
                            'misc_type' => 'neighbor',
                            'misc_details' => json_encode([
                                'name' => $neighbor['name'] ?? '',
                                'address' => $neighbor['address'] ?? '',
                            ]),
                        ]);
                    }
                }
            }

            \Log::info('CharacterReputation after save:', [
                'character_references' => CharacterReference::where('user_id', $user->id)
                    ->where('ref_relationship', 'character_reference')
                    ->get()->toArray(),
                'neighbors' => Miscellaneous::where('user_id', $user->id)
                    ->where('misc_type', 'neighbor')
                    ->get()->toArray(),
            ]);

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Character and reputation information saved successfully']);
            }

            return redirect()->route('phs.organization')
                ->with('success', 'Character and reputation information saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your character and reputation information. Please try again.');
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
