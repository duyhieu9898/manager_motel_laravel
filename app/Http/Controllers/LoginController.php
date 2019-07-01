<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Validator;

class LoginController extends Controller
{
    //
    public function getlogin()
    {
        return view('auth.login');
    }
    public function postlogin(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'Require|min:6|max:16',
                'email' => 'email',
                //function.php@checkPass
                'password' => 'min:6',
            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
                'email' => ':attribute Không phải là emall',

            ],
            [
                'name' => 'Tên',
                'password' => 'Mật khẩu',
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->intended('/');
            } else {
                $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']); //use view {{Session::get('MessageBag')}}

                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }
    public function postLogout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
