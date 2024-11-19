<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizers')->insert([
            ['name' => 'Organizer A', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Organizer B', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
