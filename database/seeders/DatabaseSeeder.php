<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun Admin
        User::firstOrCreate(
            ['email' => 'bearsmin@beartrails.com'],
            [
                'name'     => 'BearTrails Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('✅ Admin account dibuat: bearsmin@beartrails.com');

        // Jalankan seeder lainnya
        $this->call([
            DestinationSeeder::class,
            TourguideSeeder::class,
        ]);
    }
}