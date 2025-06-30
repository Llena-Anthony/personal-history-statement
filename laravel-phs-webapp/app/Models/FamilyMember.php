<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_id',
        'role',
        'birth_id',
        'birth_date',
        'birth_place',
        'occupation',
        'employer',
        'employment_addr',
        'place_of_employment',
        'complete_address',
        'citizenship_type',
        'citizenship',
        'citizenship_dual_1',
        'citizenship_dual_2',
        'citizenship_naturalized',
        'naturalized_month',
        'naturalized_year',
        'naturalized_place',
        'isnaturalized',
        'naturalized_details',
        'suffix',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nameDetails()
    {
        return $this->belongsTo(NameDetails::class, 'name_id', 'name_id');
    }

    public function birthDetails()
    {
        return $this->belongsTo(BirthDetails::class, 'birth_id', 'birth_id');
    }

    public function employmentAddress()
    {
        return $this->belongsTo(AddressDetails::class, 'employment_addr', 'addr_id');
    }
} 