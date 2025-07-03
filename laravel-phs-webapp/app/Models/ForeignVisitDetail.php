<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignVisitDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'visit_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'visit_date',
        'visit_purpose',
        'visit_addr',
        'username',
    ];

    protected $table = 'foreign_visit_detail';

    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class, 'visit_addr', 'addr_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 