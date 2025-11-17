<?php

namespace Database\Factories;

use App\Models\HitVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HitVisit>
 */
class HitVisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HitVisit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->unique()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'visits' => $this->faker->numberBetween(50, 500),
            'created_at' => function (array $attributes) {
                return $attributes['date'].' 00:00:00';
            },
            'updated_at' => function (array $attributes) {
                return $attributes['date'].' 23:59:59';
            },
        ];
    }
}
