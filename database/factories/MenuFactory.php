<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'url' => '/'.$this->faker->slug(2),
            'path' => '/'.$this->faker->slug(2),
            'order' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['internal', 'external']),
        ];
    }

    /**
     * Indicate that the menu is a child menu.
     */
    public function child(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Menu::inRandomOrder()->first()?->id,
            ];
        });
    }

    /**
     * Indicate that the menu is an external link.
     */
    public function external(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'url_external',
            'url' => $this->faker->url(),
        ]);
    }

    /**
     * Indicate that the menu is an internal link.
     */
    public function internal(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'url_internal',
            'url' => '/'.$this->faker->slug(2),
        ]);
    }
}
