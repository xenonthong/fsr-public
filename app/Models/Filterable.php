<?php

namespace App\Models;

use App\Filters\Filter;

trait Filterable
{
    public static function scopeFilter($query, Filter $filter) {
        $filter->apply($query);
    }
}