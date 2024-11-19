<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'name' => 'Credit Card',
                'status' => true,
                'image' => 1, // ID dari tabel images
                'organizer' => 1, // ID dari tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PayPal',
                'status' => true,
                'image' => 2, // ID dari tabel images
                'organizer' => 2, // ID dari tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Transfer',
                'status' => false,
                'image' => 3, // ID dari tabel images
                'organizer' => 3, // ID dari tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
