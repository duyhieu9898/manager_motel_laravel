<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function createUser($userName, $userEmail, $nameRole, $userPassword);
    public function updateById($user, $userName, $userEmail, $roles);
    public function deleteById($user);
}
