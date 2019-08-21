<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;

use App\Services\ImageService;

class ImageController extends Controller
{
    private $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService=$imageService;
    }

    /**
    * store image for room create
    *
    * @param  App\Http\Requests\ImageRequest  $request
    * @param  int  $roomId
    * @return \Illuminate\Http\Response
    */
    public function store(ImageRequest $request)
    {
        $photo = $request->file;
        $imageId = $this->imageService->store($photo);

        if (!$imageId) {
            return response()->json([
                'message' => 'Server error while store image to DB',
            ], 500);
        }

        return response()->json(['image_id' => $imageId], 201);
    }
    /**
     * Remove image
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->imageService->deleteById($id)) {
            return response()->json(['message' => 'delete success'], 200);
        }
        return response()->json([
                'message' => 'Server error while destroy image'
            ], 500);
    }

    /**
     * get list images by room id
     *
     * @param int $roomId
     * @return \Illuminate\Http\Response
     */
    public function getListImagesByRoomId(int $roomId)
    {
        $listImages = $this->imageService->getListImagesByRoomId($roomId);

        if (!$listImages) {
            return response()->json([
                'message' => 'Server error while get list image'
            ], 500);
        }

        return response()->json($listImages, 200);
    }

    /**
     * Save Image for room update
     *
     * @param ImageRequest $request
     * @param int $roomId
     * @return \Illuminate\Http\Response
     */
    public function saveImage(ImageRequest $request, int $roomId)
    {
        $photo = $request->file;
        $imageId = $this->imageService->saveImage($photo, $roomId);

        if (!$imageId) {
            return response()->json([
                'message' => 'Server error while storing image'
            ], 500);
        }

        return response()->json(['image_id' => $imageId], 201);
    }
}
