<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiblingDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'sib_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'sib_detail',
        'username',
    ];

    public function familyDetail()
    {
        return $this->belongsTo(FamilyDetail::class, 'sib_detail', 'fam_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 