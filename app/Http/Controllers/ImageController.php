<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Repositories\Image\ImageRepositoryInterface;

class ImageController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

     /**
     * store the specified resource in storage.
     *
     * @param  App\Http\Requests\ImageRequest  $request
     * @param  int  $roomId
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $photo = $request->file;
        $response = $this->imageRepository->storeByRoomId($photo, null);
        return $response;
    }
    /**
     * store image by room id
     *
     * @param ImageRequest $request
     * @param int $roomId
     * @return \Illuminate\Http\Response
     */
    public function storeByRoomId(ImageRequest $request, $roomId)
    {
        $photo = $request->file;
        $response = $this->imageRepository->storeByRoomId($photo, $roomId);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($imageId)
    {
        $result = $this->imageRepository->deleteById($imageId);
        if ($result) {
            return response(204);
        }
        return response(400);
    }
    public function getListImagesByRoom($roomId)
    {
        $listImages = $this->imageRepository->getListImagesByRoom($roomId);
        if ($listImages) {
            return response()->json($listImages, 200);
        }
        return response(400);
    }
}
