<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConvenienceRequest;
use App\Repositories\Convenience\ConvenienceRepositoryInterface;

class ConvenienceController extends Controller
{
    private $convenienceRepository;

    public function __construct(ConvenienceRepositoryInterface $convenience)
    {
        $this->convenienceRepository = $convenience;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conveniences = $this->convenienceRepository->get();
        if ($conveniences) {
            return response()->json($conveniences, 200);
        }
        return response()->json(['message' => 'error get list Convenience'], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvenienceRequest $request)
    {
        $convenience = $this->convenienceRepository->create($request->only('name'));
        if ($convenience) {
            return response()->json(['message' => 'created convenience', 'id' =>$convenience->id], 201);
        }
        return response()->json(['message' => 'error create convenience'], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConvenienceRequest $request, $id)
    {
        $result = $this->convenienceRepository->updateById($id, $request->only('name'));
        if ($result) {
            return response(['message' => 'success'], 200);
        }
        return response()->json(['message' => 'error update convenience'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->convenienceRepository->deleteById($id);
        if ($result) {
            return response(['message' => 'delete convenience success'], 200);
        }
        return response()->json(['message' => 'error update convenience'], 500);
    }
}
