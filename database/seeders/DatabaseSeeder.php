<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SliderSeeder::class,
            BannerLinkSeeder::class,
            ContactSeeder::class,            
            PageSeeder::class,
            SocialMediaSeeder::class,
            KategoriLayananSeeder::class,            
            YoutubeVideoSeeder::class,                        
        ]);
    }
}
