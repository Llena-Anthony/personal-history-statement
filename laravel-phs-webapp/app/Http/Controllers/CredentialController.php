<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApplicantCredentials;
use App\Models\User;

class CredentialController extends Controller
{
    public function sendEmail(Request $request, User $user)
    {
        // For demo: get password from request (in production, store/retrieve securely)
        $plainPassword = $request->input('password');
        if (!$plainPassword) {
            return response()->json(['message' => 'Password not provided.'], 400);
        }
        Mail::to($user->email)->send(new SendApplicantCredentials($user, $plainPassword));
        return response()->json(['message' => 'Credentials sent to ' . $user->email]);
    }
} 