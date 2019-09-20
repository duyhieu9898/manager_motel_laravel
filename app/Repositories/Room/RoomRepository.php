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

        // return Room::whereHas('images', function ($query) use ($idCategory) {
        //     $query->where(['category_id'=> $idCategory, 'active' => true]);
        // })
        //     ->with(['images','category'])
        //     ->paginate($perPage);


        return $this->model::where(['category_id' => $idCategory ,'active' => true])
                ->with(['images', 'category'])
                ->paginate($perPage);
    }

    public function create(array $dataRoom)
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
        $result = $room->save();
        $room->convenients()->attach($dataRoom['list_convenients_id']);

        if ($result) {
            return $room->id;
        }
        return false;
    }

    public function updateById(int $id, array $dataRoom)
    {
        $room = $this->findById($id);
        $room->category_id = $dataRoom['category_id'];
        $room->title = $dataRoom['title'];
        $room->description = $dataRoom['description'];
        $room->room_area = $dataRoom['room_area'];
        $room->police_and_terms = $dataRoom['police_and_terms'];
        $room->price = $dataRoom['price'];
        $room->maximum_peoples_number = $dataRoom['maximum_peoples_number'];
        $result = $room->save();
        //
        $room->convenients()->sync($dataRoom['list_convenients_id']);

        if ($result) {
            return true;
        }
        return false;
    }

    public function jsonPagination($perPage)
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    public function deleteById(int $id)
    {
        $room = $this->findById($id);
        $room->convenients()->detach();
        $result =$room->delete();
        if ($result) {
            return true;
        }
        return false;
    }

    public function active(bool $val, int $roomId)
    {
        $room = $this->findById($roomId);
        $room->active = $val;
        $result = $room->save();
        if ($result) {
            return true;
        }
        return false;
    }
    public function people($roomId, $numPeoples)
    {
        $room = $this->findById($roomId);
        $room->number_peoples = $room->number_peoples + $numPeoples;
        $result = $room->save();
        if ($result) {
            return true;
        }
        return false;
    }
    public function bookingProcessing($userId, $dataBooking)
    {
        return $this->model->users()->attach($userId, $dataBooking);
    }
    public function getNewCreate(int $numItem)
    {
        $rooms=$this->model::where(['active' =>1 ])
            ->orderBy('created_at', 'desc')
            ->limit($numItem)->get()
            ->load(['address.ward','address.district', 'address.province', 'images' ]);

        return $rooms;
    }
}
