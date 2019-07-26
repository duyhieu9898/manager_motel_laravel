<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Room\RoomRepositoryInterface;

class BookingController extends Controller
{
    private $userRepository;
    private $roomRepository;


    public function __construct(UserRepositoryInterface $userRepository, RoomRepositoryInterface $roomRepository)
    {
        $this->userRepository = $userRepository;
        $this->roomRepository = $roomRepository;
    }
    public function store(Request $request, int $roomId)
    {
        // $numPeople = $request->people;
        $userId = Auth::id();
        $user = $this->userRepository->findById($userId);
        //
        $user->rooms()->attach($roomId, ['status_id' => 1]);
        $this->roomRepository->people($roomId, $numPleoples = 1);
        return redirect('/')->with('success', 'your booking success');
    }
}
