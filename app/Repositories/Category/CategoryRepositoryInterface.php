<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getNewRoomsOfCategory($categories);
    public function getRoomByCategoryId(int $id);
}
