<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $users = [
            [
                'username' => 'Shehroz',
                'email' => 'shehroz@kleinbott.com',
                'password' => Hash::make('q*lf&97jI#YS'),
            ],
            [
                'username' => 'Ali',
                'email' => 'ali@kleinbott.com',
                'password' => Hash::make('w.iFWhfWoHMB'),
            ],
            [
                'username' => 'Bushra',
                'email' => 'bushra@kleinbott.com',
                'password' => Hash::make('s}a%r@wDPhZ@'),
            ],
            [
                'username' => 'Haris',
                'email' => 'haris@kleinbott.com',
                'password' => Hash::make('x4*0r%GBJ0=R'),
            ],
            [
                'username' => 'Rashmina',
                'email' => 'rashmina@kleinbott.com',
                'password' => Hash::make('$?qRjA!N@pc6'),
            ],
            [
                'username' => 'Romail',
                'email' => 'romail@kleinbott.com',
                'password' => Hash::make('8L0wgRaq$K8U'),
            ],
            [
                'username' => 'Sarah',
                'email' => 'sarah@kleinbott.com',
                'password' => Hash::make('bjW.KNBtUfL%'),
            ],
            [
                'username' => 'Tabish',
                'email' => 'tabish@kleinbott.com',
                'password' => Hash::make('C5A6?^EG01vr'),
            ],
            [
                'username' => 'Uraiba',
                'email' => 'uraiba@kleinbott.com',
                'password' => Hash::make('*dz?l7n*tUms'),
            ],
            [
                'username' => 'Wajieh',
                'email' => 'wajieh@kleinbott.com',
                'password' => Hash::make('google1234'),
            ],
            [
                'username' => 'Wali',
                'email' => 'wali@kleinbott.com',
                'password' => Hash::make('2y{H6dE?2~s,'),
            ],
            [
                'username' => 'Zeeshan',
                'email' => 'zeeshan@kleinbott.com',
                'password' => Hash::make('=+V;A6A=J&pG8'),
            ],
            [
                'username' => 'Zaeem',
                'email' => 'Zaeem@kleinbott.com',
                'password' => Hash::make('}%!YSb+7D,gA'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}