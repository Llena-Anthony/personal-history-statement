<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResidenceHistory;

class PlacesOfResidenceController extends Controller
{
    public function create()
    {
        $residenceHistory = ResidenceHistory::where('user_id', auth()->id())->get();
        return view('phs.places-of-residence', [
            'residenceHistory' => $residenceHistory,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // Implement validation and saving logic for residence history as needed
        return redirect()->route('personnel.phs.foreign-countries')
            ->with('success', 'Places of residence saved successfully. Please continue with your foreign countries.');
    }
}
