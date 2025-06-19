<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class PHSSubmission extends Model
{
    use HasFactory, Searchable;

    protected $table = 'phs_submissions';
    
    protected $fillable = [
        'user_id',
        'status',
        'admin_notes',
    ];

    /**
     * Get searchable fields for PHSSubmission model
     */
    public function getSearchableFields()
    {
        return [
            'status' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Status'
            ],
            'admin_notes' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Admin Notes'
            ],
            'user.name' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'User Name'
            ],
            'user.username' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Username'
            ],
            'user.email' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'User Email'
            ]
        ];
    }

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