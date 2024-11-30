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
            ['name' => 'HIMA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HMI', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PMII', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
