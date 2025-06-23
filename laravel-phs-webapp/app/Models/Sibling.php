<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_background_id',
        'full_name',
        'occupation',
        'address',
        'contact',
    ];

    public function familyBackground()
    {
        return $this->belongsTo(FamilyBackground::class);
    }
} 