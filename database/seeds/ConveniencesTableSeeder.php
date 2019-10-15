<?php

use App\Convenience;
use Illuminate\Database\Seeder;

class ConveniencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $convenience = new Convenience;
        $convenience->id = 1;
        $convenience->name = "phòng khách";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 2;
        $convenience->name = "phòng ngủ";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 3;
        $convenience->name = "phòng bếp";

        $convenience->save();
        $convenience = new Convenience;
        $convenience->id = 4;
        $convenience->name = "phòng tắm";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 5;
        $convenience->name = "phòng vệ sinh";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 6;
        $convenience->name = "phòng ăn";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 7;
        $convenience->name = "tivi";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 8;
        $convenience->name = "tủ lạnh";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 9;
        $convenience->name = "điều hòa";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 10;
        $convenience->name = "máy giặt";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 11;
        $convenience->name = "quạt cây";
        $convenience->save();

        $convenience = new Convenience;
        $convenience->id = 12;
        $convenience->name = "wifi";
        $convenience->save();
    }
}
