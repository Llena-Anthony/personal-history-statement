<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class DescriptionDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = [
        'username',
        'sex',
        'age',
        'height',
        'weight',
        'body-build',
        'complexion',
        'eye_color',
        'hair_color',
        'other_marks'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
