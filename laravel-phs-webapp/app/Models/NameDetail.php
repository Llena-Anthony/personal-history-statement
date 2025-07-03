<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'name_id';
    public $incrementing = true;
    public $keyType = 'int';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'name_extension',
        'nickname',
        'change_in_name',
    ];

    // Relationships
    public function childrenDetails()
    {
        return $this->hasMany(ChildrenDetail::class, 'child_name', 'name_id');
    }
    public function otherParentChildren()
    {
        return $this->hasMany(ChildrenDetail::class, 'other_parent', 'name_id');
    }
    public function familyDetails()
    {
        return $this->hasMany(FamilyDetail::class, 'fam_name', 'name_id');
    }
    public function spouseDetails()
    {
        return $this->hasMany(SpouseDetail::class, 'spouse_name', 'name_id');
    }
    public function referenceDetails()
    {
        return $this->hasMany(ReferenceDetail::class, 'ref_name', 'name_id');
    }
    public function userDetails()
    {
        return $this->hasMany(UserDetail::class, 'full_name', 'name_id');
    }
} 