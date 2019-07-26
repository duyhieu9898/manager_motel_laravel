<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getNewRoomsOfAllCategories($numItem);
    public function create(array $dataUser);
    public function updateById(int $id, array $user);
    public function deleteById(int $id);
}
