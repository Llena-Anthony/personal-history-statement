<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class BankDetail extends Model
{
    protected $primaryKey = 'bank_id';
    public $incrementing = true;
    public $keyType = 'int';
    public $fillable = [
        'bank',
        'bank_addr'
    ];
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class,'bank-addr', 'addr_id');
    }
}
