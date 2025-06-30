<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_name',
        'father_occupation',
        'father_employer',
        'father_business_address',
        'father_telephone',
        'mother_name',
        'mother_occupation',
        'mother_employer',
        'mother_business_address',
        'mother_telephone',
        'guardian_name',
        'spouse_occupation',
        'spouse_employer',
        'spouse_business_address',
        'spouse_telephone',
        'father_inlaw_name',
        'mother_inlaw_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
