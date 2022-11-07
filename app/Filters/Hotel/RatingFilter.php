<?php

namespace App\Filters\Hotel;

class RatingFilter
{
    public function filter($builder, string $value)
    {
        return $builder->where('rating', '>=', $value)->orderBy('rating', 'desc');
    }
}
