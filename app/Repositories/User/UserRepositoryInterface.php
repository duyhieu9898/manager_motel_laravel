<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function createUser($dataUser);
    public function updateById($user, $userName, $userEmail, $roles);
    public function deleteById($user);
}
