<?php

namespace App\Filters\Hotel;

class CityFilter
{
    /**
     * @param $builder
     * @param null $value
     * @return mixed
     */
    public function filter($builder, string $value = null)
    {
        return $builder->when($value, function ($query) use ($value){
            $query->whereHas('city',function ($query) use ($value){
                $query->where('name', 'like', '%' . $value . '%');
            })->orderBy('id', 'desc');
        });
    }
}
