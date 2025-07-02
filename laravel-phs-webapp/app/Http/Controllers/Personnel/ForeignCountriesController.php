<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForeignCountries;

class ForeignCountriesController extends Controller
{
    public function create()
    {
        $foreignCountries = ForeignCountries::where('user_id', auth()->id())->get();
        return view('phs.foreign-countries', [
            'foreignCountries' => $foreignCountries,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // Implement validation and saving logic for foreign countries as needed
        return redirect()->route('personnel.phs.credit-reputation')
            ->with('success', 'Foreign countries saved successfully. Please continue with your credit reputation.');
    }
}
