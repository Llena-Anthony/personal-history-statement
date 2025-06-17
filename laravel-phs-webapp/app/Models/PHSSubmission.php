<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PHSSubmission extends Model
{
    protected $table = 'phs_submissions';
    
    protected $fillable = [
        'user_id',
        'status',
        'admin_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class, 'username', 'user_id');
    }

    public function familyHistory()
    {
        return $this->hasMany(FamilyHistory::class, 'username', 'user_id');
    }

    public function educationalBackground()
    {
        return $this->hasOne(EducationalBackground::class, 'username', 'user_id');
    }

    public function employmentHistory()
    {
        return $this->hasMany(EmploymentHistory::class, 'username', 'user_id');
    }

    public function militaryHistory()
    {
        return $this->hasOne(MilitaryHistory::class, 'username', 'user_id');
    }
} 