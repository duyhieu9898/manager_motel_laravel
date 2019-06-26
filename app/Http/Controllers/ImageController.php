<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request, $roomId)
    {
        $photo = $request->file;
        $response = $this->imageRepository->upload($photo, $roomId);
        return $response;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $imageId)
    {
        // return response('ok');
        $result = $this->imageRepository->deleteById($imageId);
        if ($result) {
            return response()->json([
                'error' => false,
                'code'  => 200
            ], 200);
        }
        return response()->json([
            'error' => true,
            'code'  => 400
        ], 400);
    }
    public function getListImagesByRoom($roomId)
    {
        $listImages = $this->imageRepository->getListImagesByRoom($roomId);
        return response()->json($listImages, 200);
    }
}
