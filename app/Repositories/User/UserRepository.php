<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\User;

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
    /**
     * get user with roles
     *
     * @return User
     */
    public function getUsersWithRoles()
    {
        return User::get()->load('roles');
    }
    /**
     * Store a newly created user in storage.
     *
     * @param array $dataUser
     * @return integer
     */
    public function createUser(array $dataUser):int
    {
        $dataUser['password'] =  bcrypt(123456);
        $user = $this->model::create($dataUser);
        if ($user) {
            return $user->id;
        }
        return false;
    }
    /**
     * update user in storage
     *
     * @param integer $id
     * @param array $dataUser
     * @return User
     */
    public function updateById(int $id, array $dataUser)
    {
        $user = $this->findById($id);
        if ($user->update($dataUser)) {
            return $user;
        }
        return false;
    }
    /**
     * delete user in storage
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id)
    {
        $user = $this->findById($id);
        $user->roles()->detach();
        return $user->delete();
    }

    /**
     * update all bookings of the user to processing come pending
     *
     * @param integer $userId
     * @return void
     */
    public function bookingPending(int $userId)
    {
        $rooms = $this->findById($userId)->load('rooms')->rooms;
        foreach ($rooms as $room) {
            $room->users()->updateExistingPivot($userId, ['status_id' => 2]);
        }
    }
    /**
     * count number Room in cart
     *
     * @param integer $userId
     * @return integer
     */
    public function countRoomsInCartByUserId(int $userId)
    {
        return $this->findById($userId)->rooms()->wherePivot('status_id', 1)->count();
    }
    /**
     * check unique email
     *
     * @param string $email
     * @return boolean
     */
    public function hasEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }
    /**
     * get all user of the room with table pivot status_id is processing
     *
     * @param integer $userId
     * @return collection
     */
    public function getCartRoomByUserId(int $userId)
    {
        return $this->model::find($userId)
            ->rooms()
            ->wherePivot('status_id', 1)
            ->with('images')
            ->orderBy('room_user.created_at', 'desc')
            ->paginate(5);
    }

    /**
     * get booking with status pending
     *
     * @param integer $userId
     * @return collection
     */
    public function getBookingPending(int $userId)
    {
        $user = $this->findById($userId);
        return $user->rooms()
            ->with('images')
            ->wherePivot('status_id', 2)
            ->orderBy('room_user.created_at', 'desc')
            ->paginate(5);
    }

    /**
     * get booking with status competed
     * @param integer $userId
     * @return collection
     */
    public function getBookingCompleted(int $userId)
    {
        $user = $this->findById($userId);
        return $user->rooms()
            ->with('images')
            ->wherePivot('status_id', 3)
            ->orderBy('room_user.created_at', 'desc')
            ->paginate(5);
    }

    /**
     * get booking with status canceled
     *
     * @param integer $userId
     * @return collection
     */
    public function getBookingCanceled(int $userId)
    {
        $user = $this->findById($userId);
        return $user->rooms()->with('images')->wherePivot('status_id', 4)->paginate(5);
    }
}
