<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'name',
        'profile_pic',
        'home_addr',
        'birth',
        'nationality',
        'tin',
        'religion',
        'mobile_num',
        'email_addr',
        'passport_num',
        'passport_exp',
        'change_in_name',
    ];

    public function nameDetails() {
        return $this->belongsTo(NameDetails::class, 'name', 'name_id');
    }
    public function addressDetails() {
        return $this->belongsTo(AddressDetails::class, 'home_addr', 'addr_id');
    }
    public function birthDetails() {
        return $this->belongsTo(BirthDetails::class, 'birth', 'birth_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
