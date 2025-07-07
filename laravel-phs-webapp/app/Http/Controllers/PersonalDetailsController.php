<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Models\User;
use App\Models\UserDetail;
use App\Models\ActivityLogDetail;
use App\Models\NameDetail;
use App\Models\AddressDetail;
use App\Models\JobDetail;
use App\Models\GovernmentIdDetail;

Use App\Traits\PHSSectionTracking;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalDetailsController extends Controller
{
    public function create()
    {
        $user = User::find(auth()->id());

        $data = UserDetail::with('nameDetail')
        ->where('username',auth()->user()->username)
        ->first();

        $viewData = $this->getCommonViewData('personal-details');
        $viewData['personalDetails'] = $user;
        $viewData['userDetails'] = $data;

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.personal-details', $viewData)->render();
        }

        return view('phs.personal-details', $viewData);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'birth_region' => 'nullable|string|max:255',
            'birth_province' => 'nullable|string|max:255',
            'birth_city' => 'nullable|string|max:255',
            'birth_barangay' => 'nullable|string|max:255',
            'birth_street' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'afpsn' => 'nullable|string|max:255',
            'branch_of_service' => 'nullable|string|max:255',
            'present_job' => 'nullable|string|max:255',
            'home_region' => 'nullable|string|max:255',
            'home_province' => 'required|string|max:255',
            'home_city' => 'required|string|max:255',
            'home_barangay' => 'nullable|string|max:255',
            'home_street' => 'nullable|string|max:255',
            'business_region' => 'nullable|string|max:255',
            'business_province' => 'nullable|string|max:255',
            'business_city' => 'nullable|string|max:255',
            'business_barangay' => 'nullable|string|max:255',
            'business_street' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'passport_expiry' => 'nullable|string|max:255',
            'name_change' => 'nullable|string|max:255',
        ]);

        $nameData = $request->only([
                    'last_name', 'first_name', 'middle_name', 'suffix'
                ]);

        // Validate and store the personal details

        $existingUserDetail = UserDetail::where('username', auth()->user()->username)->first();
        if ($existingUserDetail) {
            // Check if user
            if (!is_null($existingUserDetail->full_name)) {


            } else {
                $recordedName = $this->nameExists($nameData);

                if ($recordedName) {
                    $existingUserDetail->update([
                        'full_name' => $recordedName->id
                    ]);
                } else {
                    $existingUserDetail->update([
                        'full_name' => $this->createNewName($nameData)
                    ]);
                }
            }
        } else {
            $newUserDetail = UserDetail::create([
                'username' => auth() ->user()->username,
            ]);
        }

        return redirect()->route('phs.personal-characteristics.create');
            // ->with('success', 'Personal details saved successfully.');
    }
    private function nameExists($nameData):?NameDetail {
        return NameDetail::where('last_name',$nameData['last_name'])
                    ->where('first_name',$nameData['first_name'])
                    ->where('middle_name',$nameData['middle_name'])
                    ->where('name_extension',$nameData['suffix'])
                    ->first();
    }

    private function createNewName($nameData):int {
        return NameDetail::create([
                        'last_name' => $nameData['last_name'],
                        'first_name'=> $nameData['first_name'],
                        'middle_name' => $nameData['middle_name'],
                        'name_extension'=> $nameData['suffix'],
                    ])->id;
    }

    private function getCommonViewData($currentSection)
    {
        // Mark current section as visited
        session(["phs_sections.{$currentSection}" => 'visited']);

        return [
            'currentSection' => $currentSection,
            // 'sectionStatus' => $this->getSectionStatus()
        ];
    }

}
