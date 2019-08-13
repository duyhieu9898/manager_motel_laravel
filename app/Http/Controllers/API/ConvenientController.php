<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConvenientRequest;
use App\Repositories\Convenient\ConvenientRepositoryInterface;

class ConvenientController extends Controller
{
    private $convenientRepository;

    public function __construct(ConvenientRepositoryInterface $convenient)
    {
        $this->convenientRepository = $convenient;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenients = $this->convenientRepository->get();
        if ($convenients) {
            return response()->json($convenients, 200);
        }
        return response()->json(['message' => 'error get list Convenient'], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvenientRequest $request)
    {
        $convenient = $this->convenientRepository->create($request->only('name'));
        if ($convenient) {
            return response()->json(['message' => 'created convenient', 'id' =>$convenient->id], 201);
        }
        return response()->json(['message' => 'error create convenient'], 500);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConvenientRequest $request, $id)
    {
        $result = $this->convenientRepository->updateById($id, $request->only('name'));
        if ($result) {
            return response(['message' => 'success'], 200);
        }
        return response()->json(['message' => 'error update convenient'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->convenientRepository->deleteById($id);
        if ($result) {
            return response(['message' => 'delete convenient success'], 200);
        }
        return response()->json(['message' => 'error update convenient'], 500);
    }
}
