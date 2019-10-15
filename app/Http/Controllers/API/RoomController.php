<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomCreateRequest;
use App\Http\Requests\RoomEditRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Convenience\ConvenienceRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Room\RoomRepositoryInterface;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $roomRepository;
    private $categoryRepository;
    private $convenienceRepository;
    private $imageRepository;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        CategoryRepositoryInterface $categoryRepository,
        ConvenienceRepositoryInterface $convenienceRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
        $this->convenienceRepository = $convenienceRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Log::info($request);
        $pagination = $this->roomRepository->jsonPagination(10);

        $rooms = $pagination->load('category', 'address.province');
        return response()->json(['rooms' => $rooms, 'pagination' => $pagination], 206);
    }

    /**
     * get form info to create new user
     *
     * @return void
     */
    public function create()
    {
        $listCategory = $this->categoryRepository->get();
        $listConvenience = $this->convenienceRepository->get();
        return response()->json(['conveniences' => $listConvenience, 'categories' => $listCategory], 200);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomCreateRequest $request)
    {
        $dataRoom = $request->all();
        $roomId = $this->roomRepository->create($dataRoom);
        if (!$roomId) {
            return response()->json(['message' => 'Server error while creating room',], 500);
        }
        $this->imageRepository->setImagesToRoom($dataRoom['list_images_id'], $roomId);
        return response()->json([
            'message' => 'store room success',
        ], 201);
    }

    /**
     * update number people in a room
     *
     * @param Request $request
     * @return Response
     */
    public function updatePeopleInRoom(Request $request)
    {
        $room = $this->roomRepository->findById($request->room_id);
        $room->number_peoples = $request->number_people;
        $result = $room->save();
        if ($result) {
            return response()->json([
                'message' => 'update peoples in room success',
                'people' => $request->number_people,
            ], 200);
        }
        return response()->json(['message' => 'Server error while updating peoples in room'], 500);
    }

    /**
     * get form info to edit user
     *
     * @param integer $id
     * @return Response
     */
    public function edit(int $id)
    {
        $categories = $this->categoryRepository->get();
        $conveniences = $this->convenienceRepository->get();
        $room = $this->roomRepository->findById($id)->load('conveniences');
        $AllConveniencesId = $room->conveniences->map(function ($item) {
            return $item['id'];
        });
        $arrListConveniencesId = $AllConveniencesId->all();
        $arrData = [
            'room' => $room,
            'categories' => $categories,
            'conveniences' => $conveniences,
            'arrListConveniencesId' => $arrListConveniencesId,
        ];
        return response()->json($arrData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomEditRequest $request, $id)
    {
        $result = $this->roomRepository->updateById($id, $request->all());
        if ($result) {
            return response()->json(['message' => 'update room success'], 200);
        }

        return response()->json([
            'message' => 'Server error while updating room',
        ], 500);
    }

    /**
     * update status display in the room
     *
     * @param Request $request
     * @param integer $roomId
     * @return Response
     */
    public function active(Request $request, int $roomId)
    {
        $valActive = $request->active;
        $result = $this->roomRepository->active($valActive, $roomId);
        if ($result) {
            return response()->json(['message' => 'update room active success'], 200);
        }
        return response()->json([
            'message' => 'Server error while updating room active',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $result = $this->roomRepository->deleteById($id);
        if ($result) {
            return response()->json(['message' => 'delete room success', 200]);
        }
        return response()->json(['message' => 'delete room errors', 500]);
    }
}
