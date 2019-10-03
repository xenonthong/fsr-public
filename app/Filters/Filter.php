<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $filterables = [];

    /**
     * @var
     */
    protected $builder;

    /**
     * Filter constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    protected function getFilterables() {
        return $this->request->only($this->filterables);
    }

    /**
     * Apply the query scopes.
     *
     * @param $builder
     */
    public function apply($builder) {
        $this->builder = $builder;

        foreach ($this->getFilterables() as $scope => $value) {
            if (method_exists($this, $scope) && !is_null($value)) {
                $this->$scope($value);
            }
        }
    }

    /**
     * Filters created_at column
     *
     * @param $date
     *
     * @return mixed
     */
    public function createdFrom($date)
    {
        return $this->builder->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $date));
    }

    /**
     * Filters created_at column
     *
     * @param $date
     *
     * @return mixed
     */
    public function createdTo($date)
    {
        return $this->builder->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $date));
    }
}