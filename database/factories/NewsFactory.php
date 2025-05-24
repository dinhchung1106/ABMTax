<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'slug' => Str::slug($this->faker->unique()->sentence(6)),
            'content' => $this->faker->paragraph(5),
            'image' => $this->faker->imageUrl(400, 250, 'business', true, 'news'),
            'category' => $this->faker->randomElement(['Thuế', 'Kế toán', 'Hóa đơn điện tử', 'Khóa học']),
            'keywords' => implode(',', $this->faker->words(5)),
            'status' => $this->faker->boolean(90),
        ];
    }
}
