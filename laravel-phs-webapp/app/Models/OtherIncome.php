<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
