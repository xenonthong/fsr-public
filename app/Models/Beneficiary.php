<?php

namespace App\Models;

class Beneficiary extends Model
{
    protected $with = ['bank'];

    protected $guarded = [];

    /**
     * Creator of beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }


    /**
     * Transactions created for the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class)->withDefault();
    }

    /**
     * @param $query
     * @param $ownerId
     *
     * @return mixed
     */
    public function scopeBy($query, $ownerId)
    {
        return $query->where('user_id', $ownerId);
    }
}
