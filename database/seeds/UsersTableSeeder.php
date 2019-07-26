<?php

use App\Role;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_customer = Role::where('name', 'customer')->first();
        $role_owner = Role::where('name', 'owner')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $customer = new User();
        $customer->name = 'customer Name';
        $customer->email = 'customer@example.com';
        $customer->password = bcrypt('123456');
        $customer->phone = '0366025756';
        $customer->save();
        $customer->roles()->attach($role_customer);

        $owner = new User();
        $owner->name = 'owner Name';
        $owner->email = 'owner@example.com';
        $owner->password = bcrypt('123456');
        $owner->phone = '0366025756';
        $owner->save();
        $owner->roles()->attach($role_owner);

        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->api_token = hash('sha256', Str::random(60));
        $admin->password = bcrypt('123456');
        $admin->phone = '0366025756';
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
