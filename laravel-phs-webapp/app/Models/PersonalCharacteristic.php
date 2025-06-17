<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalCharacteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sex',
        'age',
        'height',
        'weight',
        'body_build',
        'complexion',
        'blood_type',
        'hair_color',
        'distinguishing_features',
        'health_status',
        'recent_illness',
        'shoe_size',
        'cap_size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 