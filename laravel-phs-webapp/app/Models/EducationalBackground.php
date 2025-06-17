<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level',
        'school_name',
        'location',
        'date_of_attendance',
        'year_graduated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 