<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class CreditDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = [
        'username',
        'other_income_src',
        'saln_detail',
        'saln_date_filed',
        'amount_paid'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
