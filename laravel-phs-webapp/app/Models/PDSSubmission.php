<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class PDSSubmission extends Model
{
    use HasFactory, Searchable;

    protected $table = 'pds_submissions';

    protected $fillable = [
        'user_id',
        'status',
        'admin_notes',
    ];

    /**
     * Get searchable fields for PDSSubmission model
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
} 