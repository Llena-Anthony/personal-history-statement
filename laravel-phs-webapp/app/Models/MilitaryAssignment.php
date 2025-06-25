<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryAssignment extends Model
{
    use HasFactory;

    protected $table = 'military_assignments';
    protected $primaryKey = 'assign_id';

    protected $fillable = [
        'assign_id',
        'date_from',
        'date_to',
        'date_from_type',
        'date_from_month',
        'date_from_year',
        'date_to_type',
        'date_to_month',
        'date_to_year',
        'inclusive_dates',
        'unit_office',
        'co_or_chief_of_office',
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
    ];

    public function militaryHistory()
    {
        return $this->belongsTo(MilitaryHistory::class, 'assign_id', 'military_assign');
    }
}
