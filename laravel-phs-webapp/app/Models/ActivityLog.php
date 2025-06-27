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

    /**
     * Get a brief summary of the activity for table display
     */
    public function getSummaryAttribute()
    {
        $action = ucfirst(str_replace('_', ' ', $this->action));
        
        // Handle profile updates with detailed information
        if (str_contains($this->description, 'Profile updated:') || str_contains($this->description, 'Admin profile updated:')) {
            if (str_contains($this->description, 'Password changed')) {
                return "Updated profile password";
            }
            if (str_contains($this->description, 'Profile picture updated')) {
                return "Updated profile picture";
            }
            if (str_contains($this->description, 'Email updated')) {
                return "Updated profile email";
            }
            if (str_contains($this->description, 'Username updated')) {
                return "Updated profile username";
            }
            // For multiple changes
            return "Updated profile information";
        }
        
        // Handle profile picture updates
        if (str_contains($this->description, 'Profile picture updated')) {
            return "Updated profile picture";
        }
        
        // Extract model name from description for CRUD operations
        if (preg_match('/(Created|Updated|Deleted)\s+(.+?)(?:\s*:|$)/', $this->description, $matches)) {
            $modelName = trim($matches[2]);
            return "{$action} {$modelName}";
        }
        
        // Handle user management activities
        if (str_contains($this->description, 'user')) {
            if (str_contains($this->description, 'Created new user')) {
                return "Created new user account";
            }
            if (str_contains($this->description, 'Deleted user')) {
                return "Deleted user account";
            }
            if (str_contains($this->description, 'Updated user:')) {
                return "Updated user account";
            }
        }
        
        // Handle PHS activities
        if (str_contains($this->description, 'PHS')) {
            if (str_contains($this->description, 'Submitted PHS form')) {
                return "Submitted PHS form";
            }
            if (str_contains($this->description, 'Updated PHS submission')) {
                return "Updated PHS submission";
            }
            if (str_contains($this->description, 'Deleted PHS submission')) {
                return "Deleted PHS submission";
            }
        }
        
        // Handle PDS activities
        if (str_contains($this->description, 'PDS')) {
            if (str_contains($this->description, 'Submitted PDS form')) {
                return "Submitted PDS form";
            }
            if (str_contains($this->description, 'Updated PDS submission')) {
                return "Updated PDS submission";
            }
            if (str_contains($this->description, 'Deleted PDS submission')) {
                return "Deleted PDS submission";
            }
        }
        
        // For login/logout actions
        if (in_array($this->action, ['login', 'logout'])) {
            return ucfirst($this->action) . " from system";
        }
        
        // For password reset
        if ($this->action === 'password_reset') {
            return "Reset password";
        }
        
        // For enable/disable actions
        if (in_array($this->action, ['enable', 'disable'])) {
            return ucfirst($this->action) . "d user account";
        }
        
        // For submit actions
        if ($this->action === 'submit') {
            return "Submitted form";
        }
        
        // For other actions, return a more descriptive version
        return $action . " action performed";
    }
} 