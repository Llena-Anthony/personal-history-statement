<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    protected $table = 'history_logs';
    protected $primaryKey = 'log_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'action',
        'table_affected',
        'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
} 