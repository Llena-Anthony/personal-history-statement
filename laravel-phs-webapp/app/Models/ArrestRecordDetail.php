<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class ArrestRecordDetail extends Model
{
    public $timestamps = false;
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
        return $this->belongsTo(ArrestDetail::class, 'arr_desc', 'arrest_detail_id');
    }

    public function famArrDesc()
    {
        return $this->belongsTo(ArrestDetail::class, 'fam_arr_desc', 'arrest_detail_id');
    }

    public function violationDesc()
    {
        return $this->belongsTo(ArrestDetail::class, 'violation_desc', 'arrest_detail_id');
    }
}
