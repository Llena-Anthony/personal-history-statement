<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'address_id',
    ];

    public function addressDetails()
    {
        return $this->belongsTo(AddressDetails::class, 'address_id');
    }
}
