<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'bank_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username');
    }

    public function bankDetails()
    {
        return $this->(BankDetails::class, 'bank_id');
    }

}
