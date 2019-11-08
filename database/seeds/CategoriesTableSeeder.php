<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $motel = new Category();
        $motel->id = 1;
        $motel->name = "Phòng đơn";
        $motel->save();

        $house = new Category();
        $house->id = 2;
        $house->name = "Phòn đôi";
        $house->save();

        $apartment = new Category();
        $apartment->id = 3;
        $apartment->name = "Phòng gia đình";
        $apartment->save();
    }
}
