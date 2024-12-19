<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data dummy ke dalam tabel images
        DB::table('images')->insert([
            [
                'name' => 'Sample Image 1',
                'file_path' => 'images/sample1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Image 2',
                'file_path' => 'images/sample2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Image 3',
                'file_path' => 'images/sample3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Image 4',
                'file_path' => 'images/sample4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
