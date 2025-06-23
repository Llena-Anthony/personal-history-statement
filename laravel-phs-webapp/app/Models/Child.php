<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_background_id',
        'full_name',
        'date_of_birth',
        'citizenship',
        'address',
        'father_name',
        'mother_name',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function familyBackground()
    {
        return $this->belongsTo(FamilyBackground::class);
    }
} 