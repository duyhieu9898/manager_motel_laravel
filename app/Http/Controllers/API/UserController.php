<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userRepository->getUsersWithRoles();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $dataUser = $request->only(['name', 'email', 'phone']);
        //check isset user by email
        if ($this->userRepository->hasEmail($dataUser['email'])) {
            return response()->json(['message' => 'email already exists'], 500);
        }
        //if is admin then create token
        if ($request->role == 'admin') {
            $dataUser['api_token'] = hash('sha256', Str::random(60));
        }
        //store
        $userId = $this->userRepository->createUser($dataUser);
        if (!$userId) {
            return response()->json(['message' => 'error create user'], 500);
        }
        //role
        $user = $this->userRepository->findById($userId);
        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role);

        return response()->json(['message' => 'created user', "userId" => $userId], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $dataUser = $request->only(['name', 'email', 'phone', 'address_id']);
        //check isset user by email
        if ($this->userRepository->findById($id)->email != $dataUser['email']) {
            if ($this->userRepository->hasEmail($dataUser['email'])) {
                return response()->json(['message' => 'email already exists'], 500);
            }
        }
        //update
        $user = $this->userRepository->updateById($id, $dataUser);
        if (!$user) {
            return response()->json(['message' => 'error update user'], 500);
        }
        //role
        if ($request->has($request->roleId)) {
            $user->roles()->sync($request->roleId);
        }

        return response(['message' => 'update user success'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->deleteById($id);
        return response(['message' => 'success'], 204);
    }

    public function getListUserOtherMe()
    {
        return User::orderBy('name')->where('id', '!=', auth()->user()->id)->get();
    }

    public function fullTextSearch($value)
    {
        $user = $this->userRepository->fullTextSearch($value);

        if (count($user) != 0) {
            return response()->json($user, 200);
        }
    }

    public function fuzzySearch($value)
    {
        $user = $this->userRepository->fuzzySearch($value);
        
        if (count($user) != 0) {
            return response()->json($user, 200);
        }
    }
}
