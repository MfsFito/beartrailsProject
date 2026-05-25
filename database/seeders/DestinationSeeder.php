<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name'        => 'Pantai Senggigi',
                'description' => 'Pantai Senggigi adalah destinasi wisata pantai paling terkenal di Lombok. Dengan pasir putih bersih, ombak tenang, dan pemandangan Gunung Agung Bali di kejauhan, pantai ini menjadi favorit wisatawan domestik maupun mancanegara.',
                'location'    => 'Lombok Barat',
                'latitude'    => -8.4897,
                'longitude'   => 116.0490,
                'category'    => 'pantai',
                'image'       => null,
                'entry_fee'   => 0,
            ],
            [
                'name'        => 'Gunung Rinjani',
                'description' => 'Gunung Rinjani adalah gunung berapi aktif tertinggi kedua di Indonesia dengan ketinggian 3.726 mdpl. Menawarkan trekking menantang dengan pemandangan danau kawah Segara Anak yang memukau di puncaknya.',
                'location'    => 'Lombok Timur',
                'latitude'    => -8.4167,
                'longitude'   => 116.4500,
                'category'    => 'gunung',
                'image'       => null,
                'entry_fee'   => 150000,
            ],
            [
                'name'        => 'Pantai Kuta Lombok',
                'description' => 'Berbeda dengan Kuta Bali, Pantai Kuta Lombok masih sangat alami dengan pasir putih berbintik merah muda dan air biru jernih. Dikelilingi bukit hijau yang membuat pemandangannya luar biasa indah.',
                'location'    => 'Lombok Tengah',
                'latitude'    => -8.8957,
                'longitude'   => 116.2810,
                'category'    => 'pantai',
                'image'       => null,
                'entry_fee'   => 10000,
            ],
            [
                'name'        => 'Desa Sade',
                'description' => 'Desa Sade adalah desa adat suku Sasak yang masih mempertahankan tradisi dan budaya asli Lombok. Rumah-rumah tradisional dengan lantai yang dipel menggunakan kotoran kerbau menjadi daya tarik unik desa ini.',
                'location'    => 'Lombok Tengah',
                'latitude'    => -8.8578,
                'longitude'   => 116.2678,
                'category'    => 'budaya',
                'image'       => null,
                'entry_fee'   => 20000,
            ],
            [
                'name'        => 'Pantai Pink',
                'description' => 'Pantai Pink atau Pantai Tangsi adalah salah satu pantai langka di dunia yang memiliki pasir berwarna merah muda. Warna unik ini berasal dari pecahan terumbu karang merah yang bercampur dengan pasir putih.',
                'location'    => 'Lombok Timur',
                'latitude'    => -8.7522,
                'longitude'   => 116.5878,
                'category'    => 'pantai',
                'image'       => null,
                'entry_fee'   => 15000,
            ],
            [
                'name'        => 'Gili Trawangan',
                'description' => 'Gili Trawangan adalah pulau kecil terbesar dari tiga Gili di Lombok. Terkenal dengan snorkeling, diving, kehidupan malam yang ramai, dan keindahan bawah lautnya yang luar biasa dengan penyu yang sering terlihat.',
                'location'    => 'Lombok Utara',
                'latitude'    => -8.3522,
                'longitude'   => 115.9713,
                'category'    => 'pantai',
                'image'       => null,
                'entry_fee'   => 25000,
            ],
            [
                'name'        => 'Air Terjun Sendang Gile',
                'description' => 'Air Terjun Sendang Gile terletak di kaki Gunung Rinjani dekat Desa Senaru. Dengan ketinggian sekitar 31 meter, air terjun ini dikelilingi hutan tropis lebat yang menyejukkan dan menawarkan pemandangan yang spektakuler.',
                'location'    => 'Lombok Utara',
                'latitude'    => -8.3167,
                'longitude'   => 116.4167,
                'category'    => 'gunung',
                'image'       => null,
                'entry_fee'   => 10000,
            ],
            [
                'name'        => 'Pantai Tanjung Aan',
                'description' => 'Pantai Tanjung Aan memiliki dua jenis pasir yang unik yaitu pasir halus putih dan pasir berbentuk butiran merica. Airnya sangat jernih dengan gradasi warna biru kehijauan yang memesona.',
                'location'    => 'Lombok Tengah',
                'latitude'    => -8.9167,
                'longitude'   => 116.3000,
                'category'    => 'pantai',
                'image'       => null,
                'entry_fee'   => 10000,
            ],
            [
                'name'        => 'Pura Lingsar',
                'description' => 'Pura Lingsar adalah pura unik di Lombok yang menjadi simbol kerukunan umat beragama. Di dalam kompleks ini terdapat tempat ibadah Hindu dan tempat keramat umat Islam Wetu Telu yang hidup berdampingan secara damai.',
                'location'    => 'Lombok Barat',
                'latitude'    => -8.5833,
                'longitude'   => 116.1167,
                'category'    => 'budaya',
                'image'       => null,
                'entry_fee'   => 15000,
            ],
            [
                'name'        => 'Pasar Seni Sayang Sayang',
                'description' => 'Pasar Seni Sayang Sayang adalah pusat oleh-oleh dan kuliner khas Lombok. Di sini kamu bisa menemukan kain tenun Sasak, gerabah Banyumulek, hingga berbagai makanan khas Lombok seperti Ayam Taliwang dan Plecing Kangkung.',
                'location'    => 'Mataram',
                'latitude'    => -8.5922,
                'longitude'   => 116.1044,
                'category'    => 'kuliner',
                'image'       => null,
                'entry_fee'   => 0,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::firstOrCreate(
                ['name' => $destination['name']],
                $destination
            );
        }

        $this->command->info('✅ DestinationSeeder selesai! ' . count($destinations) . ' destinasi dibuat.');
    }
}