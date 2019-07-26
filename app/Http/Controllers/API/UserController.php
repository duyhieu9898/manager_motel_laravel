<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Repositories\User\UserRepositoryInterface;
use App\Role;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'user.name' => 'required|min:8|max:16',
                'user.email' => 'required|email',
                'user.role' => 'required|exists:roles,name',
            ],
            [
                'required' => 'Name is a required field',
                'min' => 'The password must be at least :min characters',
                'max' => 'The password must be at most :max characters.',
                'email' => 'email Invalid ',
                'exists' => ":attribute not exists"
            ]
        );
        $dataUser = $request->input('user');
        $dataUser['password'] = 123456;
        if ($dataUser['role']== 'admin') {
            $dataUser['api_token'] = hash('sha256', Str::random(60));
        }
        $user = $this->userRepository->createUser($dataUser);
        if (!$user) {
            return response()->json(['message' => 'error create user'], 500);
        }
        $role = Role::where('name', $dataUser['role'])->first();
        $user->roles()->attach($role);
        return response()->json(['message' => 'created user'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'user.name' => 'required|min:8|max:16',
                'user.email' => 'required|email',
                'user.roles' => 'required',
                'user.phone' => 'required|string|min:10|max:10'
            ],
            [
                'required' => 'Name is a required field',
                'min' => 'The Name must be at least :min characters',
                'max' => 'The Name must be at most :max characters.',
                'email' => 'email Invalid ',
                'exists' => ":attribute not exists"
            ]
        );
        $dataUser = $request->input('user');
        // $user        = $this->userRepository->findById($id);
        // $user->name  = $dataUser['name'];
        // $user->email = $dataUser['email'];
        // $user->phone = $dataUser['phone'];
        // $user->save();
        $this->userRepository->updateById($id, $dataUser);
        $user = $this->userRepository->updateById($id, $dataUser);
        if (!$user) {
            return response()->json(['message' => 'error update user'], 500);
        }
        $role = Role::where('name', $dataUser['roles'][0]['name'])->first();
        $user->roles()->detach();
        $user->roles()->attach($role);
        return response(
            [
                'result' => 'success',
                'role_id' => $user,
            ],
            200
        );
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
        return response(['result' => 'success', 200]);
    }
}
