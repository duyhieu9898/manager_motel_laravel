<?php
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
        $numberRoom = 300;
        factory(App\Address::class, $numberRoom)->create();
    }

}
