<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'addr_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'address_detail';

    protected $fillable = [
        'country',
        'region',
        'province',
        'city',
        'municipality',
        'barangay',
        'street',
        'zip_code',
    ];

    public function bankDetail()
    {
        return $this->hasMany(BankDetail::class, 'bank_addr', 'addr_id');
    }

    public function childrenDetail()
    {
        return $this->hasMany(ChildrenDetail::class, 'addr', 'addr_id');
    }

    public function employmentDetail()
    {
        return $this->hasMany(EmploymentDetail::class, 'employ_addr', 'addr_id');
    }

    public function familyBirthPlace()
    {
        return $this->hasMany(FamilyDetail::class, 'birth_place', 'addr_id');
    }

    public function familyAddress()
    {
        return $this->hasMany(FamilyDetail::class, 'fam_addr', 'addr_id');
    }

    public function familyNaturalized()
    {
        return $this->hasMany(FamilyDetail::class, 'place_naturalized', 'addr_id');
    }

    public function foreignVisitDetail()
    {
        return $this->hasMany(ForeignVisitDetail::class, 'visit_addr', 'addr_id');
    }

    public function jobDetail()
    {
        return $this->hasMany(JobDetail::class, 'job_addr', 'addr_id');
    }

    public function organizationDetail()
    {
        return $this->hasMany(OrganizationDetail::class, 'org_addr', 'addr_id');
    }

    public function occupationDetail()
    {
        return $this->hasMany(OccupationDetail::class, 'occupation_addr', 'addr_id');
    }

    public function referenceDetail()
    {
        return $this->hasMany(ReferenceDetail::class, 'ref_addr', 'addr_id');
    }

    public function schoolDetail()
    {
        return $this->hasMany(SchoolDetail::class, 'school_addr', 'addr_id');
    }

    public function spouseMarriage()
    {
        return $this->hasMany(SpouseDetail::class, 'marr_place','addr_id');
    }

    public function spouseBirth()
    {
        return $this->hasMany(SpouseDetail::class,'birth_place','addr_id');
    }

    public function userAddress()
    {
        return $this->hasMany(UserDetail::class,'home_addr','addr_id');
    }

    public function userBirth()
    {
        return $this->hasMany(UserDetail::class,'birth_place','addr_id');
    }
}
