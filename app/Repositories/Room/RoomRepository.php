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
    public function getByCategoryId($idCategory, $perPage)
    {
        return $this->model::where('category_id', $idCategory)->paginate($perPage);
    }
    public function create($dataRoom)
    {
        $room = new $this->model;
        $room->category_id = $dataRoom['category_id'];
        $room->address_id = $dataRoom['address_id'];
        $room->title = $dataRoom['title'];
        $room->description = $dataRoom['description'];
        $room->room_area = $dataRoom['room_area'];
        $room->price = $dataRoom['price'];
        $room->police_and_terms = $dataRoom['police_and_terms'];
        $room->maximum_peoples_number = $dataRoom['maximum_peoples_number'];
        $room->save();
        $room->roles()->attach($dataRoom['list_convenients_id']);
        if ($room->save()) {
            return $room->id;
        }
        return false;
    }
    public function update($room, $dataRoom)
    {
        $room->category_id = $dataRoom['category_id'];
        $room->title = $dataRoom['title'];
        $room->description = $dataRoom['description'];
        $room->room_area = $dataRoom['room_area'];
        $room->police_and_terms = $dataRoom['police_and_terms'];
        $room->price = $dataRoom['price'];
        $room->maximum_peoples_number = $dataRoom['maximum_peoples_number'];
        $room->save();
        $room->roles()->detach();
        $room->roles()->attach($dataRoom['list_convenients_id']);
        if ($room) {
            return true;
        }
        return false;
    }
    public function jsonPagination($perPage)
    {
        return $this->model::paginate($perPage);
    }
    public function deleteById(int $id)
    {
        $room = $this->findById($id);
        if ($room->delete()) {
            return true;
        }
        return false;
    }
}
