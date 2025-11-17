<?php

namespace Database\Seeders;

use App\Models\BannerLink;
use Illuminate\Database\Seeder;

class BannerLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BannerLink::factory(5)->create();
    }
}
