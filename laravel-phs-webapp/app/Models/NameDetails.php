<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'name_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'nickname',
        'name_extension',
    ];

    public function userDetails() {
        return $this->hasOne(UserDetails::class, 'name', 'name_id');
    }

    // New relationships for refactored tables
    public function familyBackgroundsAsSpouse() {
        return $this->hasMany(FamilyBackground::class, 'spouse_name_id');
    }

    public function familyBackgroundsAsFather() {
        return $this->hasMany(FamilyBackground::class, 'father_name_id');
    }

    public function familyBackgroundsAsMother() {
        return $this->hasMany(FamilyBackground::class, 'mother_name_id');
    }

    public function familyBackgroundsAsStepParentGuardian() {
        return $this->hasMany(FamilyBackground::class, 'step_parent_guardian_name_id');
    }

    public function familyBackgroundsAsFatherInLaw() {
        return $this->hasMany(FamilyBackground::class, 'father_in_law_name_id');
    }

    public function familyBackgroundsAsMotherInLaw() {
        return $this->hasMany(FamilyBackground::class, 'mother_in_law_name_id');
    }

    public function maritalStatuses() {
        return $this->hasMany(MaritalStatus::class, 'spouse_name_id');
    }

    public function siblings() {
        return $this->hasMany(Sibling::class, 'name_id');
    }

    public function characterReferences() {
        return $this->hasMany(CharacterReference::class, 'ref_name_id');
    }

    public function phs() {
        return $this->hasMany(PHS::class, 'name_id');
    }

    public function children() {
        return $this->hasMany(Child::class, 'name_id');
    }

    public function familyHistories() {
        return $this->hasMany(FamilyHistory::class, 'name');
    }

    // Helper method to get full name
    public function getFullNameAttribute() {
        $name = $this->first_name;
        if ($this->middle_name) {
            $name .= ' ' . $this->middle_name;
        }
        $name .= ' ' . $this->last_name;
        if ($this->name_extension) {
            $name .= ' ' . $this->name_extension;
        }
        return $name;
    }
}
