<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizers')->insert([
            ['name' => 'Festival One'],
            ['name' => 'World Music Festival'],
            ['name' => 'Wedding Party'],
            ['name' => 'Music Concert'],
        ]);
    }
}
