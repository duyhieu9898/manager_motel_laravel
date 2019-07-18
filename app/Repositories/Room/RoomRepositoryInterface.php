<?php

namespace App\Repositories\Room;

use App\Repositories\RepositoryInterface;

interface RoomRepositoryInterface extends RepositoryInterface
{
    public function create($dataRoom);
    public function update($room, $dataRoom);
    public function jsonPagination($perPage);
}
