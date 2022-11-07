<?php

namespace App\Repositories\Room;

use App\Models\RoomType;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RoomRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomTypeRepositoryEloquent extends BaseRepository implements RoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomType::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
