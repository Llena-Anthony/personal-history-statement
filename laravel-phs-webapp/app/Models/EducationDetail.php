<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class EducationDetail extends Model
{
    protected $primaryKey = 'educ_id';
    public $incrementing = true;
    public $keyType = true;
    public $fillable = [
        'school',
        'educ_level',
        'attend_date',
        'year_grad',
        'other_training',
        'civil_service',
        'username'
    ];
    public function schoolDetail()
    {
        return $this->belongsTo(SchoolDetail::class,'school','school_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
