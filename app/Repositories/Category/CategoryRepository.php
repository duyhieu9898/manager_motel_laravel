<?php

namespace App\Repositories\Category;

use App\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    protected $model;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getNewRoomsOfAllCategories($numItem)
    {
        $categories  = $this->getAll();
        foreach ($categories as $category) {
            $rooms[] = Category::ofName($category['name'])->first()->load(
                [
                    'rooms' => function ($query) use ($numItem) {
                        $query->limit($numItem);
                        $query->where('active', 1);
                    },
                    'rooms.address.ward',
                    'rooms.address.district',
                    'rooms.address.province',
                    'rooms.images',
                ]
            );
        }
        return $rooms;
    }

    public function create(array $dataCategory)
    {
        $category            = new category();
        $category->name      = $dataCategory['name'];
        $result = $category->save();
        if ($result) {
            return $category;
        }
        return false;
    }

    public function updateById(int $id, array $dataCategory)
    {
        $category        = $this->findById($id);
        $category->name  = $dataCategory['name'];
        $result = $category->save();
        if ($result) {
            return $category;
        }
        return false;
    }

    public function deleteById(int $id)
    {
        $category = $this->findById($id);
        $result = $category->delete();
        return $result;
    }
}
