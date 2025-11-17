<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $slug = Str::slug($title);
        $data = [
            'title' => $title,
            'year' => $this->faker->year,
            'month' => $this->faker->month,
            'slug' => $slug,
            'content' => '<p>'.$this->faker->paragraphs(4, true).'</p>',
            'is_publish' => $this->faker->boolean(),
        ];

        return $data;
    }
}
