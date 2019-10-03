<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;

class Point extends Model
{
    use LogsActivity;

    protected $guarded = [];

    protected $dates = [
        'expires_at'
    ];

    protected static $logAttributes = [
        'awarded',
        'used',
        'expires_at',
    ];

    /**
     * The point owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get remainder points attribute.
     *
     * @return int
     */
    public function getRemainderAttribute()
    {
        return (int) $this->awarded - (int) $this->used;
    }

    /**
     * Set points to be fully used.
     *
     * @return void
     */
    public function fullyUsed() {
        $this->used = $this->awarded;

        $this->save();
    }

    /**
     * Scope a query to only get points that has not expired.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeNotExpired($query)
    {
        return $query->where('expires_at', '>', Carbon::now());
    }

    /**
     * Scope a query to only get points that has not been fully utilised.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeNotFullyUsed($query)
    {
        return $query->whereRaw('awarded > used');
    }

    /**
     * Scope a query to only get points that has not expired.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeValid($query)
    {
        return $query->notExpired()->notFullyUsed();
    }
}
