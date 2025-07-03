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
    // public function preview() {
    //     return view("admin.phs.phs-template");
    // }

    public function preview($username)
    {

        $applicant = User::where('username', $username)->first();
        return view("admin.phs.phs-template");
    }

    public function printPHSSubmission(PHSSubmission $submission)
    {
        // Load the submission with all related data
        $submission->load([
            'user',
            'user.personalInfo',
            'user.familyHistory',
            'user.educationalBackground',
            'user.employmentHistory',
            'user.militaryHistory',
            'user.addressDetails',
            'user.nameDetails',
            'user.birthDetails'
        ]);

        return view('admin.phs.print-submission', compact('submission'));
    }
}
