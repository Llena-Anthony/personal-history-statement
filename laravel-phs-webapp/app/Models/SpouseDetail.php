<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'spouse_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'spouse_name',
        'marr_date',
        'marr_place',
        'birth_date',
        'birth_place',
        'occupation',
        'mobile_num',
        'citizenship',
        'dual',
    ];

    public function nameDetail()
    {
        return $this->belongsTo(NameDetail::class, 'spouse_name', 'name_id');
    }
    public function marriagePlace()
    {
        return $this->belongsTo(AddressDetail::class, 'marr_place', 'addr_id');
    }
    public function birthPlace()
    {
        return $this->belongsTo(AddressDetail::class, 'birth_place', 'addr_id');
    }
    public function occupationDetail()
    {
        return $this->belongsTo(OccupationDetail::class, 'occupation', 'occupation_id');
    }
    public function citizenshipDetail()
    {
        return $this->belongsTo(CitizenshipDetail::class, 'citizenship', 'cit_id');
    }
    public function dualCitizenship()
    {
        return $this->belongsTo(CitizenshipDetail::class, 'dual', 'cit_id');
    }
}
