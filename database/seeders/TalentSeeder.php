<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data dummy ke dalam tabel talents
        DB::table('talents')->insert([
            [
                'name' => 'John Doe',
                'organizer_id' => 1, // Pastikan ID ini ada di tabel organizers
                'image_id' => 1, // Pastikan ID ini ada di tabel images
                'role_id' => 1, // Pastikan ID ini ada di tabel roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'organizer_id' => 2, // Pastikan ID ini ada di tabel organizers
                'image_id' => 2, // Pastikan ID ini ada di tabel images
                'role_id' => 6, // Pastikan ID ini ada di tabel roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Johnson',
                'organizer_id' => 3, // Pastikan ID ini ada di tabel organizers
                'image_id' => 3, // Pastikan ID ini ada di tabel images
                'role_id' => 7, // Pastikan ID ini ada di tabel roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Davis',
                'organizer_id' => 4, // Pastikan ID ini ada di tabel organizers
                'image_id' => 4, // Pastikan ID ini ada di tabel images
                'role_id' => 7, // Pastikan ID ini ada di tabel roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
