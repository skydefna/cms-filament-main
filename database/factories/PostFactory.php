<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $slug = Str::slug($title);
        $categories = PostCategory::all();

        return [
            'title' => $title,
            'category_id' => Arr::random($categories->pluck('id')->toArray()),
            'year' => date('Y'),
            'month' => date('m'),
            'slug' => $slug,
            'is_publish' => true,
            'body' => $this->faker->paragraphs(3, true),
            'image' => 'test-image.jpg',
            'thumbnail' => 'test-image.jpg',
            'visited' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
