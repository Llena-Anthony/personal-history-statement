<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'name_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'nickname',
        'name_extension',
    ];

    public function userDetails() {
        return $this->hasOne(UserDetails::class, 'name', 'name_id');
    }
}
