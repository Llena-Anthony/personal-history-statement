<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $table = 'organization';
    protected $primaryKey = 'org_id';
    public $timestamps = true;

    protected $fillable = [
        'org_name',
        'org_type',
        'org_address'
    ];

    public function address()
    {
        return $this->belongsTo(AddressDetails::class, 'org_address', 'addr_id');
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(MembershipDetails::class, 'org_id', 'org_id');
    }
} 