<?php

namespace App\Filters\Hotel;

class PriceFilter
{
    /**
     * @param $builder
     * @param string $value
     */
    public function filter($builder, string $value)
    {
        $builder->when($value, function ($query) use ($value) {
            list($min, $max, $size) = explode(",", $value);
            $query->whereHas('rooms', function ($q) use ($min, $max) {
                $q->where('price', '>=', $min)
                    ->where('price', '<=', $max);
            });
            $query->whereHas('rooms.roomType', function ($q) use ($size) {
                    $q->where('size', $size);
                });
        })->orderBy('price', 'desc');
    }
}
