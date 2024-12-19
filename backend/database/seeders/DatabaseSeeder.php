<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        // User::factory(10)->create();

        $this->call([
            ImageSeeder::class,
            RoleSeeder::class,
            OrganizerSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TalentSeeder::class,
            EventSeeder::class,
            // ParticipantSeeder::class,
        ]);
    }
}
