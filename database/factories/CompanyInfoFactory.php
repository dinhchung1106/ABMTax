<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyInfo>
 */
class CompanyInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Công ty TNHH Đại Lý Thuế ABM',
            'address' => $this->faker->address(),
            'email' => $this->faker->companyEmail(),
            'hotline' => $this->faker->phoneNumber(),
            'slogan' => 'ABM Đồng hành phát triển cùng doanh nghiệp',
            'about' => $this->faker->paragraph(4),
        ];
    }
}
