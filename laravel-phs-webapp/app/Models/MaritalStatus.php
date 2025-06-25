<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marital_status',
        'spouse_name_id',
        'spouse_suffix',
        'marriage_date',
        'marriage_date_type',
        'marriage_month',
        'marriage_year',
        'marriage_place',
        'spouse_birth_date',
        'spouse_birth_place',
        'spouse_occupation',
        'spouse_employer',
        'spouse_employment_place',
        'spouse_contact',
        'spouse_citizenship',
        'spouse_other_citizenship',
    ];

    protected $casts = [
        'marriage_date' => 'date',
        'spouse_birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spouseName()
    {
        return $this->belongsTo(NameDetails::class, 'spouse_name_id');
    }
} 