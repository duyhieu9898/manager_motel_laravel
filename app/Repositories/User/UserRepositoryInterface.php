<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function createUser(array $dataUser);
    public function updateById(int $id, array $user);
    public function deleteById(int $id);
}
