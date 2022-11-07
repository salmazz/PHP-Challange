<?php

declare(strict_types=1);

namespace App\Services\Room;

use App\Repositories\Room\RoomTypeRepository;
use App\Services\Service;

class RoomTypeService extends Service{
    /**
     * @return string
     */
    public function repository() :string
    {
        return RoomTypeRepository::class;
    }
}
