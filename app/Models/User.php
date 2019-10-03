<?php

namespace App\Models;

use App\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Enums\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'verification_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'points_available'];

    protected $with = ['profile'];

    /**
     * Profile address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * The user's beneficiaries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    /**
     * Get name attribute
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return mixed
     */
    public function getPointsAvailableAttribute()
    {
        return (int)$this->points()->valid()->sum('awarded') - (int)$this->points()->valid()->sum('used');
    }

    /**
     * Checks if user is a customer.
     *
     * @return bool
     */
    public function isCustomer()
    {
        return !$this->hasAnyRole([(string)Role::SUPER_ADMIN(), (string)Role::ADMIN()]);
    }

    /**
     * Checks if user is super admin
     */
    public function isSuperAdmin()
    {
        return $this->hasRole((string)Role::SUPER_ADMIN());
    }

    /**
     * THe user's points.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany(Point::class);
    }

    /**
     * The user's profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function referrer()
    {
        return $this->hasOne(User::class, 'id', 'referrer_id');
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->profile->contact_number;
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * The user's transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * The user's account verifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

}
