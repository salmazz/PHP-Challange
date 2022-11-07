<?php

namespace App\Filters;

use App\Filters\Hotel\CityFilter;
use App\Filters\Hotel\CountryFilter;
use App\Filters\Hotel\NameFilter;
use App\Filters\Hotel\PriceFilter;
use App\Filters\Hotel\RatingFilter;

class HotelFilter extends AbstractFilter
{
    /**
     * @var string[]
     */
    protected $filters = [
        'country' => CountryFilter::class,
        'price' => PriceFilter::class,
        'name' => NameFilter::class,
        'city_name' => CityFilter::class,
        'rating' => RatingFilter::class
    ];
}
