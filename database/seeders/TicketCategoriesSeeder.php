<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_categories')->insert([
            [
                'price' => 50000,
                'stock' => 100,
                'sum_ticket' => 0, // Jumlah tiket yang telah terjual
                'status' => 'available',
                'event' => 1, // Sesuaikan dengan ID di tabel events
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'price' => 100000,
                'stock' => 50,
                'sum_ticket' => 10,
                'status' => 'available',
                'event' => 1, // Sesuaikan dengan ID di tabel events
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'price' => 200000,
                'stock' => 0,
                'sum_ticket' => 50,
                'status' => 'sold out',
                'event' => 2, // Sesuaikan dengan ID di tabel events
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
