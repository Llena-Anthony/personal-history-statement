<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Name foreign keys
        'spouse_name_id',
        'father_name_id',
        'mother_name_id',
        'step_parent_guardian_name_id',
        'father_in_law_name_id',
        'mother_in_law_name_id',
        // Spouse details (non-name fields)
        'spouse_suffix',
        'spouse_birth_date',
        'spouse_birth_place',
        'spouse_occupation',
        'spouse_employer',
        'spouse_place_of_employment',
        'spouse_citizenship',
        'spouse_other_citizenship',
        'spouse_naturalized_details',
        'spouse_business_address',
        'spouse_telephone',
        // Father details (non-name fields)
        'father_suffix',
        'father_birth_date',
        'father_birth_place',
        'father_occupation',
        'father_employer',
        'father_place_of_employment',
        'father_citizenship_type',
        'father_citizenship',
        'father_citizenship_dual_1',
        'father_citizenship_dual_2',
        'father_citizenship_naturalized',
        'father_naturalized_month',
        'father_naturalized_year',
        'father_naturalized_place',
        'father_other_citizenship',
        'father_naturalized_details',
        'father_complete_address',
        // Mother details (non-name fields)
        'mother_suffix',
        'mother_birth_date',
        'mother_birth_place',
        'mother_occupation',
        'mother_employer',
        'mother_place_of_employment',
        'mother_citizenship_type',
        'mother_citizenship',
        'mother_citizenship_dual_1',
        'mother_citizenship_dual_2',
        'mother_citizenship_naturalized',
        'mother_naturalized_month',
        'mother_naturalized_year',
        'mother_naturalized_place',
        'mother_other_citizenship',
        'mother_naturalized_details',
        'mother_complete_address',
        // Step-parent or Guardian details (non-name fields)
        'step_parent_guardian_suffix',
        'step_parent_guardian_birth_date',
        'step_parent_guardian_birth_place',
        'step_parent_guardian_occupation',
        'step_parent_guardian_employer',
        'step_parent_guardian_place_of_employment',
        'step_parent_guardian_citizenship_type',
        'step_parent_guardian_citizenship',
        'step_parent_guardian_citizenship_dual_1',
        'step_parent_guardian_citizenship_dual_2',
        'step_parent_guardian_citizenship_naturalized',
        'step_parent_guardian_naturalized_month',
        'step_parent_guardian_naturalized_year',
        'step_parent_guardian_naturalized_place',
        'step_parent_guardian_other_citizenship',
        'step_parent_guardian_naturalized_details',
        'step_parent_guardian_complete_address',
        // Father-in-law details (non-name fields)
        'father_in_law_suffix',
        'father_in_law_birth_date',
        'father_in_law_birth_place',
        'father_in_law_occupation',
        'father_in_law_employer',
        'father_in_law_place_of_employment',
        'father_in_law_citizenship_type',
        'father_in_law_citizenship',
        'father_in_law_citizenship_dual_1',
        'father_in_law_citizenship_dual_2',
        'father_in_law_citizenship_naturalized',
        'father_in_law_naturalized_month',
        'father_in_law_naturalized_year',
        'father_in_law_naturalized_place',
        'father_in_law_other_citizenship',
        'father_in_law_naturalized_details',
        'father_in_law_complete_address',
        // Mother-in-law details (non-name fields)
        'mother_in_law_suffix',
        'mother_in_law_birth_date',
        'mother_in_law_birth_place',
        'mother_in_law_occupation',
        'mother_in_law_employer',
        'mother_in_law_place_of_employment',
        'mother_in_law_citizenship_type',
        'mother_in_law_citizenship',
        'mother_in_law_citizenship_dual_1',
        'mother_in_law_citizenship_dual_2',
        'mother_in_law_citizenship_naturalized',
        'mother_in_law_naturalized_month',
        'mother_in_law_naturalized_year',
        'mother_in_law_naturalized_place',
        'mother_in_law_other_citizenship',
        'mother_in_law_naturalized_details',
        'mother_in_law_complete_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function siblings()
    {
        return $this->hasMany(Sibling::class);
    }

    // Name relationships
    public function spouseName()
    {
        return $this->belongsTo(NameDetails::class, 'spouse_name_id');
    }

    public function fatherName()
    {
        return $this->belongsTo(NameDetails::class, 'father_name_id');
    }

    public function motherName()
    {
        return $this->belongsTo(NameDetails::class, 'mother_name_id');
    }

    public function stepParentGuardianName()
    {
        return $this->belongsTo(NameDetails::class, 'step_parent_guardian_name_id');
    }

    public function fatherInLawName()
    {
        return $this->belongsTo(NameDetails::class, 'father_in_law_name_id');
    }

    public function motherInLawName()
    {
        return $this->belongsTo(NameDetails::class, 'mother_in_law_name_id');
    }
} 