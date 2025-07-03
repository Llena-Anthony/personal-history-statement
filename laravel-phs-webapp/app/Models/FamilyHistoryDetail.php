<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class FamilyHistoryDetail extends Model
{
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = [
        'username',
        'father',
        'mother',
        'guardian',
        'father_in_law',
        'mother_in_law'
    ];
    public function fatherDetail()
    {
        return $this->belongsTo(FamilyDetail::class,'father','fam_id');
    }
    public function motherDetail()
    {
        return $this->belongsTo(FamilyDetail::class,'mother','fam_id');
    }
    public function guardianDetail()
    {
        return $this->belongsTo(FamilyDetail::class,'guardian','fam_id');
    }
    public function fatherInLAwDetail()
    {
        return $this->belongsTo(FamilyDetail::class,'father_in_law','fam_id');
    }
    public function motherInLawDetail()
    {
        return $this->belongsTo(FamilyDetail::class,'mother_in_law','fam_id');
    }
}
