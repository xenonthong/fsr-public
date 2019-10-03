<?php

namespace App\Models;

class Address extends Model
{
    protected $guarded = [];

    /**
     * Get all of the owning addressable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }
}
