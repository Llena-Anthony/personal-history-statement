<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditReport extends Model
{
    protected $table = 'credit_report';
    protected $primaryKey = 'credit_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'institution',
        'account_type',
        'account_number',
        'account_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function institution()
    {
        return $this->belongsTo(CreditInstitution::class, 'institution', 'inst_id');
    }
} 