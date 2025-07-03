<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class EmploymentDetail extends Model
{
    protected $primaryKey = 'employ_id';
    public $incrementing = true;
    public $keyType = 'int';
    public $fillable = [
        'start_date',
        'end_date',
        'employ_type',
        'employer',
        'employ_addr',
        'reason_for_leaving',
        'dismissal_desc',
        'username'
    ];
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class,'employ_addr','addr_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
