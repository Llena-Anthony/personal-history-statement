<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_last_name',
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
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'father_suffix',
        'father_birth_date',
        'father_birth_place',
        'father_occupation',
        'father_employer',
        'father_place_of_employment',
        'father_citizenship',
        'father_other_citizenship',
        'father_naturalized_details',
        'father_complete_address',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'mother_suffix',
        'mother_birth_date',
        'mother_birth_place',
        'mother_occupation',
        'mother_employer',
        'mother_place_of_employment',
        'mother_citizenship',
        'mother_other_citizenship',
        'mother_naturalized_details',
        'mother_complete_address',
        // Step-parent or Guardian
        'step_parent_guardian_first_name',
        'step_parent_guardian_middle_name',
        'step_parent_guardian_last_name',
        'step_parent_guardian_suffix',
        'step_parent_guardian_birth_date',
        'step_parent_guardian_birth_place',
        'step_parent_guardian_occupation',
        'step_parent_guardian_employer',
        'step_parent_guardian_place_of_employment',
        'step_parent_guardian_citizenship',
        'step_parent_guardian_other_citizenship',
        'step_parent_guardian_naturalized_details',
        'step_parent_guardian_complete_address',
        // Father-in-law
        'father_in_law_first_name',
        'father_in_law_middle_name',
        'father_in_law_last_name',
        'father_in_law_suffix',
        'father_in_law_birth_date',
        'father_in_law_birth_place',
        'father_in_law_occupation',
        'father_in_law_employer',
        'father_in_law_place_of_employment',
        'father_in_law_citizenship',
        'father_in_law_other_citizenship',
        'father_in_law_naturalized_details',
        'father_in_law_complete_address',
        // Mother-in-law
        'mother_in_law_first_name',
        'mother_in_law_middle_name',
        'mother_in_law_last_name',
        'mother_in_law_suffix',
        'mother_in_law_birth_date',
        'mother_in_law_birth_place',
        'mother_in_law_occupation',
        'mother_in_law_employer',
        'mother_in_law_place_of_employment',
        'mother_in_law_citizenship',
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
} 