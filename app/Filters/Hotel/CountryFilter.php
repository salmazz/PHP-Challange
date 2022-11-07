<?php

namespace App\Filters\Hotel;

class CountryFilter
{
    /**
     * @param $builder
     * @param $value
     * @return mixed
     */
    public function filter($builder, string $value)
    {
        return $builder->when($value, function ($query) use ($value) {
            $query->whereHas('city.country', function ($query) use ($value) {
                $query->where('ISO_code', 'like', '%' . $value . '%')
                ->Orwhere('name', 'like', '%' . $value . '%');
            })->orderBy('name','desc')->orderBy('ISO_code','desc');
        });
    }
}
