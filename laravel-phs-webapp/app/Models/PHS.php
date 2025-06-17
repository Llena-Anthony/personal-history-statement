<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PHS extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
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
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'dual_citizenship_by_birth' => 'boolean',
        'dual_citizenship_by_naturalization' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 