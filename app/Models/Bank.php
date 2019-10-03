<?php

namespace App\Models;

class Bank extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
