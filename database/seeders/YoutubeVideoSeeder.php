<?php

namespace Database\Seeders;

use App\Models\YoutubeVideo;
use Illuminate\Database\Seeder;

class YoutubeVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        YoutubeVideo::factory(45)->create();
    }
}
