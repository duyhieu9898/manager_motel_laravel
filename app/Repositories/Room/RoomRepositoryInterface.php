<?php

namespace App\Repositories\Room;

use App\Repositories\RepositoryInterface;

interface RoomRepositoryInterface extends RepositoryInterface
{
    public function getByCategoryId($idCategory, $perPage);
    public function create($dataRoom);
    public function update($room, $dataRoom);
    public function jsonPagination($perPage);
    public function active(bool $val, int $roomId);
    public function people($roomId, $numPeoples);
    public function bookingProcessing($userId, $dataBooking);
}
