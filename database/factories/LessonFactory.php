<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()?->id ?? 1,
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween(10, 90),
            'order' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->boolean(90),
        ];
    }
} 