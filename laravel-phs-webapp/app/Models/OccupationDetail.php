<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'occupation_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'occupation_desc',
        'employer',
        'occupation_addr',
    ];

    public function familyDetails()
    {
        return $this->hasMany(FamilyDetail::class, 'occupation', 'occupation_id');
    }
    public function spouseDetails()
    {
        return $this->hasMany(SpouseDetail::class, 'occupation', 'occupation_id');
    }
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class, 'occupation_addr', 'addr_id');
    }
} 