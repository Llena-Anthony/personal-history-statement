<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ref_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'ref_name',
        'ref_addr',
        'ref_type',
        'username',
    ];

    public function nameDetail()
    {
        return $this->belongsTo(NameDetail::class, 'ref_name', 'name_id');
    }
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class, 'ref_addr', 'addr_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
