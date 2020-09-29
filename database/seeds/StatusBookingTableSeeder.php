<?php

use App\StatusBooking;
use Illuminate\Database\Seeder;

class StatusBookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $pending = new StatusBooking();
        $pending->id = 1;
        $pending->name = "processing";
        $pending->save();

        $completed = new StatusBooking();
        $completed->id = 2;
        $completed->name = "pending";
        $completed->save();

        $cancelled = new StatusBooking();
        $cancelled->id = 3;
        $cancelled->name = "completed";
        $cancelled->save();

        $cancelled = new StatusBooking();
        $cancelled->id = 4;
        $cancelled->name = "cancelled";
        $cancelled->save();
    }
}
