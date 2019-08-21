<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BookingService;

class BookingController extends Controller
{
    private $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService=$bookingService;
    }
    /**
     * get list room_user
     *
     * @return Response
     */
    public function index()
    {
        $bookings = $this->bookingService->getBookings();
        if (!$bookings) {
            return response()->json([
                'message'=> 'Server error while get list booking ',
            ], 500);
        }
        return response()->json(['booking' => $bookings], 200);
    }

    /**
     * get room_user by id
     *
     * @param integer $id
     * @return Response
     */
    public function show(int $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        if (!$booking) {
            return response()->json([
                'message'=> 'Server error while get booking ',
            ], 500);
        }

        return response()->json(['booking' => $booking], 200);
    }

    /**
     * get room_user by user id
     *
     * @param Request $request
     * @param integer $userId
     * @return Response
     */
    public function getBookingByUserId(int $userId)
    {
        $booking = $this->bookingService->getBookingByUserId($userId);
        if (!$booking) {
            return response()->json([
                'message'=> 'Server error while get booking by user id',
            ], 500);
        }
        return response()->json(['booking' => $booking], 200);
    }

    /**
     * update status_booking of the room_user by by id_status
     *
     * @param Request $request
     * @param integer $bookingId
     * @return Response
     */
    public function updateStatus(Request $request, int $bookingId)
    {
        $nameStatus = $request->name;
        
        if ($this->bookingService->updateStatusById($bookingId, $nameStatus)) {
            return response()->json([
                'message'=> 'Server error while update status booking',
            ], 500);
        }

        return Response()->json(['message'=>'update status success'], 200);
    }
    /**
     * delete room_user by id
     *
     * @param [type] $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->bookingService->deleteById($id)) {
            return Response()->json(['message'=>'delete booking success'], 200);
        }
        return Response()->json(['message'=>'error while delete  booking'], 500);
    }
}
