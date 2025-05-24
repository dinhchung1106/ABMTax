<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoSetting>
 */
class SeoSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page' => $this->faker->unique()->slug(),
            'meta_title' => $this->faker->sentence(6),
            'meta_description' => $this->faker->sentence(12),
            'keywords' => implode(',', $this->faker->words(5)),
        ];
    }
}
