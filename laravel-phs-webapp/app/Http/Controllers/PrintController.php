<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddressDetails;
use App\Models\ArrestRecord;
use App\Model\BankAccount;
use App\Model\BirthDetails;
use App\Models\CharacterReference;
use App\Models\PHSSubmission;
use App\Models\User;

class PrintController extends Controller
{
    public function preview() {
        return view("admin.phs.phs-template");
    }

    // public function preview($username)
    // {

    //     $applicant = User::where('username', $username)->first();
    //     return view("admin.phs.phs-template");
    // }

    public function printPHSSubmission($username)
    {
        $user = \App\Models\User::with([
            'userDetail',
            'userDetail.nameDetail',
            // Address and birth details are accessed via userDetail relationships
        ])->where('username', $username)->firstOrFail();

        // For compatibility with the print-submission view, wrap in a $submission object
        $submission = (object) [
            'user' => $user,
            'status' => $user->phs_status ?? 'pending',
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'admin_notes' => $user->admin_notes ?? null,
        ];

        return view('admin.phs.print-submission', compact('submission'));
    }
}
