<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('room_user')
            ->select(
                'room_user.id as booking_id',
                'users.id as user_id',
                'users.name as user_name',
                'users.phone as user_phone',
                'users.email as user_email',
                'status_bookings.name as status_booking',
                DB::raw("DATE_FORMAT(room_user.created_at, '%H:%i:%s %d-%m-%Y') as date_booking"),
            )
            ->join('users', 'room_user.user_id', 'users.id')
            ->join('rooms', 'room_user.room_id', 'rooms.id')
            ->join('status_bookings', 'room_user.status_id', 'status_bookings.id')
            ->whereIn('room_user.status_id', [2, 3, 4])
            ->get();
        return response()->json(['booking' => $bookings], 200);
    }
    public function show($id)
    {
        $booking = DB::table('room_user')
            ->select(
                'room_user.id as booking_id',
                'room_user.peoples as tenants',
                'room_user.arrival_date as arrival_date',
                'room_user.departure_date as departure_date',
                'users.id as user_id',
                'users.name as user_name',
                'users.phone as user_phone',
                'users.email as user_email',
                'rooms.id as room_id',
                'rooms.title as room_title',
                'rooms.room_area as room_area',
                'rooms.price as room_price',
                'rooms.number_peoples as room_peoples',
                'rooms.maximum_peoples_number as room_people_max',
                'images.file_name as room_image_link',
                'provinces.name as room_province',
                'status_bookings.name as status_booking',
                'room_user.created_at as date_booking'
            )
            ->join('users', 'room_user.user_id', 'users.id')
            ->join('rooms', 'room_user.room_id', 'rooms.id')
            ->join('addresses', 'rooms.address_id', 'addresses.id')
            ->join('provinces', 'addresses.province_id', 'provinces.id')
            ->join('status_bookings', 'room_user.status_id', 'status_bookings.id')
            ->join('images', 'rooms.id', 'images.room_id')
            ->where('room_user.id', $id)
            ->whereIn('room_user.status_id', [2, 3, 4])
            ->first();
        return response()->json(['booking' => $booking], 200);
    }
    public function getBookingByUserId(Request $request, int $userId)
    {
        $booking = DB::table('room_user')
            ->select(
                'room_user.id as booking_id',
                'users.id as user_id',
                'users.name as user_name',
                'users.phone as user_phone',
                'users.email as user_email',
                'rooms.id as room_id',
                'rooms.title as room_tile',
                'rooms.room_area as room_area',
                'rooms.price as room_price',
                'rooms.number_peoples as room_peoples',
                'rooms.maximum_peoples_number as room_people_max',
                'status_bookings.name as status_booking',
                'room_user.created_at as date_booking'
            )
            ->join('users', 'room_user.user_id', 'users.id')
            ->join('rooms', 'room_user.room_id', 'rooms.id')
            ->join('status_bookings', 'room_user.status_id', 'status_bookings.id')
            ->where('room_user.user_id', $userId)
            ->get();
        return response()->json(['booking' => $booking], 200);
    }
    public function updateStatus(Request $request, $bookingId)
    {
        $status = DB::table('status_bookings')->select('id')->where('name', $request->status_name)->first();
        DB::table('room_user')->where('room_user.id', $bookingId)->update(['status_id' => $status->id]);
        return Response()->json(['message'=>'update status success'], 200);
    }

    public function destroy($id)
    {
        DB::table('room_user')->where('room_user.id', $id)->delete();
        return Response()->json(['message'=>'delete booking success'], 200);
    }
}
