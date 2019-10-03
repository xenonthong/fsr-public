<?php

namespace App\Models;

use Carbon\Carbon;

class Promotion extends Model
{
    public function scopeOngoing($query)
    {
        $now = new Carbon();

        return $query->where('start', '<=', $now)->where('end', '>=', $now);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
