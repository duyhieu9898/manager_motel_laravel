<?php

namespace App\Repositories\Room;

use App\Room;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    /**
     * @var Room
     */
    protected $model;

    /**
     * RoomRepository constructor.
     *
     * @param Room $model
     */
    public function __construct(Room $model)
    {
        parent::__construct($model);
    }
    public function findById(int $id)
    {
        $room = Room::find($id)->load('images', 'address', 'convenients', 'category');
        return $room;
    }
    public function load(...$model)
    { }
    public function getAll()
    {
        $rooms = Room::get()->load('address', 'category', 'images', 'statusBooking');
        return $rooms;
    }
}
