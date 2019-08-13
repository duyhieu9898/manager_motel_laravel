<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use LRedis;

class SocketController extends Controller
{
    public function index()
    {
        return view('socket');
    }

    public function writeMessage()
    {
        return view('write_message');
    }

    public function sendMessage()
    {
        LRedis::set('name', 'Taylor');


        dd(LRedis::publish('message', "ngon"));
        $redis = LRedis::connection();
        $redis->publish('message55', Request::input('message'));

        return redirect('write-message');
    }
}
