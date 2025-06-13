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
        'case_details'
    ];

    protected $casts = [
        'date_of_arrest' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 