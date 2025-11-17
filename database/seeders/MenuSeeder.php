<?php

namespace Database\Seeders;

use App\Enums\ListUrlInternal;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main menu items
        Menu::factory()->internal()->create([
            'parent_id' => -1,
            'url' => null,
            'order' => 1,
            'title' => 'Home',
            'path' => ListUrlInternal::DASHBOARD,
        ]);

        Menu::factory()->internal()->create([
            'parent_id' => -1,
            'title' => 'Postingan terbaru',
            'path' => ListUrlInternal::LATEST_POST,
            'url' => null,
            'order' => 2,
        ]);

        Menu::factory()->internal()->create([
            'parent_id' => -1,
            'title' => 'Postingan terpopuler',
            'path' => ListUrlInternal::POPULAR_POST,
            'url' => null,
            'order' => 3,
        ]);

        Menu::factory()->internal()->create([
            'parent_id' => -1,
            'title' => 'Video Terbaru',
            'path' => ListUrlInternal::VIDEOS->value,
            'url' => null,
            'order' => 5,
        ]);

        Menu::factory()->internal()->create([
            'parent_id' => -1,
            'title' => 'Struktur Organisasi',
            'path' => ListUrlInternal::STRUKTUR_ORGANISASI->value,
            'url' => null,
            'order' => 5,
        ]);

        Menu::factory()->internal()->create([
            'parent_id' => -1,
            'title' => 'Publikasi',
            'path' => ListUrlInternal::PUBLIKASI->value,
            'url' => null,
            'order' => 6,
        ]);
    }
}
