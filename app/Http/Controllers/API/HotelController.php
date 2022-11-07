<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreRequest;
use App\Http\Requests\Hotel\UpdateRequest;
use App\Http\Resources\HotelResource;
use App\Services\Hotel\HotelService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    use ResponseTrait;

    /**
     * @var HotelService
     */
    public HotelService $hotelService;

    /**
     * HotelController constructor.
     * @param HotelService $hotelService
     */
    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request) :JsonResponse
    {
        return $this->response($this->hotelService->list($request), 'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(StoreRequest $request) :JsonResponse
    {
        return $this->response(new HotelResource($this->hotelService->create($request->validated())), 'true',
            'Hotel Stored Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show($id) :JsonResponse
    {
        return $this->response(new HotelResource($this->hotelService->find($id)), 'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id) :JsonResponse
    {
        return $this->response(new HotelResource($this->hotelService->update($request->validated(), $id)),
            'true', 'Hotel Updated Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id) :mixed
    {
        $this->hotelService->delete($id);
        return $this->response([], true, 'Hotel Deleted Successfully', HttpStatus::HTTP_OK);
    }
}
