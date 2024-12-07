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
            RolesSeeder::class,
            OrganizersSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            TalentsSeeder::class,
            EventsTableSeeder::class,
            ParticipantSeeder::class,
        ]);
    }
}
