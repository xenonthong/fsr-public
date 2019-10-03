<?php

namespace App\Filters;

class TransactionFilter extends Filter
{
    protected $filterables = [
        'createdFrom',
        'createdTo',
        'sort',
    ];

    protected function sort($by) {
        return $this->builder->orderBy('created_at', $by);
    }
}