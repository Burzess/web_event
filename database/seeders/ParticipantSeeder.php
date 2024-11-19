<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed untuk tabel participants
        DB::table('participants')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'active_code' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password123'),
                'status' => 'inactive',
                'active_code' => '123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed untuk tabel participant_forgot_password
        DB::table('participant_forgot_password')->insert([
            [
                'code' => 'ABC123',
                'status' => 'pending',
                'active_code' => null,
                'participant' => 1, // ID peserta dari tabel participants
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'XYZ789',
                'status' => 'completed',
                'active_code' => '456789',
                'participant' => 2, // ID peserta dari tabel participants
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed untuk tabel participant_refresh_token
        DB::table('participant_refresh_token')->insert([
            [
                'token' => 'token123',
                'refresh_token' => 'refresh123',
                'participant' => 1, // ID peserta dari tabel participants
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'token' => 'token456',
                'refresh_token' => 'refresh456',
                'participant' => 2, // ID peserta dari tabel participants
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
