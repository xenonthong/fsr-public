<?php

namespace App\Models;

class Currency extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rates'         => 'array',
        'fees'          => 'array',
        'payment_modes' => 'array',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'rates'         => '[]',
        'fees'          => '[]',
        'payment_modes' => '[]',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceFees()
    {
        return $this->hasMany(ServiceFee::class);
    }
}
