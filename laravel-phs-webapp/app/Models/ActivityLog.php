<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class ActivityLog extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'status',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get searchable fields for ActivityLog model
     */
    public function getSearchableFields()
    {
        return [
            'action' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Action'
            ],
            'description' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Description'
            ],
            'status' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Status'
            ],
            'ip_address' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'IP Address'
            ],
            'user_agent' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'User Agent'
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

    public function scopeFilter($query, $filters)
    {
        return $query->applyFilters($filters);
    }

    /**
     * Override the status field handling for ActivityLog
     * ActivityLog uses string statuses, not integer statuses
     */
    protected function getStatusField()
    {
        return 'status';
    }

    /**
     * Override the status filtering for ActivityLog
     * ActivityLog statuses are strings, not integers
     */
    public function scopeFilterByStatus($query, $status)
    {
        if ($status === null || $status === '' || $status === []) {
            return $query;
        }

        return $query->where('status', $status);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'success' => 'green',
            'warning' => 'yellow',
            'error' => 'red',
            default => 'gray'
        };
    }

    public function getActionIconAttribute()
    {
        return match($this->action) {
            'login' => 'fas fa-sign-in-alt',
            'logout' => 'fas fa-sign-out-alt',
            'create' => 'fas fa-plus',
            'update' => 'fas fa-edit',
            'delete' => 'fas fa-trash',
            'submit' => 'fas fa-paper-plane',
            'disable' => 'fas fa-ban',
            'enable' => 'fas fa-check',
            'password_reset' => 'fas fa-key',
            default => 'fas fa-info-circle'
        };
    }
} 