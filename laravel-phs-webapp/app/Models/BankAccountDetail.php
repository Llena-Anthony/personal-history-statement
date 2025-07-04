<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class BankAccountDetail extends Model
{
    protected $primaryKey = 'account_id';
    public $incrementing = true;
    public $keyType = 'int';
    public $fillable = [
        'bank',
        'username'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
    public function bankDetail()
    {
        return $this->belongsTo(BankDetail::class, 'bank', 'bank_id');
    }
}
