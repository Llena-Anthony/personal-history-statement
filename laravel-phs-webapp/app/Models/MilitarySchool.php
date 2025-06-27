<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitarySchool extends Model
{
    use HasFactory;

    protected $table = 'military_school_attended';
    protected $primaryKey = 'history_id';

    protected $fillable = [
        'history_id',
        'username',
        'school_location',
        'date_attended_from_month',
        'date_attended_from_year',
        'date_attended_to_month',
        'date_attended_to_year',
        'date_attended',
        'exact_date_attended',
        'date_attended_type',
        'date_attended_month',
        'date_attended_year',
        'nature_of_training',
        'rating',
    ];

    protected $casts = [
        'exact_date_attended' => 'date',
    ];

    public function militaryHistory()
    {
        return $this->belongsTo(MilitaryHistory::class, 'username', 'username');
    }

    public function addressDetails()
    {
        return $this->belongsTo(AddressDetails::class, 'school_location', 'addr_id');
    }
}
