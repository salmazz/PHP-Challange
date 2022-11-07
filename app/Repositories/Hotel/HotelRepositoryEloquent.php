<?php

namespace App\Repositories\Hotel;

use App\Filters\HotelFilter;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class HotelRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HotelRepositoryEloquent extends BaseRepository implements HotelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Hotel::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
