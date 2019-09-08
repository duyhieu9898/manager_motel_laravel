<?php

use App\Convenient;
use Illuminate\Database\Seeder;

class ConvenientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $convenient = new Convenient;
        $convenient->id = 1;
        $convenient->name = "phòng khách";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 2;
        $convenient->name = "phòng ngủ";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 3;
        $convenient->name = "phòng bếp";

        $convenient->save();
        $convenient = new Convenient;
        $convenient->id = 4;
        $convenient->name = "phòng tắm";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 5;
        $convenient->name = "phòng vệ sinh";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 6;
        $convenient->name = "phòng ăn";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 7;
        $convenient->name = "tivi";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 8;
        $convenient->name = "tủ lạnh";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 9;
        $convenient->name = "điều hòa";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 10;
        $convenient->name = "máy giặt";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 11;
        $convenient->name = "quạt cây";
        $convenient->save();

        $convenient = new Convenient;
        $convenient->id = 12;
        $convenient->name = "wifi";
        $convenient->save();
    }
}
