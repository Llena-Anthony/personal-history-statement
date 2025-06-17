<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDSSubmission extends Model
{
    use HasFactory;

    protected $table = 'pds_submissions';

    protected $fillable = [
        'user_id',
        'status',
        'admin_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 