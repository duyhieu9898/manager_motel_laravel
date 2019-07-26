<?php

namespace App\Http\Controllers;

use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class RoomController extends Controller
{
    private $roomRepository;
    private $categoryRepository;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function latest()
    {
        $numItem=3;
        $newRoomsOfCategory = $this->categoryRepository->getNewRoomsOfAllCategories($numItem);
        return view('index', compact(['newRoomsOfCategory']));
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

    public function booking($id)
    {
        $room = $this->roomRepository->findById($id);
        return view('booking_rooms', compact('room'));
    }
}
