<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            Lesson::factory()->count(rand(3,5))->create(['course_id' => $course->id]);
        }
    }
} 