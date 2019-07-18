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
        for ($i = 1; $i <= 300; $i++) {
            Address::create([
                'street' => "{$i} Quang trung",
                'ward_id' => '00001',
                'district_id' => '001',
                'province_id' => '01'
            ]);
        }
    }
}
