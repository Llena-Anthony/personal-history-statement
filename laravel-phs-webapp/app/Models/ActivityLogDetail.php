<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class ActivityLogDetail extends Model
{
    use HasFactory, Searchable;

    protected $primaryKey = 'act_id';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'changes_made_by',
        'action',
        'act_desc',
        'act_stat',
        'ip_addr',
        'user_agent',
        'created_at',
        'updated_at',
        'old_value',
        'new_value',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'changes_made_by','username');
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
            'act_desc' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Description'
            ],
            'act_stat' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Status'
            ],
            'ip_addr' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'IP Address'
            ],
            'user_agent' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'User Agent'
            ],
            'user.username' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Username'
            ],
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
        return 'act_stat';
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

        return $query->where('act_stat', $status);
    }

    public function getStatusColorAttribute()
    {
        return match($this->act_stat) {
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
        if (str_contains($this->act_desc, 'Profile updated:') || str_contains($this->act_desc, 'Admin profile updated:')) {
            if (str_contains($this->act_desc, 'Password changed')) {
                return "Updated profile password";
            }
            if (str_contains($this->act_desc, 'Profile picture updated')) {
                return "Updated profile picture";
            }
            if (str_contains($this->act_desc, 'Email updated')) {
                return "Updated profile email";
            }
            if (str_contains($this->act_desc, 'Username updated')) {
                return "Updated profile username";
            }
            // For multiple changes
            return "Updated profile information";
        }

        // Handle profile picture updates
        if (str_contains($this->act_desc, 'Profile picture updated')) {
            return "Updated profile picture";
        }

        // Extract model name from description for CRUD operations
        if (preg_match('/(Created|Updated|Deleted)\s+(.+?)(?:\s*:|$)/', $this->act_desc, $matches)) {
            $modelName = trim($matches[2]);
            return "{$action} {$modelName}";
        }

        // Handle user management activities
        if (str_contains($this->act_desc, 'user')) {
            if (str_contains($this->act_desc, 'Created new user')) {
                return "Created new user account";
            }
            if (str_contains($this->act_desc, 'Deleted user')) {
                return "Deleted user account";
            }
            if (str_contains($this->act_desc, 'Updated user:')) {
                return "Updated user account";
            }
        }

        // Handle PHS activities
        if (str_contains($this->act_desc, 'PHS')) {
            if (str_contains($this->act_desc, 'Submitted PHS form')) {
                return "Submitted PHS form";
            }
            if (str_contains($this->act_desc, 'Updated PHS submission')) {
                return "Updated PHS submission";
            }
            if (str_contains($this->act_desc, 'Deleted PHS submission')) {
                return "Deleted PHS submission";
            }
        }

        // Handle PDS activities
        if (str_contains($this->act_desc, 'PDS')) {
            if (str_contains($this->act_desc, 'Submitted PDS form')) {
                return "Submitted PDS form";
            }
            if (str_contains($this->act_desc, 'Updated PDS submission')) {
                return "Updated PDS submission";
            }
            if (str_contains($this->act_desc, 'Deleted PDS submission')) {
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

        // Handle admin PHS access/return actions
        if ($this->action === 'access_own_phs') {
            return 'Accessed own PHS';
        }
        if ($this->action === 'return_to_admin') {
            return 'Returned to admin view';
        }

        // For other actions, return a more descriptive version
        return $action . " action performed";
    }
}
