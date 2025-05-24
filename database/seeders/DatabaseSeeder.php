<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            NewsSeeder::class,
            CourseSeeder::class,
            CourseRegistrationSeeder::class,
            CollaboratorSeeder::class,
            ContactSeeder::class,
            SeoSettingSeeder::class,
            CompanyInfoSeeder::class,
            LessonSeeder::class,
        ]);
    }
}
