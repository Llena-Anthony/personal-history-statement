<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username',
        'marital_stat',
        'spouse',
    ];

    public function spouseDetail()
    {
        return $this->belongsTo(SpouseDetail::class, 'spouse', 'spouse_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 