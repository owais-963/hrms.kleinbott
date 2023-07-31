<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'Marketing', 'description' => 'Marketing Department'],
            ['name' => 'Sales', 'description' => 'Sales Department'],
            ['name' => 'Finance', 'description' => 'Finance Department'],
            ['name' => 'Development', 'description' => 'Development Department'],
        ];

        Department::insert($departments);
    }
}