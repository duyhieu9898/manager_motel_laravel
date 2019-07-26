<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $booking = DB::table('room_user')
            ->select(
                'room_user.id',
                'users.name as user_name',
                'users.phone as user_phone',
                'users.email as user_email',
                'rooms.title as room_title',
                'status_bookings.name as status_booking',
                'room_user.created_at',
                'room_user.updated_at'
            )
            ->join('users', 'room_user.user_id', 'users.id')
            ->join('rooms', 'room_user.room_id', 'rooms.id')
            ->join('status_bookings', 'room_user.status_id', 'status_bookings.id')
            ->get();
        return response()->json(['booking' => $booking], 200);
    }
}
