<?php

namespace App\Http\Controllers;

use App\Repositories\Room\RoomRepositoryInterface;

class HomeController extends Controller
{
    private $roomRepository;
    private $itemRoom = 9;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roomsNewsCreate = $this->roomRepository->getNewCreate($this->itemRoom);
        return view('index', compact(['roomsNewsCreate']));
    }
}
