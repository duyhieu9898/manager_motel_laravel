<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Events\RedisEvent;

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

    //check
    protected function countRoomsInCart()
    {
        return $this->userRepository->countRoomsInCartByUserId(Auth::id());
    }

    protected function bookAndPay(Request $request, int $roomId)
    {
        $this->addRoomToCart($request, $roomId);
        return redirect('/cart');
    }

    protected function bookAddComeBackHome(Request $request, int $roomId)
    {
        $this->addRoomToCart($request, $roomId);
        return redirect('/');
    }

    /**
     * handle redirect after booking
     *
     * @param Request $request
     * @param integer $roomId
     * @return Response
     */
    public function booking(Request $request, int $roomId)
    {
        if ($request->has('book_now')) {
            return  $this->bookAndPay($request, $roomId);
        }
        return $this->addRoomToCart($request, $roomId);
    }

    /**
     * get room booking with status pending
     *
     * @return void
     */
    public function cart()
    {
        $rooms = $this->userRepository->getCartRoomByUserId(Auth::id());
        return view('cart', compact(['rooms']));
    }

    /**
     * update status processing to pending
     *
     * @return Response
     */
    public function checkOut()
    {
        $this->userRepository->bookingPending(Auth::id());
        event(new RedisEvent(Auth::id(), "message_example"));
        return redirect('/cart')->with('booking-success', 'your booking success');
    }

    /**
     * get room order of the user
     *
     * @return Response
     */
    public function bookingOfUser()
    {
        $roomsPending = $this->userRepository->getBookingPending(Auth::id());

        $roomsCompleted = $this->userRepository->getBookingCompleted(Auth::id());
        $roomsCanceled = $this->userRepository->getBookingCanceled(Auth::id());
        return view('order_room', compact(['roomsPending', 'roomsCompleted', 'roomsCanceled']));
    }
}
