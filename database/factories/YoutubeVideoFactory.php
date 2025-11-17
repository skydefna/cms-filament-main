<?php

namespace Database\Factories;

use App\Models\YoutubeVideo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\YoutubeVideo>
 */
class YoutubeVideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = YoutubeVideo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(), // YouTube IDs are 11 characters
            'thumbnail' => 'https://s3.tabalongkab.go.id/cms-filament/01JYS1PRVSC5NR3122K081D6S0.jpg',
            'created_at' => Carbon::parse($this->faker->dateTime()),
            'updated_at' => Carbon::parse($this->faker->dateTime()),
        ];
    }
}
