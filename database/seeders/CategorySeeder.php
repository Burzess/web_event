<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Music', 'organizer_id' => 1], // Pastikan ID organizer ini ada di tabel organizers
            ['name' => 'Art', 'organizer_id' => 2],
            ['name' => 'Tech', 'organizer_id' => 3],
            ['name' => 'Sports', 'organizer_id' => null], // ID organizer bisa null jika tidak diperlukan
        ]);
    }
}
