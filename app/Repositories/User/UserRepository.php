<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    protected $model;

    /**
     * RoomRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function getUsersWithRoles()
    {
        return User::get()->load('roles');
    }

    public function createUser(array $dataUser)
    {
        $user            = new User();
        $user->name      = $dataUser['name'];
        $user->email     = $dataUser['email'];
        $user->phone     = $dataUser['phone'];
        $user->password  = bcrypt($dataUser['password']);
        $user->api_token = $dataUser['api_token'];
        $result = $user->save();
        if ($result) {
            return $user;
        }
        return false;
    }

    public function updateById(int $id, array $dataUser)
    {
        $user        = $this->findById($id);
        $user->name  = $dataUser['name'];
        $user->email = $dataUser['email'];
        $user->phone = $dataUser['phone'];
        if ($dataUser['phone']) {
            $user->address_id = $dataUser['address_id'];
        }
        $result = $user->save();
        if ($result) {
            return $user;
        }
        return false;
    }
    public function deleteById(int $id)
    {
        $user = $this->findById($id);
        $user->roles()->detach();
        return $user->delete();
    }
    public function bookings()
    {
        return $this->model::has('rooms')->get();
    }
    public function getCartRoomByUserId(int $userId)
    {
        // $user = $this->model::find($userId)->whereHas('rooms')->wherePivot('status_id', '=', 1)->get();
        return $this->model::find($userId)->rooms()->wherePivot('status_id', 1)->get();

        // foreach ($user->rooms as $user) {
        //     $ds[]=$user->pivot->peoples;
        // }
        // dd($ds);
    }


    public function bookingPending(int $userId)
    {
        $rooms = $this->findById($userId)->load('rooms')->rooms;
        foreach ($rooms as $room) {
            $room->users()->updateExistingPivot($userId, ['status_id' => 2]);
        }
    }
    public function countRoomsInCartByUserId(int $userId)
    {
        $user = $this->findById($userId);
        return $user->rooms()->wherePivot('status_id', 1)->count();
    }
}
