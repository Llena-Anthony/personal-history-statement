<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class CreditReferenceDetail extends Model
{
    protected $primaryKey = 'account_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $table = 'credit_reference_detail';
    public $fillable = [
        'bank',
        'username'
    ];
    public function bankDetail()
    {
        return $this->belongsTo(BankDetail::class,'bank','bank_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'username','usename');
    }
}

