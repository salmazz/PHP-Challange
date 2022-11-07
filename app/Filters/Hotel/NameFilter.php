<?php

namespace App\Filters\Hotel;

class NameFilter
{
    public function filter($builder, string $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%')->orderBy('name', 'desc');

    }
}
