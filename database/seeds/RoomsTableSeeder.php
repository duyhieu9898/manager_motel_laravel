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
        $textListDemo="<ul>
        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
        <li>Nam aliquet metus sed dolor accumsan, eget consequat est semper.</li>
        <li>Integer convallis ipsum sit amet vehicula consequat.</li>
        <li>Praesent non nibh egestas, bibendum orci quis, elementum felis.</li>
        <li>Nam et sem ac turpis varius facilisis ut id mauris.</li>
        </ul>";
        $paragraphs="<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Donec tincidunt fermentum libero non viverra. Maecenas sit amet imperdiet elit.
        Sed non elementum augue, et tincidunt nulla.
        Vestibulum pellentesque ex ex, et laoreet tortor elementum sed. Etiam ac sollicitudin arcu.
        Suspendisse erat justo, luctus et cursus in, gravida vel velit.
        Maecenas vehicula vestibulum elit, in iaculis nisi pharetra at. Duis non libero velit.
        Quisque ultrices nulla a viverra faucibus. Mauris ac tellus tortor.
        Aliquam nec rutrum diam, sed elementum arcu. Mauris pulvinar ligula id vulputate condimentum.
        Quisque ut dui a turpis congue molestie. Cras bibendum vestibulum sodales.
        In hac habitasse platea dictumst.</p>";

        for ($i = 1; $i <= 100; $i++) {
            Room::create([
            'title' => "Room no {$i}",
            'description' => $paragraphs,
            'category_id' => 1,
            'police_and_terms' => $textListDemo,
            'room_area' => 10,
            'price' => 12345678,
            'maximum_peoples_number'=>2,
            'address_id' => $i
            ]);
        }

        for ($i = 101; $i <= 200; $i++) {
            Room::create([
            'title' => "Room no {$i}",
            'description' => $paragraphs,
            'category_id' => 2,
            'police_and_terms' => $textListDemo,
            'room_area' => 10,
            'price' => 12345678,
            'maximum_peoples_number'=>2,
            'address_id' => $i
            ]);
        }

        for ($i = 201; $i <= 300; $i++) {
            Room::create([
            'title' => "Room no {$i}",
            'description' => $paragraphs,
            'category_id' => 3,
            'police_and_terms' => $textListDemo,
            'room_area' => 10,
            'price' => 12345678,
            'maximum_peoples_number'=>2,
            'address_id' => $i
            ]);
        }
    }
}
