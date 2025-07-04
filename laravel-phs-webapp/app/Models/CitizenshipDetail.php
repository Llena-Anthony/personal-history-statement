<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class CitizenshipDetail extends Model
{
    public $timestamps = false;
    
    protected $primaryKey = 'cit_id';
    public $incrementing = true;
    public $keyType = 'int';
    public $fillable = [
        'cit_description'
    ];
}
