<?php

declare(strict_types=1);

namespace App\Services\Room;

use App\Http\Resources\RoomResource;
use App\Repositories\Room\RoomRepository;
use App\Services\Service;
use Illuminate\Http\Request;

class RoomService extends Service{
    /**
     * @return string
     */
    public function repository() :string
    {
        return RoomRepository::class;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list() :mixed
    {
        $rooms = $this->repository->paginate(15);
        return RoomResource::collection($rooms)->response()->getData(true);
    }
}
