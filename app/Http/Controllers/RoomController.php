<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Requests\RoomEditRequest;
use App\Http\Requests\RoomCreateRequest;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Convenient\ConvenientRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\MessageBag;

class RoomController extends Controller
{
    private $roomRepository;
    private $categoryRepository;
    private $convenientRepository;
    private $imageRepository;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        CategoryRepositoryInterface $categoryRepository,
        ConvenientRepositoryInterface $convenientRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
        $this->convenientRepository = $convenientRepository;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $rooms = $this->roomRepository->getAll()->load('category', 'address.province');
        return response()->json($rooms);
    }

    public function latest()
    {
        $categoryList       = $this->categoryRepository->getAll();
        $newRoomsOfCategory = $this->categoryRepository->getNewRoomsOfCategory($categoryList);
        return view('index', compact(['categoryList', 'newRoomsOfCategory']));
    }

    public function show($id)
    {
        $room = $this->roomRepository->findById($id)->load('images', 'convenients');
        return view('detail_room', compact('room'));
    }

    public function create()
    {
        $listCategory   = $this->categoryRepository->getAll();
        $listConvenient = $this->convenientRepository->getAll();
        return response()->json(['convenients' => $listConvenient, 'categories' => $listCategory]);
    }

    public function store(RoomCreateRequest $request)
    {
        $dataRoom = $request->all();
        if ($request->filled('name')) {
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']); //use view {{Session::get('MessageBag')}}

            return redirect()->withErrors($errors);
        }
        $roomId=$this->roomRepository->create($dataRoom);
        if ($roomId) {
            $this->imageRepository->setImagesToRoom($dataRoom['list_images_id'], $roomId);
            return response(204);
        }
        return response(400);
    }

    public function edit($id)
    {
        $categories       = $this->categoryRepository->getAll();
        $convenients      = $this->convenientRepository->getAll();
        $room             = $this->roomRepository->findById($id)->load('convenients');
        $AllConvenientsId = $room->convenients->map(function ($item) {
            return $item['id'];
        });
        $arrListConvenientsId = $AllConvenientsId->all();
        $arrData = [
            'room'                 => $room,
            'categories'           => $categories,
            'convenients'          => $convenients,
            'arrListConvenientsId' => $arrListConvenientsId,
        ];
        return response()->json($arrData);
    }

    public function update(RoomEditRequest $request, $id)
    {
        $dataRoom = $request->all();
        $room     = $this->roomRepository->findById($id);
        $result   = $this->roomRepository->update($room, $dataRoom);
        if ($result) {
            return response('success', 204);
        }
    }

    public function sendEmail()
    {
        Mail::send('home', ['user' => "hieu"], function ($m) {
            $m->from('duyhieu9898@gmail.com', 'LARAVEL MAIL');

            $m->to('duyhieu9898@gmail.com', "data-name")->subject('cai lon gi the!');
        });
    }
}
