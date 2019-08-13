<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mothCurrent = Carbon::now()->month;
        $yearCurrent = Carbon::now()->year;

        $totalRoom =  DB::table('rooms')->count();
        $totalUser =  DB::table('users')->count();
        $totalEarningMonth = DB::table('rooms')
            ->join('room_user', 'rooms.id', 'room_user.id')
            ->where('status_id', '!=', 1)
            ->whereYear('room_user.created_at', $yearCurrent)
            ->whereMonth('room_user.created_at', $mothCurrent)
            ->sum('price');
        $totalBooking = DB::table('room_user')
            ->where('status_id', '==', 2)
            ->count();



        $listBookDay = DB::table('room_user')
            ->selectRaw('count(id) as totalBook, DAY(created_at) as day')
            ->whereYear('created_at', $yearCurrent)
            ->whereMonth('created_at', $mothCurrent)
            ->where('status_id', '!=', 1)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();
        $arrTotals = [
            'total_room' => $totalRoom,
            'total_user' => $totalUser,
            'totalBooking' => $totalBooking,
            'list_book_day' => $listBookDay,
            'total_earning_month' => $totalEarningMonth
        ];
        return response()->json($arrTotals, 200);
    }
}
