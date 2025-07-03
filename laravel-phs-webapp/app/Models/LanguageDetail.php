<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class LanguageDetail extends Model
{
    protected $primaryKey = 'lang_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'lang_desc',
    ];
}
