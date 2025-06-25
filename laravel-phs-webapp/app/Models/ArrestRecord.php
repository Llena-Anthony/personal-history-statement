<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArrestRecord extends Model
{
    protected $table = 'arrest_record';
    protected $primaryKey = 'arrest_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'date_of_arrest',
        'case_number',
        'arresting_agency',
        'place_of_arrest',
        'case_status',
        'case_details',
        'investigated_arrested',
        'investigated_arrested_details',
        'family_investigated_arrested',
        'family_investigated_arrested_details',
        'administrative_case',
        'administrative_case_details',
        'pd1081_arrested',
        'pd1081_arrested_details',
        'intoxicating_liquor_narcotics',
        'intoxicating_liquor_narcotics_details'
    ];

    protected $casts = [
        'date_of_arrest' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 