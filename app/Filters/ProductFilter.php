<?php

namespace App\Filters;

class ProductFilter extends Filter
{
    /**
     * @var array $filters
     */
    protected array $filters = ['reviews', 'rate', 'date'];

    protected function reviews()
    {
        $this->builder->getQuery()->orders = [];

        /** @noinspection UnknownColumnInspection */
        return $this->builder->orderBy('reviews_count', 'desc');
    }

    protected function rate($value)
    {
        if ($rating = parseRating($value)) {
            return $this->builder->whereIn('rating', $rating);
        }

        return $this->builder;
    }

    protected function date($value)
    {
        $this->builder->getQuery()->orders = [];

        if ('desc' === $value) {
            return $this->builder->latest('created_at');
        }

        return $this->builder->oldest('created_at');
    }
}
