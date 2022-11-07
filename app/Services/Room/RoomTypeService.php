<?php

namespace App\Services\Room;

use App\Repositories\Room\RoomTypeRepository;
use App\Services\Service;

class RoomTypeService extends Service{
    /**
     * @return string
     */
    public function repository()
    {
        return RoomTypeRepository::class;
    }
}
