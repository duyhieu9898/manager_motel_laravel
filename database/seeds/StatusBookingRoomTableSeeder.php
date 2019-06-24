<?php

use App\StatusBookingRoom;
use Illuminate\Database\Seeder;

class StatusBookingRoomTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//

		$processing = new StatusBookingRoom();
		$processing->id = 1;
		$processing->name = "processing";
		$processing->save();

		$pending = new StatusBookingRoom();
		$pending->id = 2;
		$pending->name = "pending";
		$pending->save();

		$cancelled = new StatusBookingRoom();
		$cancelled->id = 3;
		$cancelled->name = "cancelled";
		$cancelled->save();

		$completed = new StatusBookingRoom();
		$completed->id = 4;
		$completed->name = "completed";
		$completed->save();
	}
}
