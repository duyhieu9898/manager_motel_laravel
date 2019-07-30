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

    public function __construct(
        UserRepositoryInterface $userRepository,
        RoomRepositoryInterface $roomRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roomRepository = $roomRepository;
    }
    protected function addRoomToCart(Request $request, int $roomId)
    {
        $dataBooking = $request->except(['_token', 'book_now']);
        $dataBooking['room_id']=$roomId;
        $this->roomRepository->bookingProcessing(Auth::id(), $dataBooking);
    }
    protected function countRoomsInCart()
    {
        return $this->userRepository->countRoomsInCartByUserId(Auth::id());
    }
    protected function bookAndPay(Request $request, int $roomId)
    {
        $this->addRoomToCart($request, $roomId);
        return $this->cart();
    }
    protected function bookAddComeBackHome(Request $request, int $roomId)
    {
        $this->addRoomToCart($request, $roomId);
        return redirect('/');
    }
    public function booking(Request $request, int $roomId)
    {
        if ($request->has('book_now')) {
            return  $this->bookAndPay($request, $roomId);
        }
        return $this->bookAddComeBackHome($request, $roomId);
    }
    public function cart()
    {
        $rooms = $this->userRepository->getCartRoomByUserId(Auth::id());
        return view('cart', compact(['rooms']));
    }
    public function checkOut()
    {
        $this->userRepository->bookingPending(Auth::id());
        return redirect('/')->with('success', 'your booking success');
    }
}
