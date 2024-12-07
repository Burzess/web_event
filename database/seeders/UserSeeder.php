<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Pastikan mengganti password dengan lebih aman
                'role_id' => 1, // Sesuaikan dengan ID role di tabel roles
                'organizer_id' => 1, // Sesuaikan dengan ID organizer di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'Organizer User',
            //     'email' => 'organizer@example.com',
            //     'password' => Hash::make('password'),
            //     'role' => 2,
            //     'organizer' => 1,
            //     'refresh_token' => null,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
