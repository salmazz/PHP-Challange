<?php

namespace App\Http\Controllers\API;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreRequest;
use App\Http\Requests\Hotel\UpdateRequest;
use App\Http\Resources\HotelResource;
use App\Services\Hotel\HotelService;
use App\Traits\ResponseTrait;
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
    public function index(Request $request)
    {
        return $this->response($this->hotelService->list($request), 'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(StoreRequest $request)
    {
        return $this->response(new HotelResource($this->hotelService->create($request->validated())), 'true',
            'Hotel Stored Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function show($id)
    {
        return $this->response(new HotelResource($this->hotelService->find($id)), 'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->response(new HotelResource($this->hotelService->update($request->validated(), $id)),
            'true', 'Hotel Updated Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->hotelService->delete($id);
        return $this->response([], true, 'Hotel Deleted Successfully', HttpStatus::HTTP_OK);
    }
}
