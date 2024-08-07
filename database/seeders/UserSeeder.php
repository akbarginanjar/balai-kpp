<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat Sample Role
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // Membuat Sample User
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('admin123');
        $admin->save();
        $admin->attachRole($adminRole);
    }
}
