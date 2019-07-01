<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $motel = new Category();
        $motel->id = 1;
        $motel->name = "motel";
        $motel->save();

        $house = new Category();
        $house->id = 2;
        $house->name = "house";
        $house->save();

        $apartment = new Category();
        $apartment->id = 3;
        $apartment->name = "apartment";
        $apartment->save();
    }
}
