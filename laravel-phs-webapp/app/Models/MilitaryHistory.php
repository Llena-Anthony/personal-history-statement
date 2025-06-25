<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryHistory extends Model
{
    use HasFactory;

    protected $table = 'military_history';
    protected $primaryKey = 'username';

    protected $fillable = [
        'username',
        'date_enlisted_afp',
        'enlistment_date_type',
        'enlistment_month',
        'enlistment_year',
        'start_date_of_commision',
        'commission_date_from_type',
        'commission_date_from_month',
        'commission_date_from_year',
        'end_date_of_commision',
        'commission_date_to_type',
        'commission_date_to_month',
        'commission_date_to_year',
        'source_of_commision',
        'military_assign',
    ];

    protected $casts = [
        'date_enlisted_afp' => 'date',
        'start_date_of_commision' => 'date',
        'end_date_of_commision' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function militaryAssignments()
    {
        return $this->hasMany(MilitaryAssignment::class, 'assign_id', 'military_assign');
    }
}
