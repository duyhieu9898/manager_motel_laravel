<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
     * return list users and roles
     *
     * @return collection
     */

    public function index()
    {
        $users = $this->userRepository->getAllUsersAndRoles();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $dataUser['api_token'] = hash('sha256', Str::random(60));
        $user = $this->userRepository->createUser($dataUser);
        $role = Role::where('name', $dataUser['role'])->first();
        $user->roles()->attach($role);
        return response('created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $dataUser = $request->input('userData');
        $this->userRepository->updateById($id, $dataUser['name'], $dataUser['email'], $dataUser['roles']);
        return response(
            [
                'result' => 'success',
                'role_id' => $dataUser['roles'],
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
