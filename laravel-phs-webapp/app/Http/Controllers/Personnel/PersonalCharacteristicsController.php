<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalCharacteristic;
use App\Traits\PHSSectionTracking;

class PersonalCharacteristicsController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $personalCharacteristics = PersonalCharacteristic::where('user_id', auth()->id())->first();
        return view('phs.personal-characteristics', [
            'personalCharacteristics' => $personalCharacteristics,
        ]);
    }

    public function store(Request $request)
    {
        // your saving logic here
    }
}
