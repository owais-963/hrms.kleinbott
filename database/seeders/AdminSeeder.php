<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::insert([
            [
                'first_name' => 'Administrator',
                'last_name' => 'Dashboard',
                'username' => 'administrator',
                'email' => 'administrator@love2laundry.com',
                'password' => bcrypt('password'),
                'user_password' => 'password',
                'country_code' => '+92',
                'phone' => '+923362611600',
                'address' => 'A363 Block D, North Nazimabad',
                'address2' => '',
                'city' => 'Karachi',
                'zip_code' => '74100',
                'state' => 2720,
                'country' => 8,
                'cover' => 'bg-img.png',
                'image' => 'user.png',
                'about' => 'Admin User',
                'last_device_id' => 'abc123',
                'last_device_type' => 1,
                'otp_code' => generate_otp(),
                'otp_expire_at' => Carbon::now(),
                'otp_attempt' => '1',
                'role_id' => 1,
                'status' => 1,
                'last_login_ip' => '127.0.0.1',
                'created_at' => Carbon::now()
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Dashboard',
                'username' => 'admin',
                'email' => 'admin@love2laundry.com',
                'password' => bcrypt('password'),
                'user_password' => 'password',
                'country_code' => '+92',
                'phone' => '+923362611600',
                'address' => 'A363 Block D, North Nazimabad',
                'address2' => '',
                'city' => 'Karachi',
                'zip_code' => '74100',
                'state' => 2720,
                'country' => 8,
                'cover' => 'bg-img.png',
                'image' => 'user.png',
                'about' => 'Admin User',
                'last_device_id' => 'abc123',
                'last_device_type' => 1,
                'otp_code' => generate_otp(),
                'otp_expire_at' => Carbon::now(),
                'otp_attempt' => '1',
                'role_id' => 2,
                'status' => 1,
                'last_login_ip' => '127.0.0.1',
                'created_at' => Carbon::now()
            ],
            [
                'first_name' => 'Customer Support',
                'last_name' => 'Manager',
                'username' => 'customersupportmanager',
                'email' => 'customersupportmanager@love2laundry.com',
                'password' => bcrypt('password'),
                'user_password' => 'password',
                'country_code' => '+92',
                'phone' => '+923362611600',
                'address' => 'A363 Block D, North Nazimabad',
                'address2' => '',
                'city' => 'Karachi',
                'zip_code' => '74100',
                'state' => 2720,
                'country' => 8,
                'cover' => 'bg-img.png',
                'image' => 'user.png',
                'about' => 'Admin User',
                'last_device_id' => 'abc123',
                'last_device_type' => 1,
                'otp_code' => generate_otp(),
                'otp_expire_at' => Carbon::now(),
                'otp_attempt' => '1',
                'role_id' => 3,
                'status' => 1,
                'last_login_ip' => '127.0.0.1',
                'created_at' => Carbon::now()
            ],
            [
                'first_name' => 'Customer',
                'last_name' => 'Support',
                'username' => 'customersupport',
                'email' => 'customersupport@love2laundry.com',
                'password' => bcrypt('password'),
                'user_password' => 'password',
                'country_code' => '+92',
                'phone' => '+923362611600',
                'address' => 'A363 Block D, North Nazimabad',
                'address2' => '',
                'city' => 'Karachi',
                'zip_code' => '74100',
                'state' => 2720,
                'country' => 8,
                'cover' => 'bg-img.png',
                'image' => 'user.png',
                'about' => 'Admin User',
                'last_device_id' => 'abc123',
                'last_device_type' => 1,
                'otp_code' => generate_otp(),
                'otp_expire_at' => Carbon::now(),
                'otp_attempt' => '1',
                'role_id' => 4,
                'status' => 1,
                'last_login_ip' => '127.0.0.1',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
