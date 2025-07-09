<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class FamilyDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'fam_id';
    public $incrementing = true;
    public $keyType = 'int';
    public $fillable = [
        'fam_name',
        'birth_date',
        'birth_place',
        'fam_addr',
        'occupation',
        'citizenship',
        'dual',
        'date_naturalized',
        'place_naturalized'
    ];
    protected $casts = [
        'birth_date'=> 'date'
        ];
    public function familyName()
    {
        return $this->belongsTo(NameDetail::class,'fam_name','name_id');
    }
    public function birthPlace()
    {
        return $this->belongsTo(AddressDetail::class,'birth_place','addr_id');
    }
    public function familyAddr()
    {
        return $this->belongsTo(AddressDetail::class,'fam_addr','addr_id');
    }
    public function occupationDetail()
    {
        return $this->belongsTo(OccupationDetail::class,'occupation','occupation_id');
    }
    public function citizenshipDetail()
    {
        return $this->belongsTo(CitizenshipDetail::class,'citizenship','cit_id');
    }
    public function dualCitizenship()
    {
        return $this->belongsTo(CitizenshipDetail::class,'dual','cit_id');
    }
    public function placeNaturalized()
    {
        return $this->belongsTo(AddressDetail::class,'place_naturalized','addr_id');
    }
}
