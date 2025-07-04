<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'school_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'school_name',
        'school_addr',
    ];

    public function educationDetails()
    {
        return $this->hasMany(EducationDetail::class, 'school', 'school_id');
    }
    public function militarySchoolDetails()
    {
        return $this->hasMany(MilitarySchoolDetail::class, 'school', 'school_id');
    }
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class, 'school_addr', 'addr_id');
    }
} 