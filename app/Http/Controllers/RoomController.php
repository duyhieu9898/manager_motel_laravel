<?php

namespace App\Http\Controllers;

use Mail;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Convenient;
use App\StatusBookingRoom;

class RoomController extends Controller
{

    private $roomRepository;
    private $categoryRepository;
    private $statusBookingRoomRepository;
    public function __construct(RoomRepositoryInterface $roomRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function create()
    {
        return view("admin.admin-rooms");
    }
    public function latest()
    {
        # code...
        //$category = Category::ofName('house')->first()->rooms;//lazy loading
        //$category = Category::ofName('house')->first()->load('rooms'); //Lazy Eager Loading
        //$category = Category::with('rooms')->get(); //eager loading

        //Get 3 rooms in all category
        // $categories = Category::with(
        //     [
        //         'rooms.address',
        //         'rooms.images',
        //         'rooms' => function ($query) {
        //             $query->limit(3);
        //         },
        //     ]
        // )->get();
        $categoryList = $this->categoryRepository->getAll();
        $newRoomsOfCategory = $this->categoryRepository->getNewRoomsOfCategory($categoryList);
        return view('index', compact(['categoryList', 'newRoomsOfCategory']));
    }
    public function sendEmail()
    {

        Mail::send('home', ['user' => "hieu"], function ($m) {
            $m->from('duyhieu9898@gmail.com', 'LARAVEL MAIL');

            $m->to('duyhieu9898@gmail.com', "data-name")->subject('cai lon gi the!');
        });
    }
    public function show($id)
    {
        $room = $this->roomRepository->findById($id);
        return view('detail-room', compact('room'));
    }
    public function getAll()
    {
        $rooms = $this->roomRepository->getAll();
        return view('admin.all-rooms', compact('rooms'));
    }
    public function edit($id)
    {
        $categories = $this->categoryRepository->getAll();
        $convenients = Convenient::get();
        $statusRoom = StatusBookingRoom::get();
        $room = $this->roomRepository->findById($id);
        $arrAllConvenientsId = $convenients->map(function ($item) {
            return $item['id'];
        });

        return view(
            'admin.edit-room-detail',
            compact(
                'room',
                'categories',
                'statusRoom',
                'convenients',
                'arrAllConvenientsId'
            )
        );
    }
    public function update(Request $request)
    {
        dd($request);
    }
}
