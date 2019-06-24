<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		$role_customer = Role::where('name', 'customer')->first();
		$role_owner = Role::where('name', 'owner')->first();
		$role_manager = Role::where('name', 'admin')->first();

		$customer = new User();
		$customer->name = 'customer Name';
		$customer->email = 'customer@example.com';
		$customer->password = bcrypt('123456');
		$customer->save();
		$customer->roles()->attach($role_customer);

		$owner = new User();
		$owner->name = 'owner Name';
		$owner->email = 'owner@example.com';
		$owner->password = bcrypt('123456');
		$owner->save();
		$owner->roles()->attach($role_owner);

		$manager = new User();
		$manager->name = 'Admin Name';
		$manager->email = 'admin@example.com';
		$manager->password = bcrypt('123456');
		$manager->save();
		$manager->roles()->attach($role_manager);
	}
}
