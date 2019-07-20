<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomEditRequest;
use App\Http\Requests\RoomCreateRequest;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Convenient\ConvenientRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    private $roomRepository;
    private $categoryRepository;
    private $convenientRepository;
    private $imageRepository;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        CategoryRepositoryInterface $categoryRepository,
        ConvenientRepositoryInterface $convenientRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
        $this->convenientRepository = $convenientRepository;
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
        return response()->json(['rooms' => $rooms, 'pagination' => $pagination]);
    }
    public function create()
    {
        $listCategory   = $this->categoryRepository->getAll();
        $listConvenient = $this->convenientRepository->getAll();
        return response()->json(['convenients' => $listConvenient, 'categories' => $listCategory]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomCreateRequest $request)
    {
        $dataRoom = $request->all();
        $roomId = $this->roomRepository->create($dataRoom);
        if (!$roomId) {
            return response()->json([
                'message' => 'Server error while creating room'
            ], 500);
        }
        $this->imageRepository->setImagesToRoom($dataRoom['list_images_id'], $roomId);
        return response()->json([
            'message' => 'store room success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories       = $this->categoryRepository->getAll();
        $convenients      = $this->convenientRepository->getAll();
        $room             = $this->roomRepository->findById($id)->load('convenients');
        $AllConvenientsId = $room->convenients->map(function ($item) {
            return $item['id'];
        });
        $arrListConvenientsId = $AllConvenientsId->all();
        $arrData = [
            'room'                 => $room,
            'categories'           => $categories,
            'convenients'          => $convenients,
            'arrListConvenientsId' => $arrListConvenientsId,
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
        $dataRoom = $request->all();
        $room     = $this->roomRepository->findById($id);
        $result   = $this->roomRepository->update($room, $dataRoom);
        if ($result) {
            return response()->json([
                'message' => 'update room success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Server error while updating room'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $result=$this->roomRepository->deleteById($id);
        if ($result) {
            return response()->json(['message' => 'delete room success', 200]);
        }
        return response()->json(['message' => 'delete room errors', 500]);
    }
}
