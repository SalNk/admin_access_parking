<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name,
            'avatar' => fake()->imageUrl,
            'phone' => fake()->phoneNumber,
            'email' => fake()->email,
            'residence_info' => fake()->streetAddress,
        ];
    }
}
