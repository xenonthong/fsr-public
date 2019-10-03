<?php

namespace App\Models;

class Store extends Model
{
    protected $with = ['address'];

    /**
     * The store address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable')->withDefault();
    }
}
