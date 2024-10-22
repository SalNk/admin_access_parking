<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'model' => fake()->randomElement([
                'BMW',
                'Ford',
                'Mercedes-Benz',
                'Porsche',
                'Toyota',
                'Volkswagen',
                'Volvo',
                'Tata Motors',
                'Citroën',
                'Suzuki',
                'Jeep',
                'Kia',
                'Lamborghini',
                'Land Rover',
                'Range Rover',
                'Lexus',
                'Mazda',
                'Mitsubishi',
                'Nissan',
                'Peugeot',
                'Renault',
                'Honda',
                'Hyundai',
                'Jaguar',
                'Audi',
                'Chevrolet',
            ]),
            'vin' => fake()->postcode,
            'color' => fake()->colorName,
            'transmission' => fake()->randomElement(['manual', 'automatic']),
            'description' => fake()->text()
        ];
    }
}
