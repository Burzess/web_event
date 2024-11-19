<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Tech Conference 2024',
                'date' => '2024-12-01',
                'about' => 'A conference focusing on the latest trends in technology.',
                'tagline' => 'Innovating the Future',
                'keypoint' => json_encode(['Networking', 'Workshops', 'Keynote Speakers']),
                'venue_name' => 'Grand Tech Hall',
                'status' => 'active',
                'categories' => 1, // Sesuaikan dengan ID di tabel categories
                'image' => 1, // Sesuaikan dengan ID di tabel images
                'talent' => 1, // Sesuaikan dengan ID di tabel talents
                'organizer' => 1, // Sesuaikan dengan ID di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Music Festival 2024',
                'date' => '2024-12-15',
                'about' => 'A grand festival featuring top music artists from around the world.',
                'tagline' => 'Feel the Rhythm',
                'keypoint' => json_encode(['Live Performances', 'Food Stalls', 'Merchandise']),
                'venue_name' => 'Festival Ground',
                'status' => 'active',
                'categories' => 2,
                'image' => 2,
                'talent' => 2,
                'organizer' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Art Exhibition 2024',
                'date' => '2024-11-20',
                'about' => 'An exhibition showcasing modern and contemporary art.',
                'tagline' => null,
                'keypoint' => json_encode(['Art Galleries', 'Workshops']),
                'venue_name' => 'Art Hub',
                'status' => 'inactive',
                'categories' => null, // Event tanpa kategori
                'image' => 3,
                'talent' => null,
                'organizer' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
