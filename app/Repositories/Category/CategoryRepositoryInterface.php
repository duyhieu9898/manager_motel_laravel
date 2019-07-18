<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getNewRoomsOfAllCategories($numItem);
    public function getRoomByCategoryId(int $id);
}
