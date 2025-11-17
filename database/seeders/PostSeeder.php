<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories for reference
        $categories = PostCategory::all();

        if ($categories->isEmpty()) {
            $this->command->info('No categories found. Please run the PostCategorySeeder first.');

            return;
        }
        // Create additional random posts
        Post::factory(15)->create();
    }
}
