<?php

namespace App\Services\Hotel;

use App\Http\Resources\HotelResource;
use App\Repositories\Hotel\HotelRepository;
use App\Services\Service;
use Illuminate\Http\Request;

class HotelService extends Service
{
    /**
     * @return string
     */
    public function repository()
    {
        return HotelRepository::class;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $hotels = $this->repository->filter($request)->paginate(15);
        return HotelResource::collection($hotels)->response()->getData(true);
    }
}
