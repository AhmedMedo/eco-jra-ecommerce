<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //super admin
        if ($superAdmin = \Core\Models\User::where('user_type', 1)->first()) {
            $superAdmin->assignRole('Super Admin'); // Assuming 'Super Admin' is a valid role in your system

            return; // Super admin already exists, no need to create another one
        }
        $superAdmin = new \Core\Models\User();
        $superAdmin->name = 'Super Admin';
        $superAdmin->email = 'superadmin@example.com';
        $superAdmin->password = \Illuminate\Support\Facades\Hash::make('password');
        $superAdmin->user_type = 1; // Assuming 1 is for super admin
        $superAdmin->status = 1; // Assuming 1 is for active status
        $superAdmin->saveOrFail();
        $superAdmin->uid = 'SUPER-ADMIN-' . $superAdmin->id . now()->format('ymd');
        $superAdmin->update();



    }

}
