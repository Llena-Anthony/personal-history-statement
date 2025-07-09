<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitarySchoolDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'mil_school_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'school',
        'attend_date',
        'train_nature',
        'rating',
        'username',
    ];
    protected $casts = [
        'attend_date'=> 'date'
        ];
    public function schoolDetail()
    {
        return $this->belongsTo(SchoolDetail::class, 'school', 'school_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
