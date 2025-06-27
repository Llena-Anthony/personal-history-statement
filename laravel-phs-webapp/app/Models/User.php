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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'usertype',
        'organic_role',
        'branch',
        'created_by',
        'is_active',
        'is_admin',
        'last_login_at',
        'profile_picture'
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
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get searchable fields for User model
     */
    public function getSearchableFields()
    {
        return [
            'name' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Full Name'
            ],
            'username' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Username'
            ],
            'email' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Email Address'
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
            'branch' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Branch'
            ],
            'created_by' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Created By'
            ]
        ];
    }

    /**
     * Get the status field name for User model
     */
    protected function getStatusField()
    {
        return 'is_active';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Get the user's profile photo URL.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        
        return asset('images/default-avatar.svg');
    }

    /**
     * Get the user's profile picture URL with fallback
     *
     * @return string
     */
    public function getProfilePictureUrlAttribute()
    {
        return $this->getProfilePhotoUrlAttribute();
    }

    /**
     * Get the user's last login time safely.
     *
     * @return string
     */
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function creditReputation()
    {
        return $this->hasOne(CreditReputation::class);
    }

    /**
     * Get the user's personal characteristics.
     */
    public function personalChar()
    {
        return $this->hasOne(PersonalCharacteristic::class);
    }

    /**
     * Get the user's personal details.
     */
    public function userDetails()
    {
        return $this->hasOne(UserDetails::class, 'username', 'username');
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        // Delete profile picture when user is deleted
        static::deleting(function ($user) {
            if ($user->profile_picture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
            }
        });
    }
}
