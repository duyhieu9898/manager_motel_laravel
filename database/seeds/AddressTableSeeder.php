<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		$address = new Address;
		$address->id = 1;
		$address->apartment_number = "19";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 1;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 2;
		$address->apartment_number = "20";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 2;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 3;
		$address->apartment_number = "21";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 3;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 4;
		$address->apartment_number = "22";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 4;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 5;
		$address->apartment_number = "23";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 5;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 6;
		$address->apartment_number = "24";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 6;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 7;
		$address->apartment_number = "24";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 7;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 8;
		$address->apartment_number = "24";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 8;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 9;
		$address->apartment_number = "24";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 9;
		$address->address_type = 'App\Room';
		$address->save();

		$address = new Address;
		$address->id = 10;
		$address->apartment_number = "24";
		$address->street = "Quang trung";
		$address->ward = "Bach ha";
		$address->district = "Phu xuyen";
		$address->provincial = "Ha noi";
		$address->address_id = 10;
		$address->address_type = 'App\Room';
		$address->save();
	}
}
