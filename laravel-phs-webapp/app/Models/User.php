<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use App\Traits\Searchable;
use App\Traits\LogsActivity;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, LogsActivity;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey ='username';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'password',
        'usertype',
        'organic_role',
        'phs_status',
        'is_active',
        'last_login_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user's last login time safely.
     *
     * @return string
     */
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'username', 'username');
    }

    public function getLastLoginDisplayAttribute()
    {
        try {
            if ($this->last_login_at && $this->last_login_at instanceof \Carbon\Carbon) {
                return $this->last_login_at->diffForHumans();
            }
            return 'First Login';
        } catch (\Exception $e) {
            return 'First Login';
        }
    }

    /**
     * Get searchable fields for User model
     */
    public function getSearchableFields()
    {
        return [
            'username' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Username'
            ],
            'usertype' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'User Type'
            ],
            'organic_role' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Organic Role'
            ],
            'phs_status' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'PHS Status'
            ],
            'is_active' => [
                'type' => 'boolean',
                'searchable' => true,
                'label' => 'Status'
            ],
            'email_addr' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Email Address',
                'relationship' => 'userDetail'
            ],
        ];
    }

    /**
     * Override the status field handling for User model
     */
    protected function getStatusField()
    {
        return 'is_active';
    }

    /**
     * Override the status filtering for User model to handle boolean values
     */
    public function scopeFilterByStatus($query, $status)
    {
        if ($status === null || $status === '' || $status === []) {
            return $query;
        }

        // Convert string status to boolean
        $booleanStatus = null;
        if ($status === 'active' || $status === '1' || $status === 1 || $status === true) {
            $booleanStatus = true;
        } elseif ($status === 'disabled' || $status === '0' || $status === 0 || $status === false) {
            $booleanStatus = false;
        }

        if ($booleanStatus !== null) {
            return $query->where('is_active', $booleanStatus);
        }

        return $query;
    }

    /**
     * Override the date range filtering for User model since it doesn't have timestamps
     */
    public function scopeFilterByDateRange($query, $dateFrom = null, $dateTo = null)
    {
        // User model doesn't have timestamps, so we'll skip date filtering
        return $query;
    }
}
