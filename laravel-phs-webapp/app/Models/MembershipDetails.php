<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipDetails extends Model
{
    protected $table = 'membership_details';
    protected $primaryKey = 'membership_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'org_id',
        'membership_type',
        'date_joined',
        'date_ended',
        'position_held'
    ];

    protected $casts = [
        'date_joined' => 'date',
        'date_ended' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'org_id', 'org_id');
    }
} 