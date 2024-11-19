<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Music',
                'organizer' => 1, // Sesuaikan dengan ID organizer di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports',
                'organizer' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'organizer' => null, // Kategori tanpa organizer
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
