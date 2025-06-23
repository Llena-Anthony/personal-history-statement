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