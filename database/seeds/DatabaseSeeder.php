<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(StatusBookingTableSeeder::class);
        $this->call(ConveniencesTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
