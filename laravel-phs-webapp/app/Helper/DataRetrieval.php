<?php

namespace App\Helper;

use App\Models\ActivityLogDetail;
use App\Models\AddressDetail;
use App\Models\ArrestDetail;
use App\Models\ArrestRecordDetail;
use App\Models\AssignmentDetail;
use App\Models\AwardDetail;
use App\Models\BankAccountDetail;
use App\Models\BankDetail;
use App\Models\ChildrenDetail;
use App\Models\CitizenshipDetail;
use App\Models\CreditDetail;
use App\Models\CreditReferenceDetail;
use App\Models\DescriptionDetail;
use App\Models\EducationDetail;
use App\Models\EmploymentDetail;
use App\Models\FamilyDetail;
use App\Models\FamilyHistoryDetail;
use App\Models\FluencyDetail;
use App\Models\ForeignVisitDetail;
use App\Models\GovernmentIdDetail;
use App\Models\JobDetail;
use App\Models\LanguageDetail;
use App\Models\MaritalDetail;
use App\Models\MembershipDetail;
use App\Models\MilitaryHistoryDetail;
use App\Models\MilitarySchoolDetail;
use App\Models\NameDetail;
use App\Models\OccupationDetail;
use App\Models\OrganizationDetail;
use App\Models\PersonalDetail;
use App\Models\ReferenceDetail;
use App\Models\SchoolDetail;
use App\Models\SiblingDetail;
use App\Models\SpouseDetail;
use App\Models\User;
use App\Models\UserDetail;

class DataRetrieval {
    public static function retrieveAddressDetail($addr_id): ?AddressDetail {
        return AddressDetail::where('addr_id', $addr_id)->first();
    }
    public static function retrieveCitizenshipDetail($citId): ?CitizenshipDetail {
        return CitizenshipDetail::where('cit_id', $citId)->first();
    }
    public static function retrieveGovIdDetail($username): ?GovernmentIdDetail {
        return GovernmentIdDetail::where('username',$username)->first();
    }
    public static function retrieveJobDetail($username): ?JobDetail {
        return JobDetail::where('username', $username)->first() ?? null;
    }
    public static function retrieveNameDetail($nameId): ?NameDetail {
        return NameDetail::where('name_id', $nameId)->first();
    }
    public static function retrieveUserDetail($username): ?UserDetail {
        return UserDetail::where('username', $username)->first();
    }
}
