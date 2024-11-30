<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TalentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('talents')->insert([
            [
                'name' => 'John Doe',
                'organizer' => 1, // Sesuaikan dengan ID di tabel organizers
                'image' => null, // Sesuaikan dengan ID di tabel images
                'role' => 1, // Sesuaikan dengan ID di tabel roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'organizer' => 2,
                'image' => null,
                'role' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Brown',
                'organizer' => null, // Talent tanpa organizer
                'image' => null, // Talent tanpa gambar
                'role' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
