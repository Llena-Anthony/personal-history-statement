<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username',
        'full_name',
        'profile_path',
        'home_addr',
        'birth_date',
        'birth_place',
        'nationality',
        'religion',
        'mobile_num',
        'email_addr',
    ];

    public function nameDetail()
    {
        return $this->belongsTo(NameDetail::class, 'full_name', 'name_id');
    }
    public function homeAddress()
    {
        return $this->belongsTo(AddressDetail::class, 'home_addr', 'addr_id');
    }
    public function birthPlace()
    {
        return $this->belongsTo(AddressDetail::class, 'birth_place', 'addr_id');
    }
    public function citizenshipDetail()
    {
        return $this->belongsTo(CitizenshipDetail::class, 'nationality', 'cit_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 