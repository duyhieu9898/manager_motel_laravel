<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $address = new Address;
        $address->id = 1;
        $address->street = "19 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 2;
        $address->street = "20 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";


        $address->save();

        $address = new Address;
        $address->id = 3;
        $address->street = "21 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 4;
        $address->street = "22 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 5;
        $address->street = "23 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 6;
        $address->street = "24 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 7;
        $address->street = "25 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 8;
        $address->street = "26 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 9;
        $address->street = "27 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";

        $address->save();

        $address = new Address;
        $address->id = 10;
        $address->street = "28 Quang trung";
        $address->ward = "Bach ha";
        $address->district = "Phu xuyen";
        $address->city = "Ha noi";


        $address->save();
    }
}
