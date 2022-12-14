<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Room;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\StoreRequest;
use App\Http\Requests\RoomType\UpdateRequest;
use App\Http\Resources\RoomTypeResource;
use App\Services\Room\RoomTypeService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class RoomTypeController extends Controller
{
    use ResponseTrait;

    /**
     * @var RoomTypeService
     */
    public RoomTypeService $roomTypeService;

    /**
     * RoomType Controller constructor.
     * @param RoomTypeService $roomTypeService
     */
    public function __construct(RoomTypeService $roomTypeService)
    {
        $this->roomTypeService = $roomTypeService;
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function index() :JsonResponse
    {
        return $this->response(RoomTypeResource::collection($this->roomTypeService->paginate(15)), 'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(StoreRequest $request) :JsonResponse
    {
        return $this->response(new RoomTypeResource($this->roomTypeService->create($request->validated())), 'true',
            'Room Type Stored Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show($id) :JsonResponse
    {
        return $this->response(new RoomTypeResource($this->roomTypeService->find($id)), 'true', '', HttpStatus::HTTP_OK);

    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id) :JsonResponse
    {
        return $this->response(new RoomTypeResource($this->roomTypeService->update($request->validated(), $id)),
            'true', 'Room Type Updated Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function delete($id) :mixed
    {
        $this->roomTypeService->delete($id);
        return $this->response([], true, 'Room Type Deleted Successfully', HttpStatus::HTTP_OK);

    }
}
