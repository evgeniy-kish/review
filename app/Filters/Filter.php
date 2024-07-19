<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Builder|null
     */
    protected ?Builder $builder = null;

    /**
     * @var array $filters
     */
    protected array $filters = [];

    /**
     * ThreadFilter constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * @return array
     */
    protected function getFilters(): array
    {
        return array_filter($this->request->only($this->filters));
    }
}
