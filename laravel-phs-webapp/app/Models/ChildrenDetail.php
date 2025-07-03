<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Searchable;

class ChildrenDetail extends Model
{
    protected $primaryKey = 'child_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $table = 'children_detail';
    public $fillable = [
        'child_name',
        'birth_date',
        'citizenship',
        'addr',
        'other_parent',
        'username'
    ];
    public function childName()
    {
        return $this->belongsTo(NameDetail::class,'child_name', 'name_id');
    }
    public function citizenshipDetail()
    {
        return $this->belongsTo(CitizenshipDetail::class,'citizenship','cit_id');
    }
    public function addressDetail()
    {
        return $this->belongsTo(AddressDetail::class,'addr','addr_id');
    }
    public function parentName()
    {
        return $this->belongsTo(NameDetail::class,'other_parent','name_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
}
