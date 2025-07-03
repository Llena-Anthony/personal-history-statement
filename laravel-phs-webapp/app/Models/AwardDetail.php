<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class AwardDetail extends Model
{
    protected $primaryKey = 'award_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $table = 'award_detail';
    protected $fillable = [
        'award_desc',
        'username',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
