<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username',
        'org',
        'mem_date',
        'position',
    ];
    protected $casts = [
        'mem_date'=> 'date'
        ];
    public function organizationDetail()
    {
        return $this->belongsTo(OrganizationDetail::class, 'org', 'org_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
