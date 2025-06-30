<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_background_id',
        'name_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'citizenship',
        'dual_citizenship',
        'complete_address',
        'occupation',
        'employer',
        'employer_address',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function familyBackground()
    {
        return $this->belongsTo(FamilyBackground::class);
    }

    public function name()
    {
        return $this->belongsTo(NameDetails::class, 'name_id');
    }
} 