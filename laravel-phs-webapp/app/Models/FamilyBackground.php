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
        'spouse_occupation',
        'spouse_employer',
        'spouse_business_address',
        'spouse_telephone',
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'father_suffix',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        // Sibling fields
        'sibling1_full_name', 'sibling1_occupation', 'sibling1_address', 'sibling1_contact',
        'sibling2_full_name', 'sibling2_occupation', 'sibling2_address', 'sibling2_contact',
        'sibling3_full_name', 'sibling3_occupation', 'sibling3_address', 'sibling3_contact',
        'sibling4_full_name', 'sibling4_occupation', 'sibling4_address', 'sibling4_contact',
        'sibling5_full_name', 'sibling5_occupation', 'sibling5_address', 'sibling5_contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }
} 