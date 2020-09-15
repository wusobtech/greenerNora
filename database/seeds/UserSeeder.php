<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->modify('-2 year');
        $createdDate = clone($date);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'phone' => '08087541225',
            'state' => 'Lagos',
            'address' => 'Lekki',
            'role' => 'Admin',
            'password' => Hash::make('password'),
            'created_at' => $createdDate,
            'updated_at' => $createdDate
        ]);
    }
}
