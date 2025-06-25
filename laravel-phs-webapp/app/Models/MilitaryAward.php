<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryAward extends Model
{
    use HasFactory;

    protected $table = 'military_awards';
    protected $primaryKey = 'history_id';

    protected $fillable = [
        'history_id',
        'decoration_award_or_commendation',
    ];

    public function militarySchool()
    {
        return $this->belongsTo(MilitarySchool::class, 'history_id', 'history_id');
    }
}
