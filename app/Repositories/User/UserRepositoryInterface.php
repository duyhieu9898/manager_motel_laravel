<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUsersWithRoles();
    public function createUser(array $dataUser);
    public function updateById(int $id, array $user);
    public function deleteById(int $id);
    public function getCartRoomByUserId(int $userId);
    public function bookingPending(int $userId);
    public function countRoomsInCartByUserId(int $userId);
    public function getBookingPending(int $userId);
    public function getBookingCompleted(int $userId);
    public function getBookingCanceled(int $userId);
}
