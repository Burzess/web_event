<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'date' => now()->format('Y-m-d'),
                'status' => 'completed',
                'total_pay' => 150000,
                'total_order_ticket' => 2,
                'participant' => 1, // ID dari tabel participants
                'event' => 1, // ID dari tabel events
                'personalDetail' => json_encode([
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'phone' => '081234567890',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => now()->subDays(1)->format('Y-m-d'),
                'status' => 'pending',
                'total_pay' => 200000,
                'total_order_ticket' => 3,
                'participant' => 2, // ID dari tabel participants
                'event' => 2, // ID dari tabel events
                'personalDetail' => json_encode([
                    'name' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'phone' => '081298765432',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
