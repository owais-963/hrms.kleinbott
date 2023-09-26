<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the shifts
        $shifts = [
            [
                'start_time' => '15:00:00',
                'end_time' => '12:00:00',
                'status' => 1,
            ],
            [
                'start_time' => '18:00:00',
                'end_time' => '03:00:00',
                'status' => 1,
            ],
            [
                'start_time' => '20:00:00',
                'end_time' => '03:00:00',
                'status' => 1,
            ],
        ];

        DB::table('shifts')->insert($shifts);
    }
}
