<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_last_name',
        'father_first_name',
        'father_middle_name',
        'father_occupation',
        'father_employer',
        'father_business_address',
        'father_telephone',
        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'mother_occupation',
        'mother_employer',
        'mother_business_address',
        'mother_telephone',
        'spouse_last_name',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_occupation',
        'spouse_employer',
        'spouse_business_address',
        'spouse_telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 