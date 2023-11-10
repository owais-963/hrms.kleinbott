<?php

namespace Database\Seeders;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'London',
            'status' => 1,
            'country_id'=> 8,
            "timezones" => '[{"zoneName":"Asia/Bahrain","gmtOffset":10800,"gmtOffsetName":"UTC+03:00","abbreviation":"AST","tzName":"Arabia Standard Time"}]',
            "latitude" => "26.00000000",
            "longitude" => "50.55000000",
            'created_at' => Carbon::now(),
        ]);

        City::create([
            'name' => 'Brimigham',
            'status' => 1,
            "timezones" => '[{"zoneName":"Asia/Bahrain","gmtOffset":10800,"gmtOffsetName":"UTC+03:00","abbreviation":"AST","tzName":"Arabia Standard Time"}]',
            "latitude" => "26.00000000",
            "longitude" => "50.55000000",
            'country_id'=> 8,
            'created_at' => Carbon::now(),
        ]);


    }
}
