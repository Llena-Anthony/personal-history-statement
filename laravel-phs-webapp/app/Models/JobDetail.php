<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username',
        'service_branch',
        'rank',
        'afpsn',
        'job_desc',
        'job_addr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
