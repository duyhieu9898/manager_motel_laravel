<?php

namespace App\Http\Controllers;

use App\Repositories\Room\RoomRepositoryInterface;
use App\Traits\FullTextSearch;

class RoomController extends Controller
{
    use FullTextSearch;
    
    private $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function show($id)
    {
        $room = $this->roomRepository->findById($id)->load('images', 'convenients');
        return view('detail_room', compact('room'));
    }

    public function getByCategoryId(int $id)
    {
        $itemPerPage=8;
        $listRooms=$this->roomRepository->getByCategoryId($id, $itemPerPage);
        return view('category_rooms', compact('listRooms'));
    }
}
