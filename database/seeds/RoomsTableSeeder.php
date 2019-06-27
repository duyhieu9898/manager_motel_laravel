<?php

use App\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		$listIdConvenient = DB::table('convenients')->pluck('id');
		$room = new Room();
		$room->id = 1;
		$room->title = "Phòng trọ và giường KTX Đường số 1 Phạm Hùng";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 1;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 12;
		$room->price = 100000;
		$room->maximum_peoples_number = 3;
		$room->status_booking_id = 1;
		$room->address_id = 1;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 2;
		$room->title = "Phòng trọ no 2";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 1;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 12;
		$room->price = 100000;
		$room->maximum_peoples_number = 3;
		$room->status_booking_id = 1;
		$room->address_id = 2;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 3;
		$room->title = "Phòng trọ no 3";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 1;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 12;
		$room->price = 100000;
		$room->maximum_peoples_number = 3;
		$room->status_booking_id = 1;
		$room->address_id = 3;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 4;
		$room->title = "Phòng trọ no 4";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 1;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 12;
		$room->price = 100000;
		$room->maximum_peoples_number = 3;
		$room->status_booking_id = 1;
		$room->address_id = 4;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 5;
		$room->title = "Nhà nguyên căn Nguyễn Biểu 1";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 2;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 14;
		$room->price = 150000;
		$room->maximum_peoples_number = 2;
		$room->status_booking_id = 1;
		$room->address_id = 5;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 6;
		$room->title = "Nhà nguyên căn Nguyễn Biểu 2";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 2;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 14;
		$room->price = 150000;
		$room->maximum_peoples_number = 2;
		$room->status_booking_id = 1;
		$room->address_id = 6;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 7;
		$room->title = "Nhà nguyên căn Nguyễn Biểu 3";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 2;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 14;
		$room->price = 150000;
		$room->maximum_peoples_number = 2;
		$room->status_booking_id = 1;
		$room->address_id = 7;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 8;
		$room->title = "Căn hộ đường Nguyễn Đình Chiểu 1";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 3;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 16;
		$room->price = 180000;
		$room->maximum_peoples_number = 1;
		$room->status_booking_id = 1;
		$room->address_id = 8;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 9;
		$room->title = "Căn hộ đường Nguyễn Đình Chiểu 2";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 3;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 16;
		$room->price = 180000;
		$room->maximum_peoples_number = 1;
		$room->status_booking_id = 1;
		$room->address_id = 9;
		$room->save();
		$room->convenients()->attach($listIdConvenient);

		$room = new Room();
		$room->id = 10;
		$room->title = "Căn hộ đường Nguyễn Đình Chiểu 3";
		$room->description = 'Tòa nhà gồm 1 trệt, 3 lầu, có 3 phòng và 16 giường ở ghếp cho thuê.';
		$room->category_id = 3;
		$room->police_and_terms = 'Khách thuê giường ở ghép thì đã bao gồm tất cả chi phí.';
		$room->room_area = 16;
		$room->price = 180000;
		$room->maximum_peoples_number = 1;
		$room->status_booking_id = 1;
		$room->address_id = 10;
		$room->save();
		$room->convenients()->attach($listIdConvenient);
	}
}
