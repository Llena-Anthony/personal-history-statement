<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CreditInstitution extends Model
{
    protected $table = 'credit_institution';
    protected $primaryKey = 'inst_id';
    public $timestamps = true;

    protected $fillable = [
        'inst_name',
        'inst_addr'
    ];

    public function address()
    {
        return $this->belongsTo(AddressDetails::class, 'inst_addr', 'addr_id');
    }

    public function creditReports(): HasMany
    {
        return $this->hasMany(CreditReport::class, 'institution', 'inst_id');
    }
} 