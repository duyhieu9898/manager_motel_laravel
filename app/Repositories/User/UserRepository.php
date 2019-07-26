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
    public function getAllUsersAndRoles()
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
        $result = $user->delete();
        return $result;
    }
}
