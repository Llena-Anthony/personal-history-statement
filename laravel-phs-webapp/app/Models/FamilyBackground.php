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