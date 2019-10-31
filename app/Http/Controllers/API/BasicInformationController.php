<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasicInformationRequest;
use App\Repositories\BasicInformation\BasicInformationRepositoryInterface;

class BasicInformationController extends Controller
{
    private $basicInformationRepository;

    public function __construct(BasicInformationRepositoryInterface $basicInformation)
    {
        $this->basicInformationRepository = $basicInformation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basicInformations = $this->basicInformationRepository->get();
        if ($basicInformations) {
            return response()->json($basicInformations, 200);
        }
        return response()->json(['message' => 'error get list basic information'], 500);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BasicInformationRequest $request, $id)
    {
        $result = $this->basicInformationRepository->updateById($id, $request->only('content'));
        if ($result) {
            return response(['message' => 'success'], 200);
        }
        return response()->json(['message' => 'error update basic information'], 500);
    }
}
