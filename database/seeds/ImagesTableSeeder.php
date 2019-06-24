<?php

use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $image = new Image;
        $image->id = 1;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/motel-1.jpg";
        $image->room_id = 1;
        $image->save();

        $image = new Image;
        $image->id = 2;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/motel-2.jpg";
        $image->room_id = 1;
        $image->save();

        $image = new Image;
        $image->id = 3;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/hinh5.png";
        $image->room_id = 2;
        $image->save();

        $image = new Image;
        $image->id = 4;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/hinh5.png";
        $image->room_id = 3;
        $image->save();

        $image = new Image;
        $image->id = 5;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/hinh5.png";
        $image->room_id = 4;
        $image->save();

        $image = new Image;
        $image->id = 6;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/house-1.jpg";
        $image->room_id = 5;
        $image->save();

        $image = new Image;
        $image->id = 7;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/apartment-1.jpg";
        $image->room_id = 6;
        $image->save();

        $image = new Image;
        $image->id = 8;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/apartment-1.jpg";
        $image->room_id = 7;
        $image->save();

        $image = new Image;
        $image->id = 9;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/apartment-1.jpg";
        $image->room_id = 8;
        $image->save();

        $image = new Image;
        $image->id = 10;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/apartment-1.jpg";
        $image->room_id = 9;
        $image->save();

        $image = new Image;
        $image->id = 11;
        $image->original_name = "image 1";
        $image->slug = "motel-1.jpg";
        $image->file_name = "/images/apartment-1.jpg";
        $image->room_id = 10;
        $image->save();
    }
}
