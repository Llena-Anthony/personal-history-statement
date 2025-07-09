<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryHistoryDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username',
        'enlist_date',
        'start_comm',
        'end_comm',
        'comm_src',
    ];
    protected $casts = [
        'enlist_date'=> 'date',
        'start_comm'=> 'date',
        'end_comm'=> 'date',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
