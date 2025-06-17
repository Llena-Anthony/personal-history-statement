<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'marital_status_id',
        'name',
        'birth_date',
        'citizenship_address',
        'parent_name',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }
} 