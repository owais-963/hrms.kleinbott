<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        // Role::create(['name' => 'Admin', 'guard_name' => 'admin']);
        // Role::create(['name' => 'Customer Support  Manager', 'guard_name' => 'support']);
        // Role::create(['name' => 'Customer Support', 'guard_name' => 'customersupport']);
    }
}
