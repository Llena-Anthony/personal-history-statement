<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model
{
    protected $table = 'miscellaneous';
    protected $primaryKey = 'misc_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'misc_type',
        'misc_details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 