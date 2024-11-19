<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            [
                'history_ticket_categories' => json_encode([
                    [
                        'category' => 'VIP',
                        'price' => 100000,
                        'quantity' => 1,
                    ],
                    [
                        'category' => 'Regular',
                        'price' => 50000,
                        'quantity' => 2,
                    ],
                ]),
                'sum_ticket' => 3,
                'order' => 1, // ID dari tabel orders
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'history_ticket_categories' => json_encode([
                    [
                        'category' => 'VIP',
                        'price' => 150000,
                        'quantity' => 2,
                    ],
                ]),
                'sum_ticket' => 2,
                'order' => 2, // ID dari tabel orders
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
