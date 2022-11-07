<?php

namespace App\Http\Controllers\API\Room;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\UpdateRequest;
use App\Http\Resources\RoomResource;
use App\Services\Room\RoomService;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Request;

class RoomController extends Controller
{
    use ResponseTrait;

    /**
     * @var RoomService
     */
    public RoomService $roomService;

    /**
     * RoomController constructor.
     * @param RoomService $roomService
     */
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        return $this->response($this->roomService->list(), 'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(StoreRequest $request)
    {
        return $this->response(new RoomResource($this->roomService->create($request->validated())), 'true',
            'Room Stored Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function show($id)
    {
        return $this->response(new RoomResource($this->roomService->find($id)),'true', '', HttpStatus::HTTP_OK);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->response(new RoomResource($this->roomService->update($request->validated(), $id)),
            'true', 'Room Updated Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->roomService->delete($id);
        return $this->response([],true, 'Room Deleted Successfully',HttpStatus::HTTP_OK);
    }
}
