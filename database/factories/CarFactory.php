<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        $brands = ['Toyota', 'Honda', 'Mitsubishi', 'Daihatsu', 'Suzuki', 'Nissan', 'BMW', 'Mercedes-Benz'];
        $models = ['Avanza', 'Innova', 'Camry', 'CR-V', 'Civic', 'Pajero', 'Xpander', 'Terios', 'Ertiga', 'Xenia'];
        $transmissions = ['manual', 'automatic'];

        return [
            'name' => fake()->randomElement($brands).' '.fake()->randomElement($models),
            'brand' => fake()->randomElement($brands),
            'year' => fake()->numberBetween(2019, 2024),
            'price_per_day' => fake()->numberBetween(200000, 1500000),
            'transmission' => fake()->randomElement($transmissions),
            'passenger_capacity' => fake()->randomElement([2, 4, 5, 6, 7, 8]),
            'description' => fake()->paragraph(3),
            'status' => 'available',
        ];
    }
}
