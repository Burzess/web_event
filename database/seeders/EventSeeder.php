<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data dummy ke dalam tabel events
        DB::table('events')->insert([
            [
                'title' => 'Tech Conference 2024',
                'date' => '2024-06-15',
                'about' => 'A major conference focusing on the latest trends in technology.',
                'tagline' => 'Innovate. Inspire. Impact.',
                'keypoint' => json_encode(['Keynote by industry leaders', 'Networking opportunities', 'Workshops and sessions']),
                'venue_name' => 'Grand Convention Center',
                'status' => 'active',
                'categories_id' => 1, // Pastikan ID ini ada di tabel categories
                'image_id' => 1, // Pastikan ID ini ada di tabel images
                'talent_id' => 5, // Pastikan ID ini ada di tabel talents
                'organizer_id' => 1, // Pastikan ID ini ada di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Music Fest 2024',
                'date' => '2024-07-20',
                'about' => 'An annual music festival featuring popular artists and bands.',
                'tagline' => 'Feel the Beat, Live the Music!',
                'keypoint' => json_encode(['Live performances', 'Food and drinks', 'Interactive booths']),
                'venue_name' => 'City Park Arena',
                'status' => 'active',
                'categories_id' => 2, // Pastikan ID ini ada di tabel categories
                'image_id' => 2, // Pastikan ID ini ada di tabel images
                'talent_id' => 6, // Pastikan ID ini ada di tabel talents
                'organizer_id' => 2, // Pastikan ID ini ada di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Art Exhibition 2024',
                'date' => '2024-08-10',
                'about' => 'Explore modern art and meet renowned artists.',
                'tagline' => 'Art That Speaks',
                'keypoint' => json_encode(['Gallery tours', 'Artist Q&A', 'Special exhibits']),
                'venue_name' => 'Downtown Art Gallery',
                'status' => 'inactive',
                'categories_id' => 3, // Pastikan ID ini ada di tabel categories
                'image_id' => 3, // Pastikan ID ini ada di tabel images
                'talent_id' => 7, // Pastikan ID ini ada di tabel talents
                'organizer_id' => 3, // Pastikan ID ini ada di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Startup Pitch Day',
                'date' => '2024-09-05',
                'about' => 'A day where startups pitch their ideas to potential investors.',
                'tagline' => 'Where Ideas Take Flight',
                'keypoint' => json_encode(['Investor presentations', 'Networking sessions', 'Startup showcases']),
                'venue_name' => 'Innovation Hub',
                'status' => 'active',
                'categories_id' => 4, // Pastikan ID ini ada di tabel categories
                'image_id' => 4, // Pastikan ID ini ada di tabel images
                'talent_id' => 8, // Pastikan ID ini ada di tabel talents
                'organizer_id' => 4, // Pastikan ID ini ada di tabel organizers
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
