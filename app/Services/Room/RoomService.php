<?php

namespace App\Services\Room;

use App\Http\Resources\RoomResource;
use App\Repositories\Room\RoomRepository;
use App\Services\Service;
use Illuminate\Http\Request;

class RoomService extends Service{
    /**
     * @return string
     */
    public function repository()
    {
        return RoomRepository::class;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list()
    {
        $rooms = $this->repository->paginate(15);
        return RoomResource::collection($rooms)->response()->getData(true);
    }
}
