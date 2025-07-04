<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'org_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'org_name',
        'org_addr',
    ];

    public function membershipDetails()
    {
        return $this->hasMany(MembershipDetail::class, 'org', 'org_id');
    }
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class, 'org_addr', 'addr_id');
    }
} 