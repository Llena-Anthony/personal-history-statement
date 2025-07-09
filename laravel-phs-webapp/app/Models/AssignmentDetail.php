<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class AssignmentDetail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'assign_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'start_date',
        'end_date',
        'assign_unit',
        'assign_chief',
        'username',
    ];

    protected $casts = [
        'start_date'=> 'date',
        'end_date'=> 'date',
        ];

    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
