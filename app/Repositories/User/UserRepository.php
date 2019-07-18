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

    public function createUser($dataUser)
    {
        $user = new User();
        $user->name = $dataUser['name'];
        $user->email = $dataUser['email'];
        $user->password = bcrypt($dataUser['password']);
        $user->api_token = $dataUser['api_token'];
        $user->save();
        return $user;
    }

    public function updateById($id, $userName, $userEmail, $roles)
    {
        $user = $this->findById($id);
        $user->name = $userName;
        $user->email = $userEmail;
        $user->save();
        $user->roles()->detach();
        //get array role_id user from client
        foreach ($roles as $role) {
            $rolesId[] = $role['id'];
        }
        $user->roles()->attach($rolesId);
    }
    public function deleteById($id)
    {
        $user = $this->findById($id);
        $user->roles()->detach();
        $user->delete();
    }
}
