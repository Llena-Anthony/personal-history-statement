<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username',
        'health_state',
        'illness',
        'blood_type',
        'cap_size',
        'shoe_size',
        'hobbies',
        'undergo_lie_detection',
        'nickname',
        'change_in_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
