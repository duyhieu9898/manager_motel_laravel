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

    public function getNewRoomsOfCategory($categories)
    {
        foreach ($categories as $category) {
            $rooms[] = Category::ofName($category['name'])->first()->load(
                [
                    'rooms' => function ($query) {
                        $query->limit(3);
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

    public function getRoomByCategoryId(int $id)
    {
        $listRooms=$this->model->findOrFail($id)->load(
            [
            'rooms',
            'rooms.address.district',
            'rooms.address.province',
            'rooms.images',
            ]
        );
        if ($listRooms) {
            return $listRooms;
        }
        return false;
    }
}
