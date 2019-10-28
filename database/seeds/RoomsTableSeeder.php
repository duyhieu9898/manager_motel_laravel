<?php

use App\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $fakerVN = \Faker\Factory::create('vi_VN');
        $textListDemo="<ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
            <li>Nam aliquet metus sed dolor accumsan, eget consequat est semper.</li>
            <li>Integer convallis ipsum sit amet vehicula consequat.</li>
            <li>Praesent non nibh egestas, bibendum orci quis, elementum felis.</li>
            <li>Nam et sem ac turpis varius facilisis ut id mauris.</li>
        </ul>";
        $paragraphs= $fakerVN->words($nb = 50, $asText = true);
        $listIdConvenience = DB::table('conveniences')->pluck('id');
        for ($i = 1; $i <= 300; $i++) {
            $categoryId = rand(1, 3);
            if ($categoryId == 1) {
                $categoryName = "Motel";
            } elseif ($categoryId == 2) {
                $categoryName = "House";
            } else {
                $categoryName = "Apartment";
            }
            $id=Room::create([
                'title' => "Room {$categoryName} No  {$i}",
                'description' => $paragraphs,
                'category_id' => $categoryId,
                'police_and_terms' => $textListDemo,
                'room_area' => rand(10, 50),
                'price' => rand(5, 20)*100000,
                'maximum_peoples_number'=>rand(1, 10),
                'address_id' => $i
            ])->id;
            $room=Room::find($id);
            $room->conveniences()->attach($listIdConvenience);
        }
    }
}
