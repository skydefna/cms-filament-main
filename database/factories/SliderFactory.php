<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'desc' => $this->faker->paragraph(),
            'image' => 'slider.jpg',
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'sort' => $this->faker->unique()->numberBetween(1, 10),
            'hyperlink' => $this->faker->url(),
        ];
    }
}
