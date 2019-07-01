<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $role_employee = new Role();
        $role_employee->name = 'customer';
        $role_employee->description = 'A Customer User';
        $role_employee->save();

        $role_employee = new Role();
        $role_employee->name = 'owner';
        $role_employee->description = 'A Room owner User';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'A Admin User';
        $role_manager->save();
    }
}
