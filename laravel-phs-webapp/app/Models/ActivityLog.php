<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

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

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('action', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                  ->orWhereHas('user', function ($userQuery) use ($filters) {
                      $userQuery->where('name', 'like', '%' . $filters['search'] . '%')
                               ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                               ->orWhere('username', 'like', '%' . $filters['search'] . '%');
                  });
            });
        }

        if (isset($filters['action']) && $filters['action']) {
            $query->where('action', $filters['action']);
        }

        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['user_id']) && $filters['user_id']) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['date_from']) && $filters['date_from']) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && $filters['date_to']) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query;
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