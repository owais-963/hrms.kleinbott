<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = [
            ['name' => 'Manager', 'description' => 'Manager Designation'],
            ['name' => 'Senior Developer', 'description' => 'Senior Developer Designation'],
            ['name' => 'Sales Executive', 'description' => 'Sales Executive Designation'],
        ];

        // Insert the data into the 'designations' table
        Designation::insert($designations);
    }
}