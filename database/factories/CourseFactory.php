<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Khóa học ' . $this->faker->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(3),
            'fee' => $this->faker->numberBetween(1000000, 5000000),
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'schedule' => '19h30-21h30 (thứ 2,4,6)',
            'discount_info' => 'Giảm ' . $this->faker->numberBetween(5, 15) . '% cho nhóm',
            'status' => $this->faker->boolean(90),
        ];
    }
}
