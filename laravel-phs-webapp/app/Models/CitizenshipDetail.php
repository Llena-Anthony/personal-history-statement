<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class CitizenshipDetail extends Model
{
    protected $primaryKey = 'cit_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $table = 'citizenship_detail';
    public $fillable = [
        'cit_description'
    ];
}
