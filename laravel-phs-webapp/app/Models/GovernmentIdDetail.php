<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class GovernmentIdDetail extends Model
{
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $fillable = [
        'username',
        'tin_num',
        'pass_num',
        'pass_exp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
