<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'category.name' => 'required|min:5|max:20',
            ],
            [
                'required' => 'Name is a required field',
                'min' => 'The password must be at least :min characters',
                'max' => 'The password must be at most :max characters.',
            ]
        );
        $dataCategory = $request->input('category');
        $category = $this->categoryRepository->create($dataCategory);
        if (!$category) {
            return response()->json(['message' => 'error create category'], 500);
        }
        return response()->json(['message' => 'created category'], 200);
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
        $this->validate(
            $request,
            [
                'category.name' => 'required|min:5|max:20',
            ],
            [
                'required' => 'Name is a required field',
                'min' => 'The Name must be at least :min characters',
                'max' => 'The Name must be at most :max characters.',
            ]
        );
        $dataCategory = $request->input('category');
        $this->categoryRepository->updateById($id, $dataCategory);
        $category = $this->categoryRepository->updateById($id, $dataCategory);
        if (!$category) {
            return response()->json(['message' => 'error update category'], 500);
        }
        return response(
            [
                'result' => 'success',
                'role_id' => $category,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->deleteById($id);
        return response(['result' => 'success', 200]);
    }
}
