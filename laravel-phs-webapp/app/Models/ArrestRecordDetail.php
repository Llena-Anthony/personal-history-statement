<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class ArrestRecordDetail extends Model
{
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $fillable = [
        'username',
        'arr_desc',
        'fam_arr_desc',
        'admin_case_desc',
        'violation_desc',
        'extent_of_intoxication'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }

    public function arrDesc()
    {
        return $this->belongsTo(ArrestDetail::class);
    }

    public function famArrDesc()
    {
        return $this->belongsTo(ArrestDetail::class);
    }

    public function violationDesc()
    {
        return $this->belongsTo(ArrestDetail::class);
    }
}
