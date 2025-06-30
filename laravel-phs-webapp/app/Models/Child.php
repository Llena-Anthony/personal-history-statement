<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'marital_status_id',
        'name_id',
        'birth_date',
        'citizenship_address',
        'parent_name',
        'citizenship',
        'address',
        'father_name',
        'mother_name',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function name()
    {
        return $this->belongsTo(NameDetails::class, 'name_id');
    }

    public function nameDetails()
    {
        return $this->belongsTo(NameDetails::class, 'name_id');
    }
} 