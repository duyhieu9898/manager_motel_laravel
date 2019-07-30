<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUsersWithRoles();
    public function createUser(array $dataUser);
    public function updateById(int $id, array $user);
    public function deleteById(int $id);
    public function bookings();
    public function getCartRoomByUserId(int $userId);
    public function bookingPending(int $userId);
    public function countRoomsInCartByUserId(int $userId);
}
