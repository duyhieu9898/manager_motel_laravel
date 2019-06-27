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

        $processing = new StatusBooking();
        $processing->id = 1;
        $processing->name = "processing";
        $processing->save();

        $pending = new StatusBooking();
        $pending->id = 2;
        $pending->name = "pending";
        $pending->save();

        $cancelled = new StatusBooking();
        $cancelled->id = 3;
        $cancelled->name = "cancelled";
        $cancelled->save();

        $completed = new StatusBooking();
        $completed->id = 4;
        $completed->name = "completed";
        $completed->save();
    }
}
