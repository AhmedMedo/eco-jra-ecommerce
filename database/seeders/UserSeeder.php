<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        // Create test seller
        if (!\Core\Models\User::where('user_type', 3)->where('email', 'seller@example.com')->first()) {
            $date = now();
            $user_id = $date->format('y') . $date->format('m') . $date->format('d');
            
            $seller = new \Core\Models\User();
            $seller->name = 'Test Seller';
            $seller->email = 'seller@example.com';
            $seller->user_type = 3; // seller
            $seller->status = 1; // active
            $seller->password = \Illuminate\Support\Facades\Hash::make('password');
            $seller->saveOrFail();
            $seller->uid = "SELLER-" . $seller->id . $user_id;
            $seller->update();

            // Create seller shop
            $seller_shop = new \Plugin\Multivendor\Models\SellerShop();
            $seller_shop->seller_id = $seller->id;
            $seller_shop->seller_phone = '+1234567890';
            $seller_shop->shop_name = 'Test Shop';
            $seller_shop->shop_slug = Str::slug('test-shop');
            $seller_shop->shop_phone = '+1234567890';
            $seller_shop->status = 1; // active
            $seller_shop->save();
        }
    }
}
