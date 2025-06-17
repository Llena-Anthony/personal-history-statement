<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'birth_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'b_date',
        'b_month',
        'b_year',
        'b_place',
    ];

    public function userDetails() {
        return $this->hasMany(UserDetails::class, 'birth', 'birth_id');
    }
    public function addressDetails() {
        return $this->belongsTo(AddressDetails::class, 'b_place', 'addr_id');
    }
}
