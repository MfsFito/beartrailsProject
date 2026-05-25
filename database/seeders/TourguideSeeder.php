<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TourguideProfile;
use App\Models\TourguideAvailability;
use App\Models\TourguidePortfolio;
use App\Models\Destination;
use Illuminate\Support\Facades\Hash;

class TourguideSeeder extends Seeder
{
    public function run(): void
    {
        $tourguides = [
            [
                'user' => [
                    'name'     => 'Rival Grizzly',
                    'email'    => 'rival@beartrails.com',
                    'password' => Hash::make('password'),
                    'role'     => 'tourguide',
                ],
                'profile' => [
                    'phone'         => '081234567891',
                    'bio'           => 'Halo! Saya Rival, pemandu wisata asli Lombok dengan pengalaman lebih dari 5 tahun. Saya spesialis wisata pantai dan snorkeling di Gili dan pantai-pantai tersembunyi Lombok yang belum banyak diketahui orang.',
                    'location'      => 'Lombok Barat & Lombok Utara',
                    'price_per_day' => 350000,
                    'status'        => 'active',
                    'rating'        => 4.9,
                ],
                'availabilities' => [
                    ['available_date' => '2026-06-01', 'status' => 'available'],
                    ['available_date' => '2026-06-02', 'status' => 'available'],
                    ['available_date' => '2026-06-05', 'status' => 'available'],
                    ['available_date' => '2026-06-07', 'status' => 'available'],
                    ['available_date' => '2026-06-10', 'status' => 'available'],
                ],
                'portfolios' => [
                    [
                        'title'       => 'Snorkeling Seru di Gili Trawangan',
                        'description' => 'Pengalaman tak terlupakan membawa wisatawan snorkeling bersama penyu di perairan jernih Gili Trawangan. Kami menjelajahi 3 spot snorkeling terbaik dalam satu hari penuh.',
                        'image'       => 'portfolios/default.jpg',
                        'destination' => 'Gili Trawangan',
                    ],
                    [
                        'title'       => 'Sunrise di Pantai Senggigi',
                        'description' => 'Menyaksikan matahari terbit dengan latar belakang Gunung Agung Bali dari Pantai Senggigi. Momen yang selalu membuat wisatawan terkagum-kagum.',
                        'image'       => 'portfolios/default.jpg',
                        'destination' => 'Pantai Senggigi',
                    ],
                ],
            ],
            [
                'user' => [
                    'name'     => 'Fatio Panda',
                    'email'    => 'fatio@beartrails.com',
                    'password' => Hash::make('password'),
                    'role'     => 'tourguide',
                ],
                'profile' => [
                    'phone'         => '081234567892',
                    'bio'           => 'Saya Fatio, pemandu wisata yang passionate di bidang budaya dan sejarah Lombok. Saya akan membawa kamu menyelami kekayaan tradisi suku Sasak yang autentik dan pengalaman kuliner lokal yang tak terlupakan.',
                    'location'      => 'Lombok Tengah & Mataram',
                    'price_per_day' => 300000,
                    'status'        => 'active',
                    'rating'        => 4.8,
                ],
                'availabilities' => [
                    ['available_date' => '2026-06-03', 'status' => 'available'],
                    ['available_date' => '2026-06-04', 'status' => 'available'],
                    ['available_date' => '2026-06-06', 'status' => 'available'],
                    ['available_date' => '2026-06-08', 'status' => 'available'],
                    ['available_date' => '2026-06-11', 'status' => 'available'],
                ],
                'portfolios' => [
                    [
                        'title'       => 'Mengenal Tradisi Suku Sasak di Desa Sade',
                        'description' => 'Perjalanan mendalam ke Desa Sade bersama keluarga wisatawan dari Jakarta. Kami belajar menenun kain Sasak langsung dari pengrajin lokal dan menyaksikan pertunjukan tari tradisional.',
                        'image'       => 'portfolios/default.jpg',
                        'destination' => 'Desa Sade',
                    ],
                    [
                        'title'       => 'Wisata Kuliner Khas Lombok di Mataram',
                        'description' => 'Tur kuliner malam di Pasar Seni Sayang Sayang mencicipi Ayam Taliwang, Plecing Kangkung, dan Beberuk Terong. Pengalaman gastronomi yang bikin ketagihan!',
                        'image'       => 'portfolios/default.jpg',
                        'destination' => 'Pasar Seni Sayang Sayang',
                    ],
                ],
            ],
            [
                'user' => [
                    'name'     => 'Alif Ice Bear',
                    'email'    => 'alif@beartrails.com',
                    'password' => Hash::make('password'),
                    'role'     => 'tourguide',
                ],
                'profile' => [
                    'phone'         => '081234567893',
                    'bio'           => 'Saya Alif, spesialis trekking dan pendakian Gunung Rinjani. Dengan sertifikasi pemandu gunung resmi, saya sudah memandu ratusan pendaki dari berbagai negara menaklukkan puncak Rinjani dengan aman dan berkesan.',
                    'location'      => 'Lombok Timur & Lombok Utara',
                    'price_per_day' => 450000,
                    'status'        => 'active',
                    'rating'        => 5.0,
                ],
                'availabilities' => [
                    ['available_date' => '2026-06-01', 'status' => 'available'],
                    ['available_date' => '2026-06-04', 'status' => 'available'],
                    ['available_date' => '2026-06-08', 'status' => 'available'],
                    ['available_date' => '2026-06-12', 'status' => 'available'],
                    ['available_date' => '2026-06-15', 'status' => 'available'],
                ],
                'portfolios' => [
                    [
                        'title'       => 'Menaklukkan Puncak Rinjani 3.726 mdpl',
                        'description' => 'Ekspedisi 3 hari 2 malam bersama 6 pendaki dari Surabaya menuju puncak Rinjani. Melewati jalur Sembalun, bermalam di Plawangan, dan tiba di puncak saat fajar dengan pemandangan yang tak ternilai.',
                        'image'       => 'portfolios/default.jpg',
                        'destination' => 'Gunung Rinjani',
                    ],
                    [
                        'title'       => 'Air Terjun Sendang Gile yang Menyegarkan',
                        'description' => 'Trekking santai menuju Air Terjun Sendang Gile di kaki Rinjani. Perjalanan melewati hutan tropis dengan suara alam yang menenangkan sebelum tiba di air terjun yang memukau.',
                        'image'       => 'portfolios/default.jpg',
                        'destination' => 'Air Terjun Sendang Gile',
                    ],
                ],
            ],
        ];

        foreach ($tourguides as $data) {
            // Buat akun user
            $user = User::firstOrCreate(
                ['email' => $data['user']['email']],
                $data['user']
            );

            // Buat profil tourguide
            $profile = TourguideProfile::firstOrCreate(
                ['user_id' => $user->id],
                $data['profile']
            );

            // Buat availability
            foreach ($data['availabilities'] as $availability) {
                TourguideAvailability::firstOrCreate([
                    'tourguide_profile_id' => $profile->id,
                    'available_date'       => $availability['available_date'],
                ], [
                    'status' => $availability['status'],
                ]);
            }

            // Buat portofolio
            foreach ($data['portfolios'] as $portfolio) {
                $destination = Destination::where('name', $portfolio['destination'])->first();
                TourguidePortfolio::firstOrCreate([
                    'tourguide_profile_id' => $profile->id,
                    'title'                => $portfolio['title'],
                ], [
                    'description'    => $portfolio['description'],
                    'image'          => $portfolio['image'] ?? null,
                ]);
            }

            $this->command->info("✅ Tourguide {$user->name} selesai dibuat!");
        }
    }
}