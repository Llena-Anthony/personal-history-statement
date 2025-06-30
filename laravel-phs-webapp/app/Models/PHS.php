<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PHS extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_id',
        'suffix',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'civil_status',
        'height',
        'weight',
        'blood_type',
        'gsis_id',
        'philhealth_no',
        'tin_no',
        'pagibig_id',
        'sss_no',
        'agency_employee_no',
        'citizenship',
        'dual_citizenship_by_birth',
        'dual_citizenship_by_naturalization',
        'dual_citizenship_country',
        'residential_house_no',
        'residential_street',
        'residential_subdivision',
        'residential_barangay',
        'residential_city',
        'residential_province',
        'residential_zip',
        'permanent_house_no',
        'permanent_street',
        'permanent_subdivision',
        'permanent_barangay',
        'permanent_city',
        'permanent_province',
        'permanent_zip',
        'telephone',
        'mobile',
        'email',
        // Section 1 fields
        'rank',
        'afpsn',
        'branch_of_service',
        'present_job',
        'religion',
        'home_address',
        'business_address',
        'change_in_name',
        'nickname',
        'passport_number',
        'passport_expiry',
        'nationality',
        // Enhanced address fields
        'home_region',
        'home_province',
        'home_city',
        'home_barangay',
        'home_street',
        'home_complete_address',
        'business_region',
        'business_province',
        'business_city',
        'business_barangay',
        'business_street',
        'business_complete_address',
        'home_region_name',
        'home_province_name',
        'home_city_name',
        'home_barangay_name',
        'business_region_name',
        'business_province_name',
        'business_city_name',
        'business_barangay_name',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_expiry' => 'date',
        'dual_citizenship_by_birth' => 'boolean',
        'dual_citizenship_by_naturalization' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function name()
    {
        return $this->belongsTo(NameDetails::class, 'name_id');
    }

    // Helper method to get full name from name relationship
    public function getFullNameAttribute()
    {
        if (!$this->name) {
            return '';
        }
        
        $name = $this->name->first_name ?? '';
        if ($this->name->middle_name) {
            $name .= ' ' . $this->name->middle_name;
        }
        if ($this->name->last_name) {
            $name .= ' ' . $this->name->last_name;
        }
        if ($this->suffix) {
            $name .= ' ' . $this->suffix;
        }
        return trim($name);
    }

    // Helper method to get first name (from name relationship)
    public function getFirstNameAttribute()
    {
        return $this->name ? $this->name->first_name : null;
    }

    // Helper method to get middle name (from name relationship)
    public function getMiddleNameAttribute()
    {
        return $this->name ? $this->name->middle_name : null;
    }

    // Helper method to get last name (from name relationship)
    public function getLastNameAttribute()
    {
        return $this->name ? $this->name->last_name : null;
    }
} 