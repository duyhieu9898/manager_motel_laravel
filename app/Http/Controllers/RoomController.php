<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Convenient;
use App\StatusBooking;

class RoomController extends Controller
{

    private $roomRepository;
    private $categoryRepository;
    public function __construct(RoomRepositoryInterface $roomRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function create()
    {
        $rooms = $this->roomRepository->getAll()->load('category', 'address.province');
        return response()->json($rooms);
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
        // dd($newRoomsOfCategory);
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
        $room = $this->roomRepository->findById($id)->load('images', 'convenients');
        return view('detail_room', compact('room'));
    }
    public function edit($id)
    {
        $categories = $this->categoryRepository->getAll();
        $convenients = Convenient::get();
        $room = $this->roomRepository->findById($id)->load('convenients');
        $AllConvenientsId = $convenients->map(function ($item) {
            return $item['id'];
        });
        $arrListConvenientsId = $AllConvenientsId->all();
        $arrData=[
            'room' => $room,
            'categories' => $categories,
            'convenients' => $convenients,
            'arrListConvenientsId' => $arrListConvenientsId,
        ];
        return response()->json($arrData);
    }
    public function update(Request $request)
    {
        dd($request);
    }
}
