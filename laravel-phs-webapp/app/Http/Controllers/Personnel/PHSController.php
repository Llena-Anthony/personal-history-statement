<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Models\PHSSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PHSController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        Log::info('[PHS Access] Personnel #' . $user->id . ' (' . $user->name . ') accessed ' . request()->path() .
            ' from IP: ' . request()->ip() .
            ' using ' . request()->header('User-Agent'));
        $submissions = PHSSubmission::where('user_id', $user->id)->paginate(10);
        return view('personnel.phs.index', compact('submissions'));
    }
} 