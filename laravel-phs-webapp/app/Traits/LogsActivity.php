<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::updated(function ($model) {
            $model->logChanges();
        });

        static::created(function ($model) {
            $model->logCreation();
        });

        static::deleted(function ($model) {
            $model->logDeletion();
        });
    }

    protected function logChanges()
    {
        if (!Auth::check()) {
            return;
        }

        // Skip automatic logging for User model as it's handled manually in AdminUserController
        if ($this instanceof \App\Models\User) {
            return;
        }

        $changes = $this->getChanges();
        $original = $this->getOriginal();
        
        // Remove timestamps from changes
        unset($changes['updated_at']);
        
        if (empty($changes)) {
            return;
        }

        $changeDescriptions = [];
        
        foreach ($changes as $field => $newValue) {
            $oldValue = $original[$field] ?? null;
            
            // Skip if values are the same
            if ($oldValue == $newValue) {
                continue;
            }

            $fieldLabel = $this->getFieldLabel($field);
            $changeDescriptions[] = $this->formatChange($fieldLabel, $oldValue, $newValue);
        }

        if (!empty($changeDescriptions)) {
            $description = 'Updated ' . $this->getModelName() . ': ' . implode(' | ', $changeDescriptions);
            
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'update',
                'description' => $description,
                'status' => 'success',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        }
    }

    protected function logCreation()
    {
        if (!Auth::check()) {
            return;
        }

        // Skip automatic logging for User model as it's handled manually in AdminUserController
        if ($this instanceof \App\Models\User) {
            return;
        }

        $description = 'Created new ' . $this->getModelName();
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => $description,
            'status' => 'success',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    protected function logDeletion()
    {
        if (!Auth::check()) {
            return;
        }

        // Skip automatic logging for User model as it's handled manually in AdminUserController
        if ($this instanceof \App\Models\User) {
            return;
        }

        $description = 'Deleted ' . $this->getModelName();
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => $description,
            'status' => 'success',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    protected function getFieldLabel($field)
    {
        $labels = [
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'usertype' => 'User Type',
            'organic_role' => 'Organic Group',
            'branch' => 'Branch',
            'is_active' => 'Status',
            'is_admin' => 'Admin Status',
            'password' => 'Password',
            'last_login_at' => 'Last Login',
            'profile_picture' => 'Profile Picture',
            'created_by' => 'Created By',
            'phs_stat' => 'PHS Status',
            'email_verified_at' => 'Email Verification',
            'remember_token' => 'Remember Token',
            // Add more field labels as needed
        ];

        return $labels[$field] ?? ucfirst(str_replace('_', ' ', $field));
    }

    protected function formatChange($fieldLabel, $oldValue, $newValue)
    {
        // Handle boolean values
        if (is_bool($oldValue) || is_bool($newValue)) {
            $oldValue = $oldValue ? 'Yes' : 'No';
            $newValue = $newValue ? 'Yes' : 'No';
        }

        // Handle null values
        $oldValue = $oldValue ?? 'None';
        $newValue = $newValue ?? 'None';

        // Handle specific field formatting
        if ($fieldLabel === 'Status') {
            $oldValue = $oldValue ? 'Active' : 'Inactive';
            $newValue = $newValue ? 'Active' : 'Inactive';
        }

        if ($fieldLabel === 'User Type') {
            $oldValue = ucfirst($oldValue);
            $newValue = ucfirst($newValue);
        }

        if ($fieldLabel === 'Organic Group') {
            $oldValue = ucfirst($oldValue);
            $newValue = ucfirst($newValue);
        }

        if ($fieldLabel === 'Admin Status') {
            $oldValue = $oldValue ? 'Admin' : 'Regular User';
            $newValue = $newValue ? 'Admin' : 'Regular User';
        }

        if ($fieldLabel === 'PHS Status') {
            $oldValue = ucfirst($oldValue);
            $newValue = ucfirst($newValue);
        }

        // Handle date fields
        if (in_array($fieldLabel, ['Last Login', 'Email Verification'])) {
            $oldValue = $oldValue === 'None' ? 'Never' : $oldValue;
            $newValue = $newValue === 'None' ? 'Never' : $newValue;
        }

        // Hide sensitive information
        if (in_array($fieldLabel, ['Password', 'Remember Token'])) {
            return "{$fieldLabel} changed";
        }

        return "{$fieldLabel}: {$oldValue} → {$newValue}";
    }

    protected function getModelName()
    {
        $className = class_basename($this);
        
        $modelNames = [
            'User' => 'user',
            'ActivityLog' => 'activity log',
            'PHS' => 'PHS submission',
            'PDSSubmission' => 'PDS submission',
            // Add more model names as needed
        ];

        return $modelNames[$className] ?? strtolower($className);
    }
} 