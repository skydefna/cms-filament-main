<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Manajemen Aplikasi - Pengujian Aplikasi SKPD',
            'Layanan Jaringan dan Infrastruktur',
            'Pengelolaan Data dan Statistik',
            'Layanan Informasi Publik',
            'Pengembangan Smart City',
        ];

        foreach ($categories as $index => $category) {
            KategoriLayanan::firstOrCreate(
                ['name' => $category],
                [
                    'active' => true,
                    'sort' => $index + 1,
                ]
            );
        }
    }
}