<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Repositories\Notification\NotificationRepositoryInterface;

class NotificationController extends Controller
{
    private $notification;

    public function __construct(NotificationRepositoryInterface $notification)
    {
        $this->notification = $notification;
    }

    public function sent(Request $request)
    {
        //$this->notification->create($request->all());
        //$data['user_id'] = $request->input('user_id');
        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');


        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            ]
        );

        $pusher->trigger('Notify', 'send-message', $data);

        return redirect('/send');
    }
}
