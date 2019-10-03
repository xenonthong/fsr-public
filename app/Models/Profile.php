<?php

namespace App\Models;

use Carbon\Carbon;

class Profile extends Model
{
    protected $dates = [
        'dob'
    ];

    protected $with = [
        'address',
    ];

    protected $guarded = [];

    /**
     * The profile address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable')->withDefault();
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $value);
    }

    /**
     * Profile owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
