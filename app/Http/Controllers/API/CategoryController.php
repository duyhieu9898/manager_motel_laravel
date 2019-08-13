<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * @var categoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * return list categories and roles
     *
     * @return collection
     */

    public function index()
    {
        $categories = $this->categoryRepository->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $result = $this->categoryRepository->create($request->only('name'));
        if ($result) {
            return response()->json(['message' => 'created category'], 201);
        }
        return response()->json(['message' => 'error create category'], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $result = $this->categoryRepository->updateById($id, $request->only('name'));
        if ($result) {
            return response(['result' => 'success'], 200);
        }
        return response()->json(['message' => 'error update category'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->categoryRepository->deleteById($id);
        if ($result) {
            return response(['result' => 'delete category success'], 200);
        }
        return response()->json(['message' => 'error update category'], 500);
    }
}
