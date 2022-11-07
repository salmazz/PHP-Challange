<?php

declare(strict_types=1);

namespace App\Services\Hotel;

use App\Http\Resources\HotelResource;
use App\Repositories\Hotel\HotelRepository;
use App\Services\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelService extends Service
{
    /**
     * @return string
     */
    public function repository() :string
    {
        return HotelRepository::class;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) :array
    {
        $hotels = $this->repository->filter($request)->paginate(1);
        return HotelResource::collection($hotels)->response()->getData(true);
    }
}
