<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'slug' => Str::slug($this->faker->unique()->company()),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(300, 200, 'business', true, 'service'),
            'status' => $this->faker->boolean(90),
        ];
    }
}
