<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterReference extends Model
{
    protected $table = 'character_references';
    protected $primaryKey = 'ref_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'ref_name_id',
        'ref_occupation',
        'ref_employer',
        'ref_address',
        'ref_contact',
        'ref_relationship'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function address()
    {
        return $this->belongsTo(AddressDetails::class, 'ref_address', 'addr_id');
    }

    public function refName()
    {
        return $this->belongsTo(NameDetails::class, 'ref_name_id');
    }
} 