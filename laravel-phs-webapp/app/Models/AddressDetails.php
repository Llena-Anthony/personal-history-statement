<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'addr_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'street',
        'barangay',
        'municipality',
        'province',
        'city',
        'country',
        'zip_code',
    ];

    public function userDetails() {
        return $this->hasMany(UserDetails::class, 'home_addr', 'addr_id');
    }
}
