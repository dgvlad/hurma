<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'full_name' => 'Client',
            'email' => 'client@gmail.com',
            'phone' => '+38000000000',
            'password' => Hash::make('password'),
            'note' => Str::random(10),
            'address' => Str::random(10),
        ]);


        DB::table('users')->insert([
            'full_name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '+3800000000',
            'password' => Hash::make('password'),
            'note' => Str::random(10),
        ]);
    }
}
