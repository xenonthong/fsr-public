<?php

namespace App\Models;

use App\Enums\VerificationStatus;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Verification extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = [];

    /**
     * Scopes a verification by failed status.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeFailed($query)
    {
        return $query->where('status', (string)VerificationStatus::FAILED());
    }

    /**
     * Scopes a verification by pending status.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('status', (string)VerificationStatus::PENDING());
    }

    /**
     * Scopes a verification by unverified status.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUnverified($query)
    {
        return $query->where('status', (string)VerificationStatus::UNVERIFIED());
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scopes a verification by verified status.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeVerified($query)
    {
        return $query->where('status', (string)VerificationStatus::VERIFIED());
    }

    /**
     * Owner of the verification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getUserEmailAttribute()
    {
        return $this->user->email;
    }

    public function getUserContactNumberAttribute()
    {
        return $this->user->profile->contact_number;
    }

    public function getUserNationalityAttribute()
    {
        return $this->user->profile->nationality;
    }

    public function getUserDateOfBirthAttribute()
    {
        return $this->user->profile->date_of_birth;
    }
}
