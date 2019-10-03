<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Helpers\Formatter;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Transaction extends Model implements HasMedia
{
    use Filterable, HasMediaTrait;

    protected $guarded = [];

    protected $appends = [
        'transaction_date'
    ];

    /**
     * The beneficiary which this transaction was created for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class)->withDefault();
    }

    /**
     * @return bool
     */
    public function isApproved()
    {
        return $this->status === (string)TransactionStatus::approved();
    }

    /**
     * @return bool
     */
    public function isCredited()
    {
        return $this->status === (string)TransactionStatus::credited();
    }

    /**
     * @return bool
     */
    public function isProcessing()
    {
        return $this->status === (string)TransactionStatus::processing();
    }

    /**
     * Scope transactions by processing status
     */
    public function scopeProcessing($query)
    {
        $query->where('status', (string)TransactionStatus::processing());
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return $this->status === (string)TransactionStatus::rejected();
    }

    /**
     * @return bool - true if user only has 1 transaction
     */
    public function isUserOnlyTransaction()
    {
        return $this->user->transactions()->count() === 1;
    }

    /**
     * User that made the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Pretty date for display.
     *
     * @return mixed
     */
    public function getTransactionDateAttribute() {
        return $this->created_at->format('d M Y');
    }

    /**
     * Convert to 'from_amount' to cents
     *
     * @param $value
     *
     * @return float|int
     */
    public function setFromAmountAttribute($value)
    {
        $this->attributes['from_amount'] =  $value * 100;
    }

    /**
     * Convert to 'to_amount' to cents
     *
     * @param $value
     *
     * @return float|int
     */
    public function setToAmountAttribute($value)
    {
        $this->attributes['to_amount'] = $value * 100;
    }

    /**
     * Convert to 'fees' to cents
     *
     * @param $value
     *
     * @return float|int
     */
    public function setFeesAttribute($value)
    {
        $this->attributes['fees'] = $value * 100;
    }

    /**
     * Convert to 'from_amount' to dollars
     *
     * @param $value
     *
     * @return float|int
     */
    public function getFromAmountAttribute($value)
    {
        return Formatter::money($value / 100);
    }

    /**
     * Convert to 'to_amount' to dollars
     *
     * @param $value
     *
     * @return float|int
     */
    public function getToAmountAttribute($value)
    {
        return Formatter::money($value / 100);
    }

    /**
     * Convert to 'fees' to dollars
     *
     * @param $value
     *
     * @return float|int
     */
    public function getFeesAttribute($value)
    {
        return Formatter::money($value / 100);
    }

    /**
     * Scope by owner.
     *
     * @param $query
     * @param $userId
     *
     * @return mixed
     */
    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
